<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/helpers/EmailService.php';

class StaticController extends Controller
{
    public function faq(): void
    {
        $this->view('static/faq', [
            'title' => 'Frequency Asked Questions'
        ]);
    }

    public function contact(): void
    {
        $data = [
            'title' => 'Contact Us',
            'errors' => [],
            'success' => null,
            'user' => null
        ];

        if (Session::isLoggedIn()) {
            $userModel = $this->model('User');
            $user = $userModel->find(Session::getUserId());
            if ($user) {
                // Fetch profile for name using User model
                $userWithProfile = $userModel->getUserWithProfile($user['id']);
                
                $data['user'] = [
                    'name' => $userWithProfile ? ($userWithProfile['first_name'] . ' ' . $userWithProfile['last_name']) : '',
                    'email' => $user['email']
                ];
            }
        }

        if ($this->isPost()) {
            $name = $this->postInput('name');
            $email = $this->postInput('email');
            $subject = $this->postInput('subject');
            $message = $this->postInput('message');

            // Basic Validation
            if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                $data['errors'][] = 'All fields are required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors'][] = 'Invalid email format.';
            } else {
                // Save to Reports Table
                $reporterId = null;
                if (Session::isLoggedIn()) {
                    $userId = Session::getUserId();
                    $userModel = $this->model('User');
                    $profile = $userModel->getUserWithProfile($userId);
                    // Constraint requires user_profile.id, not account.id
                    $reporterId = $profile['profile_id'] ?? null; 
                }
                
                // Format description as plain text (like listing reports)
                $description = "Subject: " . $subject . "\n";
                $description .= "Name: " . $name . "\n";
                $description .= "Email: " . $email . "\n\n";
                $description .= "Message:\n" . $message;

                try {
                    $reportModel = $this->model('Report');
                    $reportModel->createReport(
                        $reporterId, 
                        'system', 
                        0, 
                        'contact', 
                        $description
                    );
                    $data['success'] = 'Thank you! Your message has been sent.';
                } catch (Exception $e) {
                    error_log("Contact Form Error: " . $e->getMessage());
                    $data['errors'][] = 'Failed to save message. Please try again later.';
                    // error_log($e->getMessage());
                }
            }
        }

        $this->view('static/contact', $data);
    }

    public function legal(): void
    {
        // Default to 'terms' if no type specified
        $type = $_GET['type'] ?? 'terms';
        
        // Allowed types to prevent SQL injection or invalid queries via URL
        $allowedTypes = ['terms', 'privacy', 'cookies'];
        if (!in_array($type, $allowedTypes)) {
            $type = 'terms';
        }

        // Fetch content from database
        $db = Database::getInstance();
        $content = $db->fetchOne("SELECT * FROM legal_content WHERE type = ?", [$type]);

        $this->view('static/legal', [
            'title' => ucfirst($type) . ' - Legal',
            'currentType' => $type,
            'content' => $content
        ]);
    }
}
