<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/helpers/Validator.php';

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('User');
    }


    public function showRegister(): void
    {
        // Redirect if already logged in
        if (Session::isLoggedIn()) {
            $this->redirect('/home');
        }

        $this->data['csrf_token'] = $this->getCsrfToken();
        $this->view('auth/register', $this->data);
    }


    public function register(): void
    {
        if (!$this->isPost()) {
            $this->redirect('/register');
        }

        // Verify CSRF token
        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect('/register');
        }

        $data = $this->allPost();

        // Validate input
        $validator = Validator::make($data)
            ->required('name', 'First name is required.')
            ->required('surname', 'Last name is required.')
            ->required('email', 'Email is required.')
            ->email('email', 'Please enter a valid email address.')
            ->required('password', 'Password is required.')
            ->password('password', 'Password must be at least 8 characters with uppercase, lowercase, and a number.')
            ->required('password_confirm', 'Please confirm your password.')
            ->matches('password_confirm', 'password', 'Passwords do not match.')
            ->required('student_status_until', 'Student status end date is required.');

        // Check if email already exists
        if ($this->userModel->emailExists($data['email'] ?? '')) {
            $validator->addError('email', 'An account with this email already exists.');
        }

        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->data['old'] = $data;
            $this->data['errors'] = $validator->errors();
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/register', $this->data);
            return;
        }

        try {
            // Handle file uploads for documents
            $idDocumentPath = $this->handleFileUpload('id-document', 'documents/id/');
            $studentIdPath = $this->handleFileUpload('student-id', 'documents/student/');

            // Create user account (id is auto_increment, returns the new ID)
            $accountId = $this->userModel->createUser([
                'email' => $data['email'],
                'password' => $data['password'],
                'status' => 'pending',
                'role' => 'student',
                'dob' => $data['dob'] ?? null,
                'student_status_until' => $data['student_status_until'] ?? null,
            ]);

            // Create user profile with names (account_id is bigint)
            $this->createUserProfile((int) $accountId, [
                'first_name' => $data['name'],
                'last_name' => $data['surname'],
            ]);

            // Store document paths if uploaded
            if ($idDocumentPath || $studentIdPath) {
                $this->storeUserDocuments((int) $accountId, $idDocumentPath, $studentIdPath);
            }

            $this->flash('success', 'Registration successful! Please wait for account approval.');
            $this->redirect('/login');
        } catch (Exception $e) {
            if (APP_DEBUG) {
                $this->flash('error', 'Registration failed: ' . $e->getMessage());
            } else {
                $this->flash('error', 'Registration failed. Please try again.');
            }
            $this->data['old'] = $data;
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/register', $this->data);
        }
    }


    private function createUserProfile(int $accountId, array $profileData = []): void
    {
        $db = Database::getInstance();
        $db->insert('user_profile', array_merge([
            'id' => $this->generateUuid(),
            'account_id' => $accountId,
        ], $profileData));
    }


    public function showLogin(): void
    {
        if (Session::isLoggedIn()) {
            $this->redirect('/home');
        }

        $this->data['csrf_token'] = $this->getCsrfToken();
        $this->view('auth/signin', $this->data);
    }


    public function login(): void
    {
        if (!$this->isPost()) {
            $this->redirect('/signin');
        }

        // Verify CSRF token
        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect('/signin');
        }

        $email = $this->postInput('email');
        $password = $this->postInput('password');
        $remember = $this->postInput('remember') === 'on';

        // Validate input
        $validator = Validator::make(['email' => $email, 'password' => $password])
            ->required('email', 'Email is required.')
            ->email('email', 'Please enter a valid email address.')
            ->required('password', 'Password is required.');

        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->data['old'] = ['email' => $email];
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/signin', $this->data);
            return;
        }

        // Find user by email
        $user = $this->userModel->findByEmail($email);

        if (!$user || !$this->userModel->verifyPassword($user, $password)) {
            $this->flash('error', 'Invalid email or password.');
            $this->data['old'] = ['email' => $email];
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/signin', $this->data);
            return;
        }

        // Check if account is approved
        if ($user['status'] !== 'approved') {
            $statusMessages = [
                'pending' => 'Login failed: Your account is currently pending approval. Please check back later.',
                'rejected' => 'Login failed: Your account application has been rejected.',
                'suspended' => 'Login failed: This account has been suspended.',
            ];

            // Use 'warning' for pending if possible, but 'error' ensures visibility with current CSS
            $message = $statusMessages[$user['status']] ?? 'Account access denied.';
            $this->flash('error', $message);

            $this->data['old'] = ['email' => $email];
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/signin', $this->data);
            return;
        }

        // Login successful
        $safeUser = $this->userModel->getSafeUserData($user);
        Session::login($safeUser);

        // Handle remember me
        if ($remember) {
            // Extend session lifetime
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                session_id(),
                time() + (30 * 24 * 60 * 60), // 30 days
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        $this->flash('success', 'Welcome back!');
        $this->redirect('/home');
    }


    public function logout(): void
    {
        Session::logout();
        $this->flash('success', 'You have been logged out.');
        $this->redirect('/signin');
    }


    public function showForgotPassword(): void
    {
        if (Session::isLoggedIn()) {
            $this->redirect('/home');
        }

        $this->data['csrf_token'] = $this->getCsrfToken();
        $this->view('auth/forgot_password', $this->data);
    }


    public function forgotPassword(): void
    {
        if (!$this->isPost()) {
            $this->redirect('/forgot-password');
        }

        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect('/forgot-password');
        }

        $email = $this->postInput('email');

        $validator = Validator::make(['email' => $email])
            ->required('email', 'Email is required.')
            ->email('email', 'Please enter a valid email address.');

        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/forgot_password', $this->data);
            return;
        }

        $user = $this->userModel->findByEmail($email);

        // Always show success message to prevent email enumeration
        if ($user) {
            // Generate reset token
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Store token in database (you may need a password_resets table)
            $this->storeResetToken($user['id'], $token, $expiry);

            // Send email (implement email sending separately)
            $this->sendResetEmail($email, $token);
        }

        $this->flash('success', 'If an account exists with this email, you will receive a password reset link.');
        $this->redirect('/signin');
    }


    public function showResetPassword(): void
    {
        $token = $this->getInput('token');

        if (empty($token) || !$this->validateResetToken($token)) {
            $this->flash('error', 'Invalid or expired reset link.');
            $this->redirect('/forgot-password');
        }

        $this->data['token'] = $token;
        $this->data['csrf_token'] = $this->getCsrfToken();
        $this->view('auth/new_password', $this->data);
    }


    public function resetPassword(): void
    {
        if (!$this->isPost()) {
            $this->redirect('/forgot-password');
        }

        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect('/forgot-password');
        }

        $token = $this->postInput('token');
        $password = $this->postInput('password');
        $passwordConfirm = $this->postInput('password_confirm');

        // Validate token
        $resetData = $this->getResetTokenData($token);
        if (!$resetData) {
            $this->flash('error', 'Invalid or expired reset link.');
            $this->redirect('/forgot-password');
        }

        // Validate password
        $validator = Validator::make([
            'password' => $password,
            'password_confirm' => $passwordConfirm
        ])
            ->required('password', 'Password is required.')
            ->password('password', 'Password must be at least 8 characters with uppercase, lowercase, and a number.')
            ->required('password_confirm', 'Please confirm your password.')
            ->matches('password_confirm', 'password', 'Passwords do not match.');

        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->data['token'] = $token;
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->view('auth/new_password', $this->data);
            return;
        }

        // Update password
        $this->userModel->updatePassword($resetData['user_id'], $password);

        // Delete reset token
        $this->deleteResetToken($token);

        $this->flash('success', 'Password reset successful. Please log in with your new password.');
        $this->redirect('/signin');
    }

    /**
     * Store password reset token
     * Note: Requires a password_resets table in the database
     */
    private function storeResetToken(int|string $userId, string $token, string $expiry): void
    {
        $db = Database::getInstance();

        // Delete any existing tokens for this user
        $db->delete('password_resets', 'user_id = ?', [$userId]);

        // Insert new token
        $db->insert('password_resets', [
            'user_id' => $userId,
            'token' => hash('sha256', $token),
            'expires_at' => $expiry,
        ]);
    }


    private function validateResetToken(string $token): bool
    {
        return $this->getResetTokenData($token) !== null;
    }


    private function getResetTokenData(string $token): ?array
    {
        $db = Database::getInstance();
        $hashedToken = hash('sha256', $token);

        $result = $db->fetchOne(
            "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()",
            [$hashedToken]
        );

        return $result ?: null;
    }


    private function deleteResetToken(string $token): void
    {
        $db = Database::getInstance();
        $hashedToken = hash('sha256', $token);
        $db->delete('password_resets', 'token = ?', [$hashedToken]);
    }

    /**
     * Send password reset email
     * Note: Implement actual email sending based on your email service
     */
    private function sendResetEmail(string $email, string $token): void
    {
        $resetUrl = '/reset-password?token=' . $token;

        // TODO: Implement actual email sending
        // For now, log the reset URL in development
        if (APP_DEBUG) {
            error_log("Password reset URL for {$email}: {$resetUrl}");
        }
    }


    private function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }


    private function handleFileUpload(string $fieldName, string $subDir = ''): ?string
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $file = $_FILES[$fieldName];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Allowed file types for documents
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        // Create upload directory if it doesn't exist
        $uploadDir = dirname(__DIR__, 2) . '/public/uploads/' . $subDir;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $this->generateUuid() . '.' . $extension;
        $filepath = $uploadDir . $filename;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return '/uploads/' . $subDir . $filename;
        }

        return null;
    }


    private function storeUserDocuments(int $accountId, ?string $idDocPath, ?string $studentIdPath): void
    {
        $db = Database::getInstance();

        // Store ID document (document_type_id 1 = PASSPORT)
        if ($idDocPath) {
            $db->insert('user_document', [
                'id' => $this->generateUuid(),
                'account_id' => $accountId,
                'document_type_id' => 1,
                'document_path' => $idDocPath,
            ]);
        }

        // Store student ID (document_type_id 2 = STUDENT ID CARD)
        if ($studentIdPath) {
            $db->insert('user_document', [
                'id' => $this->generateUuid(),
                'account_id' => $accountId,
                'document_type_id' => 2,
                'document_path' => $studentIdPath,
            ]);
        }
    }
    // Google Login Placeholders
    public function googleRedirect(): void
    {
        // Placeholder for Google OAuth redirection
        // In a real app, this would construct the Google OAuth URL and redirect there
        $this->redirect('/auth/google/callback');
    }

    public function googleCallback(): void
    {
        // Placeholder for Google OAuth callback
        // In a real app, this would exchange the code for a token and get user info

        // Flash a message that this feature is coming soon
        $this->flash('success', 'Google Login is coming soon! (Placeholder)');
        $this->redirect('/login');
    }
}

