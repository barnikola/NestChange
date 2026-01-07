<?php
require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/core/database.php';

$db = Database::getInstance();
$email = 'test_pending@example.com';
$password = 'Password123!'; // Meets requirements: 8 chars, upper, lower, number
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

// Check if exists
$existing = $db->fetchOne("SELECT id FROM account WHERE email = ?", [$email]);

if ($existing) {
    $db->update('account', ['status' => 'pending', 'password_hash' => $hash], 'id = ?', [$existing['id']]);
    echo "Updated existing user '$email' to status 'pending' with password '$password'";
} else {
    $db->insert('account', [
        'email' => $email,
        'password_hash' => $hash,
        'status' => 'pending',
        'role' => 'student',
        'created_at' => date('Y-m-d H:i:s')
    ]);
    echo "Created new user '$email' with status 'pending' and password '$password'";
}
