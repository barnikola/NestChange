<?php

require_once dirname(__DIR__) . '/core/model.php';

class Notification extends Model
{
    protected string $table = 'notification';
    protected string $primaryKey = 'id';

    /**
     * Add a notification for a user
     */
    public function add(int $userId, string $message, string $type = 'info'): void
    {
        $data = [
            'id' => $this->generateUuid(),
            'user_id' => $userId,
            'message' => $message,
            'type' => $type,
            'is_read' => 0
        ];
        
        $this->create($data);
    }

    /**
     * Get notifications for a user
     */
    public function getByUserId(int $userId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        return $this->db->fetchAll($sql, [$userId]);
    }

    /**
     * Get latest notifications for a user
     */
    public function getLatest(int $userId, int $limit = 5): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC LIMIT $limit";
        return $this->db->fetchAll($sql, [$userId]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(string $notificationId): bool
    {
        return $this->update($notificationId, ['is_read' => 1]) > 0;
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead(int $userId): int
    {
        $sql = "UPDATE {$this->table} SET is_read = 1 WHERE user_id = ? AND is_read = 0";
        $stmt = $this->db->query($sql, [$userId]);
        return $stmt->rowCount();
    }

    /**
     * Get unread notification count for a user
     */
    public function getUnreadCount(int $userId): int
    {
        return $this->count(['user_id' => $userId, 'is_read' => 0]);
    }

    /**
     * Generate a UUID v4
     */
    private function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
