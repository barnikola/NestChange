<?php
// Load core files
require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/core/router.php';
require_once __DIR__ . '/../app/core/database.php';
require_once __DIR__ . '/../app/core/session.php';
require_once __DIR__ . '/../app/core/model.php';
require_once __DIR__ . '/../app/core/controller.php';

// Start session with secure settings
Session::start();

// Create router instance
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = str_replace('\\', '/', $basePath); // Normalize for Windows
$router = new Router($basePath);
$cacheFile = __DIR__ . '/../app/cache/routes.php';

// CHECK: Do we have a cached version?
if (file_exists($cacheFile) && getenv('APP_ENV') !== 'development') {
    
    // --- FAST PATH ---
    // Load the array directly from the file
    $cachedRoutes = require $cacheFile;
    $router->setRoutes($cachedRoutes);

} else {

    // --- SLOW PATH (First Run) ---
    // ====== Authentication Routes ======
    $router->get('/login', ['AuthController', 'showLogin']);
    $router->get('/signin', ['AuthController', 'showLogin']);
    $router->get('/auth/signin', ['AuthController', 'showLogin']);
    $router->get('/auth/login', ['AuthController', 'showLogin']);
    $router->post('/login', ['AuthController', 'login']);
    $router->post('/signin', ['AuthController', 'login']);
    $router->post('/auth/login', ['AuthController', 'login']);

    $router->get('/register', ['AuthController', 'showRegister']);
    $router->get('/auth/register', ['AuthController', 'showRegister']);
    $router->post('/register', ['AuthController', 'register']);
    $router->post('/auth/register', ['AuthController', 'register']);

    $router->get('/logout', ['AuthController', 'logout']);
    $router->post('/logout', ['AuthController', 'logout']);
    $router->get('/auth/logout', ['AuthController', 'logout']);

    $router->get('/forgot-password', ['AuthController', 'showForgotPassword']);
    $router->get('/auth/forgot-password', ['AuthController', 'showForgotPassword']);
    $router->post('/forgot-password', ['AuthController', 'forgotPassword']);
    $router->post('/auth/forgot-password', ['AuthController', 'forgotPassword']);

    $router->get('/reset-password', ['AuthController', 'showResetPassword']);
    $router->get('/auth/reset-password', ['AuthController', 'showResetPassword']);
    $router->post('/reset-password', ['AuthController', 'resetPassword']);
    $router->post('/auth/reset-password', ['AuthController', 'resetPassword']);

    // ====== Home Routes ======
    $router->get('/', ['HomeController', 'index']);
    $router->get('/home', ['HomeController', 'index']);

    // ====== Legal Routes ======
    $router->get('/legal/{type}', ['LegalController', 'show']);

    // ====== Listing Routes ======
    $router->get('/listings', ['ListingController', 'index']);
    $router->get('/listings/search', ['ListingController', 'search']);
    $router->get('/listings/create', ['ListingController', 'create']);
    $router->post('/listings/create', ['ListingController', 'store']);
    // Specific routes must come before parameterized routes
    $router->get('/listings/my-listings', ['ListingController', 'myListings']);
    $router->get('/my-listings', ['ListingController', 'myListings']);
    // Parameterized routes
    $router->get('/listings/{id}', ['ListingController', 'show']);
    $router->get('/listings/{id}/edit', ['ListingController', 'edit']);
    $router->post('/listings/{id}/edit', ['ListingController', 'update']);
    $router->post('/listings/{id}/delete', ['ListingController', 'destroy']);
    $router->post('/listings/{id}/publish', ['ListingController', 'publish']);
    $router->post('/listings/{id}/pause', ['ListingController', 'pause']);
    $router->post('/listings/{id}/unpause', ['ListingController', 'unpause']);
    $router->post('/listings/{listingId}/images/{imageId}/delete', ['ListingController', 'deleteImage']);

    // ====== Favorites Routes ======
    $router->get('/favorites', ['FavoriteController', 'index']);
    $router->post('/listings/{id}/favorite', ['FavoriteController', 'favorite']);
    $router->post('/listings/{id}/unfavorite', ['FavoriteController', 'unfavorite']);

    // ====== Exchange Routes ======
    $router->get('/listings/my-exchanges', ['ExchangeController', 'myExchanges']);
    $router->get('/listings/exchange-details', ['ExchangeController', 'exchangeDetails']);

    // ====== Review Routes ======
    $router->get('/listings/{listingId}/reviews', ['ReviewController', 'index']);
    $router->get('/bookings/{bookingId}/review', ['ReviewController', 'show']);
    $router->post('/bookings/{bookingId}/reviews', ['ReviewController', 'create']);

    // ====== Profile Routes ======
    $router->get('/profile', ['ProfileController', 'index']);
    $router->get('/profile/edit', ['ProfileController', 'edit']);
    $router->post('/profile/edit', ['ProfileController', 'update']);
    $router->post('/profile/update', ['ProfileController', 'update']);
    $router->get('/profile/{id}', ['ProfileController', 'show']);
    $router->post('/profile/upload-document', ['ProfileController', 'uploadDocument']);

    // ====== Application Routes ======
    $router->get('/my-applications', ['ApplicationController', 'myApplications']);
    $router->get('/received-applications', ['ApplicationController', 'receivedApplications']);
    $router->get('/applications/{id}', ['ApplicationController', 'show']);
    $router->get('/listings/{listingId}/apply', ['ApplicationController', 'create']);
    $router->post('/listings/{listingId}/apply', ['ApplicationController', 'store']);
    $router->post('/applications/{id}/accept', ['ApplicationController', 'accept']);
    $router->post('/applications/{id}/reject', ['ApplicationController', 'reject']);
    $router->post('/applications/{id}/withdraw', ['ApplicationController', 'withdraw']);
    $router->post('/applications/{id}/cancel', ['ApplicationController', 'cancel']);
    $router->get('/applications/list.json', ['ApplicationController', 'listJson']);

    // ====== API/AJAX Routes ======
    $router->get('/api/listings/search', ['ListingController', 'search']);
    $router->post('/notifications/trigger-approval', ['NotificationController', 'triggerApproval']);
    $router->get('/notifications', ['NotificationController', 'index']);

    // ====== Chat Routes ======
    $router->get('/chat', ['ChatController', 'index']);
    $router->get('/chat/{profileId}', ['ChatController', 'startChat']);
    $router->post('/chat/send', ['ChatController', 'sendMessage']);
    $router->get('/chat/messages', ['ChatController', 'getMessages']);
    $router->get('/chat/search', ['ChatController', 'search']);
    $router->get('/chat/details', ['ChatController', 'getChatDetails']);

    // ====== Admin Routes ======
    $router->get('/admin', ['AdminController', 'index']);
    $router->get('/admin/dashboard', ['AdminController', 'index']);
    
    // Admin: Users
    $router->get('/admin/users', ['AdminController', 'users']);
    $router->post('/admin/users/approve', ['AdminController', 'approveUser']);
    $router->post('/admin/users/suspend', ['AdminController', 'suspendUser']);
    $router->post('/admin/users/delete', ['AdminController', 'deleteUser']);
    
    // Admin: Documents
    $router->get('/admin/documents', ['AdminController', 'documents']);
    $router->post('/admin/documents/approve', ['AdminController', 'approveDocument']);
    
    // Admin: Listings
    $router->get('/admin/listings', ['AdminController', 'listings']);
    $router->post('/admin/listings/publish', ['AdminController', 'publishListing']);
    $router->post('/admin/listings/pause', ['AdminController', 'pauseListing']);
    $router->post('/admin/listings/delete', ['AdminController', 'deleteListing']);

    // Admin: Legal Content
    $router->get('/admin/legal', ['AdminController', 'legal']);
    $router->get('/admin/legal/edit/{type}', ['AdminController', 'editLegal']);
    $router->post('/admin/legal/update', ['AdminController', 'updateLegal']);

    // ====== Moderator Routes ======
    $router->get('/moderator', ['ModeratorController', 'index']);
    $router->get('/moderator/dashboard', ['ModeratorController', 'index']);
    
    // Moderator: Listings
    $router->get('/moderator/listings', ['ModeratorController', 'listings']);
    $router->post('/moderator/listings/publish', ['ModeratorController', 'publishListing']);
    $router->post('/moderator/listings/pause', ['ModeratorController', 'pauseListing']);
    $router->post('/moderator/listings/delete', ['ModeratorController', 'deleteListing']);
    
    // Moderator: Documents
    $router->get('/moderator/documents', ['ModeratorController', 'documents']);
    $router->post('/moderator/documents/approve', ['ModeratorController', 'approveDocument']);

    // ====== Static Pages ======
    $router->get('/faq', ['StaticController', 'faq']);
    $router->get('/contact', ['StaticController', 'contact']);
    $router->post('/contact', ['StaticController', 'contact']);
    $router->get('/legal', ['StaticController', 'legal']);

    // AFTER defining all routes, save them to the cache file
    // We use var_export to turn the array into PHP code
    if (getenv('APP_ENV') !== 'development') {
        $cacheDir = dirname($cacheFile);
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }
        file_put_contents($cacheFile, '<?php return ' . var_export($router->getRoutes(), true) . ';');
    }
}

// Dispatch the request
$router->dispatch();
