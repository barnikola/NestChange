<?php

require_once dirname(__DIR__) . '/core/database.php';

class Notification
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Add a notification for a user
     */
    public function add(int $userId, string $message, string $type = 'info'): void
    {
        $this->db->insert('notification', [
            'user_id' => $userId,
            'message' => $message,
            'type' => $type,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get unread notification count for a user
     */
    public function getUnreadCount(int $userId): int
    {
        $result = $this->db->fetchOne(
            "SELECT COUNT(*) as count FROM notification WHERE user_id = ? AND is_read = 0",
            [$userId]
        );
        return (int)($result['count'] ?? 0);
    }

    /**
     * Check if a specific unread notification already exists
     */
    public function hasUnreadNotification(int $userId, string $message): bool
    {
        $result = $this->db->fetchOne(
            "SELECT id FROM notification WHERE user_id = ? AND message = ? AND is_read = 0 LIMIT 1",
            [$userId, $message]
        );
        return !empty($result);
    }

    /**
     * Get notifications for a user
     */
    public function getByUserId(int $userId): array
    {
        $sql = "SELECT id, user_id, message, type, is_read as `read`, created_at 
                FROM notification 
                WHERE user_id = ? 
                ORDER BY created_at DESC";
        
        $results = $this->db->fetchAll($sql, [$userId]);
        return $results;
    }

    /**
     * Get latest notifications for a user
     */
    public function getLatest(int $userId, int $limit = 5): array
    {
        $sql = "SELECT id, user_id, message, type, is_read as `read`, created_at 
                FROM notification 
                WHERE user_id = ? 
                ORDER BY created_at DESC 
                LIMIT " . (int)$limit;
        
        return $this->db->fetchAll($sql, [$userId]);
    }

    /**
     * Mark a specific notification as read
     */
    public function markAsRead(string $id, int $userId): bool
    {
        $count = $this->db->update(
            'notification',
            ['is_read' => 1],
            "id = ? AND user_id = ?",
            [$id, $userId]
        );
        return $count > 0;
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead(int $userId): void
    {
        $this->db->update(
            'notification',
            ['is_read' => 1],
            "user_id = ? AND is_read = 0",
            [$userId]
        );
    }
}
