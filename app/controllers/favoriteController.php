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
        if (!Session::isLoggedIn()) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Please log in to save favorites.', 'login_required' => true], 401);
            } else {
                $this->flash('error', 'Please log in to save favorites.');
                $this->redirect(BASE_URL . '/auth/signin');
            }
            return;
        }

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
        if (!Session::isLoggedIn()) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Please log in.', 'login_required' => true], 401);
            } else {
                $this->flash('error', 'Please log in.');
                $this->redirect(BASE_URL . '/auth/signin');
            }
            return;
        }

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
     * Batch update favorites (add and remove multiple listings)
     * Used for syncing localStorage favorites with database
     */
    public function batch(): void
    {
        if (!Session::isLoggedIn()) {
            $this->json(['success' => false, 'error' => 'Please log in to save favorites.', 'login_required' => true], 401);
            return;
        }

        $profileId = $this->getUserProfileId();
        
        if (!$profileId) {
            $this->json(['success' => false, 'error' => 'Profile not found.'], 400);
            return;
        }

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        
        if (!isset($input['add']) && !isset($input['remove'])) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'error' => 'Invalid request format.'], 400);
            }
            return;
        }

        $added = 0;
        $removed = 0;
        $errors = [];

        if (isset($input['add']) && is_array($input['add'])) {
            foreach ($input['add'] as $listingId) {
                try {
                    if ($this->favoriteModel->add($profileId, $listingId) !== false) {
                        $added++;
                    }
                } catch (Exception $e) {
                    $errors[] = "Failed to add listing $listingId: " . $e->getMessage();
                }
            }
        }

        if (isset($input['remove']) && is_array($input['remove'])) {
            foreach ($input['remove'] as $listingId) {
                try {
                    if ($this->favoriteModel->remove($profileId, $listingId)) {
                        $removed++;
                    }
                } catch (Exception $e) {
                    $errors[] = "Failed to remove listing $listingId: " . $e->getMessage();
                }
            }
        }

        if ($this->isAjax()) {
            $this->json([
                'success' => true,
                'added' => $added,
                'removed' => $removed,
                'errors' => $errors,
                'message' => "Synced favorites: $added added, $removed removed"
            ]);
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
