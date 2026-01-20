<?php

// Load environment variables from .env file
$envPath = dirname(__DIR__) . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Application Environment
define('APP_ENV', getenv('APP_ENV') ?: 'development');
define('APP_DEBUG', APP_ENV === 'development');

ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__) . '/app/storage/logs/php_error.log');

// Timezone (used for formatting/display)
define('APP_TIMEZONE', getenv('APP_TIMEZONE') ?: 'Europe/Paris');
date_default_timezone_set(APP_TIMEZONE);

// Database Configuration
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'nestchange');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

// Application URL Configuration
// If running via web server, prefer to detect the base URL from the request
$envBase = getenv('BASE_URL') ?: '';
if (php_sapi_name() === 'cli' || empty($_SERVER['HTTP_HOST'])) {
    define('BASE_URL', $envBase ?: 'http://localhost:8080');
} else {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $detected = $scheme . '://' . $host . ($scriptDir !== '' ? $scriptDir : '');

    // If an env BASE_URL was provided and it matches the current host, use it;
    // otherwise use the detected URL so links work when served from a subpath.
    if (!empty($envBase) && strpos($envBase, $host) !== false) {
        define('BASE_URL', rtrim($envBase, '/'));
    } else {
        define('BASE_URL', rtrim($detected, '/'));
    }
}
define('APP_ROOT', dirname(__DIR__));

// Session Configuration
define('SESSION_NAME', 'nestchange_session');
define('SESSION_LIFETIME', 3600); // 1 hour

// Security Configuration
define('PASSWORD_ALGO', PASSWORD_BCRYPT);
define('PASSWORD_COST', 12);

// File Upload Configuration
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
