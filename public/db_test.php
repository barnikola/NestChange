<?php
require_once __DIR__ . '/../app/config.php';

echo "Attempting connection to:\n";
echo "Host: " . DB_HOST . "\n";
echo "User: " . DB_USER . "\n";
echo "Pass: " . (DB_PASS ? '********' : '(empty)') . "\n";
echo "DB:   " . DB_NAME . "\n";
echo "--------------------------\n";

try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Server connection successful.\n";
    
    // Check if DB exists
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
    if ($stmt->fetch()) {
        echo "Database '" . DB_NAME . "' exists.\n";
        echo "Checking for tables...\n";
        $pdo->exec("USE `" . DB_NAME . "`");
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (empty($tables)) {
            echo "WARNING: Database is empty (no tables found).\n";
        } else {
            echo "Tables found: " . implode(", ", $tables) . "\n";
        }
    } else {
        echo "ERROR: Database '" . DB_NAME . "' does NOT exist.\n";
        echo "Available databases:\n";
        $stmt = $pdo->query("SHOW DATABASES");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "- " . $row['Database'] . "\n";
        }
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
