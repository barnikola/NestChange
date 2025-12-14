<?php
/**
 * Router Class
 * 
 * Handles routing HTTP requests to controllers and actions.
 */

class Router
{
    private array $routes = [];
    private string $basePath;

    public function __construct(string $basePath = '')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    function getRoutes(): array{
        return $this->routes;
    }

    function setRoutes($routes): void{
        $this->routes = $routes;
    }

    /**
     * Add a GET route
     */
    public function get(string $path, string|array $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    /**
     * Add a POST route
     */
    public function post(string $path, string|array $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    /**
     * Add any HTTP method route
     */
    public function any(string $path, string|array $handler): void
    {
        $this->addRoute('*', $path, $handler);
    }

    /**
     * Add a route
     */
    private function addRoute(string $method, string $path, string|array $handler): void
    {
        $path = '/' . trim($path, '/');
        $this->routes[$method][$path] = $handler;
    }

    /**
     * Dispatch the request
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove base path
        if ($this->basePath && strpos($uri, $this->basePath) === 0) {
            $uri = substr($uri, strlen($this->basePath));
        }
        
        $uri = '/' . trim($uri, '/');
        if ($uri === '/') $uri = '/';
        
        // Try exact match first
        $handler = $this->findHandler($method, $uri);
        
        if ($handler) {
            $this->executeHandler($handler);
            return;
        }
        
        // Try pattern matching
        foreach ($this->routes[$method] ?? [] as $pattern => $patternHandler) {
            if ($this->matchPattern($pattern, $uri, $params)) {
                $this->executeHandler($patternHandler, $params);
                return;
            }
        }
        
        // Try wildcard routes
        foreach ($this->routes['*'] ?? [] as $pattern => $patternHandler) {
            if ($this->matchPattern($pattern, $uri, $params)) {
                $this->executeHandler($patternHandler, $params);
                return;
            }
        }
        
        // Debugging 404
        // echo "URI: $uri <br>";
        // echo "Method: $method <br>";
        // echo "Available Routes: <pre>" . print_r($this->routes[$method], true) . "</pre>";
        
        // 404 Not Found
        $this->notFound();
    }

    /**
     * Find handler for exact route
     */
    private function findHandler(string $method, string $uri): string|array|null
    {
        // Try exact match
        if (isset($this->routes[$method][$uri])) {
            return $this->routes[$method][$uri];
        }
        
        // Try wildcard
        if (isset($this->routes['*'][$uri])) {
            return $this->routes['*'][$uri];
        }
        
        return null;
    }

    /**
     * Match pattern with parameters
     */
    private function matchPattern(string $pattern, string $uri, &$params = []): bool
    {
        $params = [];
        
        // Convert pattern to regex
        $regex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $pattern);
        $regex = '#^' . $regex . '$#';
        
        if (preg_match($regex, $uri, $matches)) {
            array_shift($matches); // Remove full match
            
            // Extract parameter names
            preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $pattern, $paramNames);
            $paramNames = $paramNames[1];
            
            // Combine names with values
            for ($i = 0; $i < count($paramNames); $i++) {
                $params[$paramNames[$i]] = $matches[$i] ?? null;
            }
            
            return true;
        }
        
        return false;
    }

    /**
     * Execute the handler
     */
    private function executeHandler(string|array $handler, array $params = []): void
    {
        if (is_string($handler)) {
            // Handler is a view file path
            $this->renderView($handler);
        } elseif (is_array($handler) && count($handler) === 2) {
            // Handler is [ControllerClass, method]
            list($controllerClass, $method) = $handler;
            
            // Load controller file
            $controllerFile = dirname(__DIR__) . '/controllers/' . strtolower(str_replace('Controller', '', $controllerClass)) . 'Controller.php';
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
            }
            
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                
                if (method_exists($controller, $method)) {
                    // Call method with parameters
                    call_user_func_array([$controller, $method], array_values($params));
                } else {
                    $this->error("Method {$method} not found in {$controllerClass}");
                }
            } else {
                $this->error("Controller {$controllerClass} not found");
            }
        }
    }

    /**
     * Render a view file
     */
    private function renderView(string $viewPath): void
    {
        $viewFile = dirname(__DIR__) . '/views/' . $viewPath . '.php';
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            $this->notFound();
        }
    }

    /**
     * 404 Not Found response
     */
    private function notFound(): void
    {
        http_response_code(404);
        
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
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
        <p>Requested path: ' . htmlspecialchars($uri) . '</p>
        <div style="text-align: left; background: #eee; padding: 10px; margin: 10px; overflow: auto; max-width: 800px; max-height: 400px;">
            <strong>Debug Info:</strong><br>
            Method: ' . htmlspecialchars($method) . '<br>
            Routes checked:<br>
            <pre>';
            
        foreach ($this->routes[$method] ?? [] as $pattern => $handler) {
            echo "Pattern: " . htmlspecialchars($pattern) . "<br>";
            // Simple regex check for debug display
            $regex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $pattern);
            $regex = '#^' . $regex . '$#';
            // Note: This matches against raw URI which might fail if base path stripping logic was involved in dispatch
            // But sufficient for debug output
            echo "Regex: " . htmlspecialchars($regex) . "<br>";
            echo "-------------------<br>";
        }
        
        echo '</pre>
        </div>
        <p><a href="/">Go to Home</a></p>
    </div>
</body>
</html>';
        exit;
    }

    /**
     * Error response
     */
    private function error(string $message): void
    {
        http_response_code(500);
        echo "Error: " . htmlspecialchars($message);
        exit;
    }
}
