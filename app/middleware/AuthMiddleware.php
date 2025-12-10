<?php
/**
 * Authentication Middleware
 * 
 * Provides authentication and authorization checks for controllers.
 */

require_once dirname(__DIR__) . '/core/session.php';
require_once dirname(__DIR__) . '/config.php';

class AuthMiddleware
{
    /**
     * Check if user is authenticated
     * Redirects to login if not
     */
    public static function requireAuth(): void
    {
        Session::start();
        
        if (!Session::isLoggedIn()) {
            Session::setFlash('error', 'Please log in to access this page.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    /**
     * Check if user is a guest (not authenticated)
     * Redirects to dashboard if authenticated
     */
    public static function requireGuest(): void
    {
        Session::start();
        
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    /**
     * Check if user has admin role
     */
    public static function requireAdmin(): void
    {
        self::requireAuth();
        
        $user = Session::getUser();
        if (!$user || $user['role'] !== 'admin') {
            Session::setFlash('error', 'Access denied. Admin privileges required.');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    /**
     * Check if user has moderator or admin role
     */
    public static function requireModerator(): void
    {
        self::requireAuth();
        
        $user = Session::getUser();
        if (!$user || !in_array($user['role'], ['moderator', 'admin'])) {
            Session::setFlash('error', 'Access denied. Moderator privileges required.');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    /**
     * Check if user has approved status
     */
    public static function requireApproved(): void
    {
        self::requireAuth();
        
        $user = Session::getUser();
        if (!$user || $user['status'] !== 'approved') {
            Session::setFlash('error', 'Your account must be approved to access this feature.');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    /**
     * Check if user is the owner of a resource
     */
    public static function requireOwnership(int|string $ownerId): void
    {
        self::requireAuth();
        
        $user = Session::getUser();
        $isAdmin = $user && $user['role'] === 'admin';
        
        if (!$user || ($user['id'] != $ownerId && !$isAdmin)) {
            Session::setFlash('error', 'Access denied. You do not have permission to access this resource.');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    /**
     * Verify CSRF token from POST request
     */
    public static function verifyCsrf(): void
    {
        Session::start();
        
        $token = $_POST['csrf_token'] ?? '';
        
        if (!Session::verifyCsrfToken($token)) {
            Session::setFlash('error', 'Invalid request. Please try again.');
            header('Location: ' . $_SERVER['HTTP_REFERER'] ?? BASE_URL);
            exit;
        }
    }

    /**
     * Rate limiting check
     * Returns true if rate limit is exceeded
     */
    public static function checkRateLimit(string $key, int $maxAttempts = 5, int $decaySeconds = 60): bool
    {
        Session::start();
        
        $rateLimitKey = "_rate_limit_{$key}";
        $attempts = Session::get($rateLimitKey, []);
        
        // Remove expired attempts
        $now = time();
        $attempts = array_filter($attempts, fn($timestamp) => $timestamp > ($now - $decaySeconds));
        
        if (count($attempts) >= $maxAttempts) {
            return true; // Rate limit exceeded
        }
        
        // Add current attempt
        $attempts[] = $now;
        Session::set($rateLimitKey, $attempts);
        
        return false;
    }

    /**
     * Apply rate limiting and redirect if exceeded
     */
    public static function requireRateLimit(string $key, int $maxAttempts = 5, int $decaySeconds = 60): void
    {
        if (self::checkRateLimit($key, $maxAttempts, $decaySeconds)) {
            Session::setFlash('error', 'Too many attempts. Please try again later.');
            header('Location: ' . $_SERVER['HTTP_REFERER'] ?? BASE_URL);
            exit;
        }
    }

    /**
     * Check if request method is allowed
     */
    public static function requireMethod(string|array $methods): void
    {
        $methods = (array) $methods;
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        if (!in_array($requestMethod, $methods)) {
            http_response_code(405);
            header('Allow: ' . implode(', ', $methods));
            echo 'Method Not Allowed';
            exit;
        }
    }

    /**
     * Check if request is AJAX
     */
    public static function requireAjax(): void
    {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            http_response_code(400);
            echo 'Bad Request';
            exit;
        }
    }

    /**
     * Get current authenticated user or null
     */
    public static function user(): ?array
    {
        Session::start();
        return Session::getUser();
    }

    /**
     * Check if current user matches given ID
     */
    public static function isCurrentUser(int|string $userId): bool
    {
        $user = self::user();
        return $user && $user['id'] == $userId;
    }

    /**
     * Check if current user has specific role
     */
    public static function hasRole(string $role): bool
    {
        $user = self::user();
        return $user && $user['role'] === $role;
    }

    /**
     * Check if current user has any of the specified roles
     */
    public static function hasAnyRole(array $roles): bool
    {
        $user = self::user();
        return $user && in_array($user['role'], $roles);
    }
}
