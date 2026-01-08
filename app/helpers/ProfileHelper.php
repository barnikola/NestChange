<?php

require_once dirname(__DIR__) . '/core/session.php';
require_once dirname(__DIR__) . '/core/database.php';

class ProfileHelper
{
    /**
     * Get the current context for the navigation bar
     * 
     * @return array
     */
    public static function navContext(): array
    {
        if (!Session::isLoggedIn()) {
            return [
                'is_logged_in' => false,
                'avatar' => null,
                'initials' => null,
                'user_name' => null,
                'notification_count' => 0
            ];
        }

        $user = Session::getUser();
        $db = Database::getInstance();

        // Fetch fresh profile data to ensure avatar is up to date
        // We could optimize this by caching or updating session on profile update, 
        // but for now a direct query is safer for consistency.
        $profile = $db->fetchOne(
            "SELECT first_name, last_name, profile_picture FROM user_profile WHERE account_id = ?",
            [$user['id']]
        );

        $firstName = $profile['first_name'] ?? $user['email']; // Fallback
        $lastName = $profile['last_name'] ?? '';
        $avatar = $profile['profile_picture'] ?? null;

        // Initials
        $initials = strtoupper(substr($firstName, 0, 1));
        if (!empty($lastName)) {
            $initials .= strtoupper(substr($lastName, 0, 1));
        }

        // Mock notification count for now
        $notificationCount = 0;
        // Example: $notificationCount = $db->count('notifications', ['user_id' => $user['id'], 'read_at' => null]);

        return [
            'is_logged_in' => true,
            'avatar' => $avatar,
            'initials' => $initials,
            'user_name' => $firstName,
            'notification_count' => $notificationCount
        ];
    }

    public static function isVerified(): bool
    {
        if (!Session::isLoggedIn()) {
            return false;
        }
        $user = Session::getUser();
        // Default to TRUE (permissive) if status is missing or null
        // This prevents blocking development work
        $status = $user['status'] ?? null;
        if (empty($status)) {
            return true;
        }

        return $status === 'verified';
    }

    public static function canApply(): bool
    {
        // Can apply if verified.
        return self::isVerified();
    }
}
