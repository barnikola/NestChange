<?php
require_once 'app/config.php';
require_once 'app/core/database.php';

$db = Database::getInstance();

try {
    echo "Attempting to fix schema...\n";
    
    // 1. Drop Foreign Key
    try {
        $db->query("ALTER TABLE report DROP FOREIGN KEY report_ibfk_1");
        echo "Dropped FK report_ibfk_1.\n";
    } catch (Exception $e) {
        echo "FK might not exist or verify name: " . $e->getMessage() . "\n";
    }

    // 2. Modify Column
    $db->query("ALTER TABLE report MODIFY reporter_id CHAR(36) NULL");
    echo "Modified reporter_id to CHAR(36).\n";

    // 3. Re-add Foreign Key
    // Ensure user_profile(id) matches type (it should be CHAR(36))
    $db->query("ALTER TABLE report ADD CONSTRAINT report_ibfk_1 FOREIGN KEY (reporter_id) REFERENCES user_profile(id) ON DELETE SET NULL");
    echo "Re-added FK report_ibfk_1.\n";
    
    echo "Schema fixed successfully.\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
