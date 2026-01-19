<?php
require_once 'app/config.php';
require_once 'app/core/database.php';

$db = Database::getInstance();
try {
    echo "--- Report Table Schema ---\n";
    $columns = $db->fetchAll("DESCRIBE report");
    foreach ($columns as $col) {
        echo str_pad($col['Field'], 20) . " | " . $col['Type'] . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
