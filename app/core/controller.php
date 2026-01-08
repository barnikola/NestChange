<?php
/**
 * Base Controller Class
 * 
 * Provides common functionality for all controllers including
 * view rendering, model loading, and input handling.
 */

require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/session.php';

abstract class Controller
{
    protected array $data = [];

    public function __construct()
    {
        // Initialize session
        Session::start();
    }

    /**
     * Load and render a view
     * 
     * @param string $view Path to view file (relative to views directory)
     * @param array $data Data to pass to the view
     * @return void
     */
    protected function view(string $view, array $data = []): void
    {
        $data = array_merge($this->data, $data);
        extract($data);
        
        $viewPath = dirname(__DIR__) . '/views/' . $view . '.php';
        
        if (!file_exists($viewPath)) {
            throw new Exception("View not found: {$view}");
        }
        
        require $viewPath;
    }

    /**
     * Load a model
     * 
     * @param string $model Model class name
     * @return object
     */
    protected function model(string $model): object
    {
        $modelPath = dirname(__DIR__) . '/models/' . strtolower($model) . '.php';
        
        if (!file_exists($modelPath)) {
            throw new Exception("Model not found: {$model}");
        }
        
        require_once $modelPath;
        return new $model();
    }

    /**
     * Redirect to another URL
     * 
     * @param string $url URL to redirect to
     * @param int $statusCode HTTP status code
     * @return void
     */
    protected function redirect(string $url, int $statusCode = 302): void
    {
        header("Location: {$url}", true, $statusCode);
        exit;
    }

    /**
     * Send JSON response
     * 
     * @param mixed $data Data to encode as JSON
     * @param int $statusCode HTTP status code
     * @return void
     */
    protected function json(mixed $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Get sanitized input from GET request
     * 
     * @param string $key Input key
     * @param mixed $default Default value if key doesn't exist
     * @return mixed
     */
    protected function getInput(string $key, mixed $default = null): mixed
    {
        return isset($_GET[$key]) ? $this->sanitize($_GET[$key]) : $default;
    }

    /**
     * Get sanitized input from POST request
     * 
     * @param string $key Input key
     * @param mixed $default Default value if key doesn't exist
     * @return mixed
     */
    protected function postInput(string $key, mixed $default = null): mixed
    {
        return isset($_POST[$key]) ? $this->sanitize($_POST[$key]) : $default;
    }

    /**
     * Get all POST data
     * 
     * @return array
     */
    protected function allPost(): array
    {
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->sanitize($value);
        }
        return $data;
    }

    /**
     * Sanitize input data
     * 
     * @param mixed $data Data to sanitize
     * @return mixed
     */
    protected function sanitize(mixed $data): mixed
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Check if request is POST
     * 
     * @return bool
     */
    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check if request is GET
     * 
     * @return bool
     */
    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Check if request is AJAX
     * 
     * @return bool
     */
    protected function isAjax(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Set flash message
     * 
     * @param string $type Message type (success, error, warning, info)
     * @param string $message The message
     * @return void
     */
    protected function flash(string $type, string $message): void
    {
        Session::setFlash($type, $message);
    }

    /**
     * Get flash message
     * 
     * @param string $type Message type
     * @return string|null
     */
    protected function getFlash(string $type): ?string
    {
        return Session::getFlash($type);
    }

    /**
     * Require user to be authenticated
     * 
     * @return void
     */
    protected function requireAuth(): void
    {
        if (!Session::isLoggedIn()) {
            $this->flash('error', 'Please log in to access this page.');
            $this->redirect(BASE_URL . '/login');
        }
    }

    /**
     * Get current authenticated user
     * 
     * @return array|null
     */
    protected function currentUser(): ?array
    {
        return Session::getUser();
    }

    /**
     * Verify CSRF token
     * 
     * @return bool
     */
    protected function verifyCsrf(): bool
    {
        $token = $this->postInput('csrf_token');
        return Session::verifyCsrfToken($token ?? '');
    }

    /**
     * Generate and get CSRF token
     * 
     * @return string
     */
    protected function getCsrfToken(): string
    {
        return Session::getCsrfToken();
    }
}
