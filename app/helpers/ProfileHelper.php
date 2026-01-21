<?php

require_once dirname(__DIR__) . '/core/session.php';
require_once dirname(__DIR__) . '/core/database.php';
require_once dirname(__DIR__) . '/models/notification.php';

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
                'role' => null,
                'notification_count' => 0
            ];
        }

        $user = Session::getUser();
        $db = Database::getInstance();


        // We could optimize this by caching or updating session on profile update, 
        // but for now a direct query is safer for consistency.
        $profile = $db->fetchOne(
            "SELECT first_name, last_name, profile_picture FROM user_profile WHERE account_id = ?",
            [$user['id']]
        );

        $firstName = $profile['first_name'] ?? $user['email'];
        $lastName = $profile['last_name'] ?? '';
        $avatar = $profile['profile_picture'] ?? null;

        // Initials
        $initials = strtoupper(substr($firstName, 0, 1));
        if (!empty($lastName)) {
            $initials .= strtoupper(substr($lastName, 0, 1));
        }

        // Get unread notification count
        $notificationModel = new Notification();
        $notificationCount = $notificationModel->getUnreadCount($user['id']);

        return [
            'is_logged_in' => true,
            'avatar' => $avatar,
            'initials' => $initials,
            'user_name' => $firstName,
            'role' => $user['role'] ?? 'student',
            'notification_count' => $notificationCount
        ];
    }

}
