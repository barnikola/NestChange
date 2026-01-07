<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/core/database.php';

try {
    $db = Database::getInstance();

    // Check if columns exist
    $columns = $db->fetchAll("SHOW COLUMNS FROM user_profile LIKE 'languages'");
    if (empty($columns)) {
        echo "Adding 'languages' column...\n";
        $db->query("ALTER TABLE user_profile ADD COLUMN languages TEXT DEFAULT NULL AFTER bio");
    } else {
        echo "'languages' column already exists.\n";
    }

    $columns = $db->fetchAll("SHOW COLUMNS FROM user_profile LIKE 'accessibility_needs'");
    if (empty($columns)) {
        echo "Adding 'accessibility_needs' column...\n";
        $db->query("ALTER TABLE user_profile ADD COLUMN accessibility_needs TEXT DEFAULT NULL AFTER languages");
    } else {
        echo "'accessibility_needs' column already exists.\n";
    }

    echo "Migration completed successfully.\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
