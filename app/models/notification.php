<?php

class Notification
{
    private string $storageFile;

    public function __construct()
    {
        // Store in temp directory
        $this->storageFile = dirname(__DIR__, 2) . '/temp/notifications.json';
        
        // Initialize file if needed
        if (!file_exists($this->storageFile)) {
            $dir = dirname($this->storageFile);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            file_put_contents($this->storageFile, json_encode([]));
        }
    }

    /**
     * Add a notification for a user
     */
    public function add(int $userId, string $message, string $type = 'info'): void
    {
        $notifications = $this->load();
        
        $notifications[] = [
            'id' => uniqid('notif_', true),
            'user_id' => $userId,
            'message' => $message,
            'type' => $type,
            'created_at' => date('Y-m-d H:i:s'),
            'read' => false
        ];
        
        $this->save($notifications);
    }

    /**
     * Get notifications for a user
     */
    public function getByUserId(int $userId): array
    {
        $notifications = $this->load();
        
        // Filter by user_id
        $userNotifications = array_filter($notifications, function($n) use ($userId) {
            return isset($n['user_id']) && $n['user_id'] == $userId;
        });
        
        // Sort by date desc
        usort($userNotifications, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        return array_values($userNotifications);
    }
    
    /**
     * Load notifications from file
     */
    private function load(): array
    {
        if (!file_exists($this->storageFile)) {
            return [];
        }
        
        $json = file_get_contents($this->storageFile);
        $data = json_decode($json, true);
        
        return is_array($data) ? $data : [];
    }

    /**
     * Save notifications to file
     */
    private function save(array $data): void
    {
        file_put_contents($this->storageFile, json_encode($data, JSON_PRETTY_PRINT));
    }
}
