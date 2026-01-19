<?php
/**
 * Favorite Controller
 * 
 * Handles user favorites functionality.
 */

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/models/Favorite.php';

class FavoriteController extends Controller
{
    private Favorite $favoriteModel;

    private function debugLog($message) {
        file_put_contents('/var/www/html/NestChange/public/debug_fav.log', date('[Y-m-d H:i:s] ') . $message . "\n", FILE_APPEND);
    }

    public function __construct()
    {
        parent::__construct();
        $this->favoriteModel = new Favorite();
    }

    /**
     * Display user's favorited listings
     */
    public function index(): void
    {
        $this->requireAuth();
        
        $user = $this->currentUser();
        if (!$user) {
            $this->flash('error', 'Please log in to view favorites.');
            $this->redirect(BASE_URL . '/auth/signin');
            return;
        }
        
        $profileId = $this->getUserProfileId();
        
        if (!$profileId) {
            $this->flash('error', 'Please complete your profile first.');
            $this->redirect(BASE_URL . '/profile');
            return;
        }

        try {
            $favorites = $this->favoriteModel->getByUser($profileId);
            
            $pageTitle = 'My Favorites - NestChange';
            $activeNav = 'favorites';
            $breadcrumbs = [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'My Favorites'],
            ];
            
            $this->view('favorites/index', [
                'favorites' => $favorites ?? [],
                'csrf_token' => $this->getCsrfToken()
            ]);
        } catch (Exception $e) {
            error_log('Favorites index error: ' . $e->getMessage());
            $this->flash('error', 'Unable to load favorites. Please try again.');
            $this->redirect(BASE_URL . '/');
        }
    }

    /**
     * Add a listing to favorites
     * 
     * @param string $id Listing ID
     */
    public function favorite(string $id): void
    {
        // Check if user is logged in
        if (!Session::isLoggedIn()) {
            $this->debugLog("User not logged in");
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Please log in to save favorites.', 'login_required' => true], 401);
            } else {
                $this->flash('error', 'Please log in to save favorites.');
                $this->redirect(BASE_URL . '/login');
            }
            return;
        }

        $this->debugLog("Request ID: $id. IsAjax: " . ($this->isAjax() ? 'Yes' : 'No') . ". CSRF verify: " . ($this->verifyCsrf() ? 'Pass' : 'Fail'));

        // Verify CSRF for non-AJAX requests
        if (!$this->isAjax() && !$this->verifyCsrf()) {
            $this->debugLog("CSRF Failed");
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . '/listings/' . $id);
            return;
        }

        $profileId = $this->getUserProfileId();
        
        if (!$profileId) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Profile not found.'], 400);
            } else {
                $this->flash('error', 'Profile not found.');
                $this->redirect(BASE_URL . '/listings/' . $id);
            }
            return;
        }

        $result = $this->favoriteModel->add($profileId, $id);
        
        if ($this->isAjax()) {
            $this->json([
                'success' => true,
                'favorited' => true,
                'message' => 'Added to favorites'
            ]);
        } else {
            $this->flash('success', 'Added to favorites!');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
    }

    /**
     * Remove a listing from favorites
     * 
     * @param string $id Listing ID
     */
    public function unfavorite(string $id): void
    {
        // Check if user is logged in
        if (!Session::isLoggedIn()) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Please log in.', 'login_required' => true], 401);
            } else {
                $this->flash('error', 'Please log in.');
                $this->redirect(BASE_URL . '/login');
            }
            return;
        }

        // Verify CSRF for non-AJAX requests
        if (!$this->isAjax() && !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . '/listings/' . $id);
            return;
        }

        $profileId = $this->getUserProfileId();
        
        if (!$profileId) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Profile not found.'], 400);
            } else {
                $this->flash('error', 'Profile not found.');
                $this->redirect(BASE_URL . '/listings/' . $id);
            }
            return;
        }

        $this->favoriteModel->remove($profileId, $id);
        
        if ($this->isAjax()) {
            $this->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Removed from favorites'
            ]);
        } else {
            $this->flash('success', 'Removed from favorites.');
            $this->redirect($_SERVER['HTTP_REFERER'] ?? BASE_URL . '/favorites');
        }
    }

    /**
     * Get user's profile ID
     * 
     * @return string|null
     */
    private function getUserProfileId(): ?string
    {
        $user = $this->currentUser();
        if (!$user) {
            return null;
        }

        require_once dirname(__DIR__) . '/models/user.php';
        $userModel = new User();
        $fullUser = $userModel->getUserWithProfile($user['id']);
        
        return $fullUser['profile_id'] ?? null;
    }
}
