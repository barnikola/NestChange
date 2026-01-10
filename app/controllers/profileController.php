<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/helpers/Validator.php';

class ProfileController extends Controller
{
    private User $userModel;
    private Listing $listingModel;
    private Review $reviewModel;
    private Exchange $exchangeModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = $this->model('User');
        $this->listingModel = $this->model('Listing');
        $this->reviewModel = $this->model('Review');
        $this->exchangeModel = $this->model('Exchange');
    }

    public function index(): void
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/signin');
        }

        $user = Session::getUser();

        // Fetch full profile data
        $fullUser = $this->userModel->getUserWithProfile($user['id']);

        // Fetch uploaded documents
        $db = Database::getInstance();
        $documents = $db->fetchAll("SELECT * FROM user_document WHERE account_id = ?", [$user['id']]);

        $listingStats = [
            'total' => 0,
            'published' => 0,
            'draft' => 0,
        ];

        $exchangeStats = [
            'active' => 0,
            'upcoming' => 0,
            'completed' => 0,
        ];

        $recentExchanges = [];

        if (!empty($fullUser['profile_id'])) {
            $hostListings = $this->listingModel->getByHostProfile($fullUser['profile_id']);
            $listingStats['total'] = count($hostListings);
            $listingStats['published'] = count(array_filter($hostListings, fn($listing) => ($listing['status'] ?? '') === 'published'));
            $listingStats['draft'] = max(0, $listingStats['total'] - $listingStats['published']);

            $recentExchanges = $this->exchangeModel->getExchangesForUser($user['id'], $fullUser['profile_id']);
            foreach ($recentExchanges as $exchange) {
                $status = $exchange['status'] ?? 'upcoming';
                if (isset($exchangeStats[$status])) {
                    $exchangeStats[$status]++;
                }
            }
        }

        $this->data['user'] = $fullUser;
        $this->data['documents'] = $documents;
        $this->data['listingStats'] = $listingStats;
        $this->data['exchangeStats'] = $exchangeStats;
        $this->data['recentExchanges'] = array_slice($recentExchanges, 0, 4);

        $this->view('profile/profile', $this->data);
    }

    public function show(string $profileId): void
    {
        $profile = $this->userModel->getPublicProfile($profileId);

        if (!$profile) {
            $this->flash('error', 'Profile not found.');
            $this->redirect(BASE_URL . '/listings');
        }

        $listings = $this->listingModel->getByHostProfile($profileId);
        $stats = [
            'total_listings' => count($listings),
            'published_listings' => count(array_filter($listings, fn($listing) => ($listing['status'] ?? '') === 'published')),
        ];
        $reviewSummary = $this->reviewModel->getProfileReviewSummary($profileId);
        $hostReviews = $this->reviewModel->getProfileReviews($profileId, 'host');
        $guestReviews = $this->reviewModel->getProfileReviews($profileId, 'guest');

        $this->data['profile'] = $profile;
        $this->data['listings'] = $listings;
        $this->data['stats'] = $stats;
        $this->data['reviewSummary'] = $reviewSummary;
        $this->data['hostReviews'] = $hostReviews;
        $this->data['guestReviews'] = $guestReviews;

        $this->view('profile/public_profile', $this->data);
    }

    public function edit(): void
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/signin');
        }

        $user = Session::getUser();
        $fullUser = $this->userModel->getUserWithProfile($user['id']);

        $this->data['user'] = $fullUser;
        $this->data['csrf_token'] = $this->getCsrfToken();

        $this->view('profile/edit_profile', $this->data);
    }

    public function update(): void
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/signin');
        }

        if (!$this->isPost()) {
            $this->redirect('/profile/edit');
        }

        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect('/profile/edit');
        }

        $user = Session::getUser();
        $data = $this->allPost();

        // Validate
        $validator = Validator::make($data)
            ->required('first_name', 'First name is required.')
            ->required('last_name', 'Last name is required.');

        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->redirect('/profile/edit');
        }

        // Handle File Uploads (ID/Proof)
        // Storing in temp/uploads/ as requested
        $idDocPath = $this->handleFileUpload('id_document', 'temp/uploads/');

        // Update Profile Data
        $updateData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'bio' => $data['bio'] ?? null,
            'city' => $data['city'] ?? null,
            'country' => $data['country'] ?? null,
            'languages' => $data['languages'] ?? null,
            'accessibility_needs' => $data['accessibility_needs'] ?? null,
        ];

        // Handle Profile Picture if uploaded (optional extension)
        $avatarPath = $this->handleFileUpload('profile_picture', 'avatars/');
        if ($avatarPath) {
            $updateData['profile_picture'] = $avatarPath;
        }

        if ($this->userModel->updateProfile($user['id'], $updateData)) {
            $msg = 'Profile updated successfully.';
            if ($idDocPath) {
                $msg .= ' Document uploaded to temporary storage.';
            }
            $this->flash('success', $msg);
        } else {
            $this->flash('error', 'Failed to update profile.');
        }

        $this->redirect('/profile');
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

        // Allowed file types
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!in_array($file['type'], $allowedTypes)) {
            return null;
        }

        // Create upload directory if it doesn't exist
        $publicDir = dirname(__DIR__, 2) . '/public';
        $uploadDir = $publicDir . '/' . ($subDir ?: 'uploads/');

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension; // simpler unique id
        $filepath = $uploadDir . $filename;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            // Return path relative to public
            return $subDir . $filename;
        }

        return null;
    }
}
