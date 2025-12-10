<?php
/**
 * Simple Router for NestChange
 * Handles routing to view files and serving static assets
 */

session_start();
if (file_exists(__DIR__ . '/../core/database.php')) {
    require_once __DIR__ . '/../core/database.php';
}




// Get the request URI and remove query string
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$scriptDir = dirname($_SERVER['SCRIPT_NAME']);

// Remove the base path if running from public directory
if (strpos($requestUri, $scriptDir) === 0) {
    $path = substr($requestUri, strlen($scriptDir));
} else {
    $path = $requestUri;
}

// Remove leading/trailing slashes
$path = trim($path, '/');

if (isset($_GET['target']) && !empty($_GET['target'])) {
    
    $target = $_GET['target'];

    if ($target === 'listings') {
        $target = 'listing';
    }
    
    $controllerName = $target . 'Controller';
    $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        exit;
    }
}



// Debug: Log the path (remove in production)
// error_log("Request path: " . $path);

// Handle static assets (CSS, images, etc.)
if (strpos($path, 'assets/') === 0) {
    // Serve assets from public/assets/
    $assetFile = __DIR__ . '/' . $path;
    if (file_exists($assetFile)) {
        $mimeType = mime_content_type($assetFile);
        header('Content-Type: ' . $mimeType);
        readfile($assetFile);
        exit;
    }
}

// Handle CSS files
if (strpos($path, 'css/') === 0) {
    // Serve CSS from frontend/css/
    $cssFile = __DIR__ . '' . $path;
    if (file_exists($cssFile)) {
        header('Content-Type: text/css');
        readfile($cssFile);
        exit;
    }
}

// Default route
if (empty($path) || $path === 'index.php' || $path === 'public' || $path === 'public/index.php') {
    $path = 'home/index';
}

// Route mapping
$routes = [
    // Home
    'home' => 'home/index',
    'home/index' => 'home/index',
    
    // Auth routes
    'auth/signin' => 'auth/signin',
    'auth/sign-in' => 'auth/signin',
    'auth/login' => 'auth/signin',
    'auth/register' => 'auth/register',
    'auth/forgot-password' => 'auth/forgot_password',
    'auth/forgot_password' => 'auth/forgot_password',
    'auth/new-password' => 'auth/new_password',
    'auth/new_password' => 'auth/new_password',
    
    // Listings routes
    'listings' => 'listings/search',
    'listings/search' => 'listings/search',
    'listings/listing' => 'listings/listing',
    'listings/add' => 'listings/addListing',
    'listings/add-listing' => 'listings/addListing',
    'listings/addListing' => 'listings/addListing',
    'listings/exchange-details' => 'listings/exchange_details',
    'listings/exchange_details' => 'listings/exchange_details',
    'listings/my-exchanges' => 'listings/my_exchanges',
    'listings/my_exchanges' => 'listings/my_exchanges',
    
    // Profile routes
    'profile' => 'profile/profile',
    'profile/profile' => 'profile/profile',
    'profile/edit' => 'profile/edit_profile',
    'profile/edit-profile' => 'profile/edit_profile',
    'profile/edit_profile' => 'profile/edit_profile',
    'profile/public' => 'profile/public_profile',
    'profile/public-profile' => 'profile/public_profile',
    'profile/public_profile' => 'profile/public_profile',
    
    // Admin routes
    'admin' => 'admin/dashboard',
    'admin/dashboard' => 'admin/dashboard',
    
    // Moderator routes
    'moderator' => 'moderator/dashboard',
    'moderator/dashboard' => 'moderator/dashboard',
    
    // Chat routes
    'chat' => 'chat/index',
    'chat/index' => 'chat/index',
];

// Check if route exists in mapping
if (isset($routes[$path])) {
    $viewPath = $routes[$path];
} else {
    // Handle malformed paths (e.g., "authsignin" should be "auth/signin")
    // Try to fix common patterns
    $fixedPath = $path;
    
    // Fix paths like "authsignin" -> "auth/signin"
    if (preg_match('/^(auth)(signin|register|forgotpassword|forgot-password|newpassword|new-password)$/i', $path, $matches)) {
        $fixedPath = 'auth/' . strtolower($matches[2]);
        if (strtolower($matches[2]) === 'forgotpassword') $fixedPath = 'auth/forgot-password';
        if (strtolower($matches[2]) === 'newpassword') $fixedPath = 'auth/new-password';
    }
    
    // Also handle case where path is just "authsignin" (no separator at all)
    // This handles various malformed paths
    $lowerPath = strtolower($path);
    if ($lowerPath === 'authsignin' || $lowerPath === 'auth-signin') {
        $fixedPath = 'auth/signin';
    } elseif ($lowerPath === 'authregister' || $lowerPath === 'auth-register') {
        $fixedPath = 'auth/register';
    } elseif ($lowerPath === 'authforgotpassword' || $lowerPath === 'auth-forgot-password') {
        $fixedPath = 'auth/forgot-password';
    } elseif ($lowerPath === 'authnewpassword' || $lowerPath === 'auth-new-password') {
        $fixedPath = 'auth/new-password';
    }
    
    // Fix paths like "listingslisting" -> "listings/listing"
    if (preg_match('/^(listings)(listing|addlisting|add-listing|exchangedetails|exchange-details|myexchanges|my-exchanges)$/i', $path, $matches)) {
        $fixedPath = 'listings/' . strtolower($matches[2]);
        if ($matches[2] === 'addlisting') $fixedPath = 'listings/add-listing';
        if ($matches[2] === 'exchangedetails') $fixedPath = 'listings/exchange-details';
        if ($matches[2] === 'myexchanges') $fixedPath = 'listings/my-exchanges';
    }
    
    // Try the fixed path first
    if (isset($routes[$fixedPath])) {
        $viewPath = $routes[$fixedPath];
    } else {
        // Try to use the path directly if it matches a view file
        $viewPath = $path;
    }
}

// Build the full path to the view file
$viewFile = __DIR__ . '/../app/views/' . $viewPath . '.php';

// Check if the view file exists
if (file_exists($viewFile)) {
    // Include the view file
    require $viewFile;
} else {
    // 404 - View not found
    http_response_code(404);
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }
        .error-container {
            text-align: center;
        }
        h1 {
            font-size: 72px;
            margin: 0;
            color: #333;
        }
        p {
            font-size: 18px;
            color: #666;
            margin: 20px 0;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <p>Page not found</p>
        <p><a href="/">Go to Home</a></p>
        <p><small>Requested path: ' . htmlspecialchars($path) . '</small></p>
    </div>
</body>
</html>';
}
