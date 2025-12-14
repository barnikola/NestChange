<?php

require_once dirname(__DIR__) . '/core/model.php';
require_once dirname(__DIR__) . '/config.php';

class Chat extends Model
{
    protected string $table = 'chat';
    protected string $primaryKey = 'id';

    public function getUserChats(int $accountId, string $profileId): array
    {
        $sql = "SELECT 
                    c.id as chat_id,
                    c.application_id,
                    COALESCE(
                        c.last_message_at,
                        (SELECT MAX(created_at) FROM chat_message WHERE chat_id = c.id)
                    ) as last_message_at,
                    la.listing_id,
                    la.applicant_profile_id,
                    la.start_date,
                    la.end_date,
                    la.status as application_status,
                    l.title as listing_title,
                    l.city as listing_city,
                    l.host_profile_id,
                    CASE WHEN la.applicant_profile_id = ? THEN hp.first_name ELSE ap.first_name END as other_first_name,
                    CASE WHEN la.applicant_profile_id = ? THEN hp.last_name ELSE ap.last_name END as other_last_name,
                    CASE WHEN la.applicant_profile_id = ? THEN l.host_profile_id ELSE la.applicant_profile_id END as other_profile_id,
                    (SELECT content FROM chat_message WHERE chat_id = c.id ORDER BY created_at DESC LIMIT 1) as last_message
                FROM chat c
                INNER JOIN listing_application la ON c.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                INNER JOIN user_profile hp ON l.host_profile_id = hp.id
                INNER JOIN user_profile ap ON la.applicant_profile_id = ap.id
                WHERE (la.applicant_profile_id = ? OR l.host_profile_id = ?)
                AND EXISTS (SELECT 1 FROM chat_message WHERE chat_id = c.id LIMIT 1)
                ORDER BY last_message_at DESC";
        
        return $this->db->fetchAll($sql, [$profileId, $profileId, $profileId, $profileId, $profileId]);
    }

    public function getChatDetails(string $chatId, string $profileId): array|false
    {
        $sql = "SELECT 
                    c.id as chat_id,
                    c.application_id,
                    la.listing_id,
                    la.applicant_profile_id,
                    la.start_date,
                    la.end_date,
                    la.status as application_status,
                    l.title as listing_title,
                    l.host_profile_id,
                    CASE WHEN la.applicant_profile_id = ? THEN hp.first_name ELSE ap.first_name END as other_first_name,
                    CASE WHEN la.applicant_profile_id = ? THEN hp.last_name ELSE ap.last_name END as other_last_name,
                    CASE WHEN la.applicant_profile_id = ? THEN l.host_profile_id ELSE la.applicant_profile_id END as other_profile_id,
                    CASE WHEN la.applicant_profile_id = ? THEN 'applicant' ELSE 'host' END as current_user_role
                FROM chat c
                INNER JOIN listing_application la ON c.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                INNER JOIN user_profile hp ON l.host_profile_id = hp.id
                INNER JOIN user_profile ap ON la.applicant_profile_id = ap.id
                WHERE c.id = ? AND (la.applicant_profile_id = ? OR l.host_profile_id = ?)";
        
        return $this->db->fetchOne($sql, [$profileId, $profileId, $profileId, $profileId, $chatId, $profileId, $profileId]);
    }

    public function getMessages(string $chatId, int $limit = 50, int $offset = 0): array
    {
        $sql = "SELECT cm.id, cm.chat_id, cm.sender_id, cm.sender_profile_id, cm.content, cm.status, cm.created_at,
                       up.first_name, up.last_name
                FROM chat_message cm
                INNER JOIN user_profile up ON cm.sender_profile_id = up.id
                WHERE cm.chat_id = ?
                ORDER BY cm.created_at ASC
                LIMIT ? OFFSET ?";
        
        return $this->db->fetchAll($sql, [$chatId, $limit, $offset]);
    }

    public function sendMessage(string $chatId, int $senderId, string $senderProfileId, string $content): string
    {
        $messageId = $this->generateUuid();
        
        $this->db->query(
            "INSERT INTO chat_message (id, chat_id, sender_id, sender_profile_id, content, status, created_at) VALUES (?, ?, ?, ?, ?, 'ok', NOW())",
            [$messageId, $chatId, $senderId, $senderProfileId, $content]
        );
        
        $this->db->query("UPDATE chat SET last_message_at = NOW() WHERE id = ?", [$chatId]);
        
        return $messageId;
    }

    public function searchChats(string $profileId, string $query): array
    {
        $searchTerm = "%{$query}%";
        
        $sql = "SELECT 
                    c.id as chat_id,
                    c.application_id,
                    COALESCE(
                        c.last_message_at,
                        (SELECT MAX(created_at) FROM chat_message WHERE chat_id = c.id)
                    ) as last_message_at,
                    la.listing_id,
                    la.applicant_profile_id,
                    l.title as listing_title,
                    l.city as listing_city,
                    l.host_profile_id,
                    CASE WHEN la.applicant_profile_id = ? THEN hp.first_name ELSE ap.first_name END as other_first_name,
                    CASE WHEN la.applicant_profile_id = ? THEN hp.last_name ELSE ap.last_name END as other_last_name,
                    CASE WHEN la.applicant_profile_id = ? THEN l.host_profile_id ELSE la.applicant_profile_id END as other_profile_id,
                    (SELECT content FROM chat_message WHERE chat_id = c.id ORDER BY created_at DESC LIMIT 1) as last_message
                FROM chat c
                INNER JOIN listing_application la ON c.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                INNER JOIN user_profile hp ON l.host_profile_id = hp.id
                INNER JOIN user_profile ap ON la.applicant_profile_id = ap.id
                WHERE (la.applicant_profile_id = ? OR l.host_profile_id = ?)
                AND (hp.first_name LIKE ? OR hp.last_name LIKE ? OR ap.first_name LIKE ? OR ap.last_name LIKE ? OR l.title LIKE ?)
                AND EXISTS (SELECT 1 FROM chat_message WHERE chat_id = c.id LIMIT 1)
                ORDER BY last_message_at DESC";
        
        return $this->db->fetchAll($sql, [$profileId, $profileId, $profileId, $profileId, $profileId, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    }

    public function userHasAccess(string $chatId, string $profileId): bool
    {
        $sql = "SELECT 1 FROM chat c
                INNER JOIN listing_application la ON c.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                WHERE c.id = ? AND (la.applicant_profile_id = ? OR l.host_profile_id = ?)
                LIMIT 1";
        
        return $this->db->fetchOne($sql, [$chatId, $profileId, $profileId]) !== false;
    }

    private function generateUuid(): string
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public static function formatTime(?string $datetime): string
    {
        if (empty($datetime)) {
            return '';
        }
        $timestamp = strtotime($datetime);
        if ($timestamp === false) {
            return '';
        }
        $now = time();
        if (date('Y-m-d', $timestamp) === date('Y-m-d', $now)) return date('H:i', $timestamp);
        if (date('Y-m-d', $timestamp) === date('Y-m-d', strtotime('-1 day'))) return 'Yesterday';
        if ($now - $timestamp < 7 * 24 * 60 * 60) return date('D', $timestamp);
        if (date('Y', $timestamp) === date('Y', $now)) return date('M j', $timestamp);
        return date('M j, Y', $timestamp);
    }

    public static function getInitials(?string $firstName, ?string $lastName): string
    {
        $initials = '';
        if ($firstName) $initials .= strtoupper(substr($firstName, 0, 1));
        if ($lastName) $initials .= strtoupper(substr($lastName, 0, 1));
        return $initials ?: '?';
    }

    public function findOrCreateDirectChat(string $currentProfileId, string $otherProfileId, ?string $listingId = null): string|false
    {
        $sql = "SELECT c.id as chat_id
                FROM chat c
                INNER JOIN listing_application la ON c.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                WHERE (
                    (la.applicant_profile_id = ? AND l.host_profile_id = ?)
                    OR (la.applicant_profile_id = ? AND l.host_profile_id = ?)
                )";
        
        $params = [$currentProfileId, $otherProfileId, $otherProfileId, $currentProfileId];
        
        if ($listingId) {
            $sql .= " AND l.id = ?";
            $params[] = $listingId;
        }
        
        $sql .= " LIMIT 1";
        
        $existingChat = $this->db->fetchOne($sql, $params);
        
        if ($existingChat) {
            return $existingChat['chat_id'];
        }
        
        // No existing chat found - create a new one
        $currentUser = $this->db->fetchOne(
            "SELECT account_id FROM user_profile WHERE id = ?",
            [$currentProfileId]
        );
        
        if (!$currentUser) {
            return false;
        }
        
        // Find a listing where the other user is the host
        if (!$listingId) {
            $listing = $this->db->fetchOne(
                "SELECT id FROM listing WHERE host_profile_id = ? AND status = 'published' LIMIT 1",
                [$otherProfileId]
            );
            
            if (!$listing) {
                return false;
            }
            
            $listingId = $listing['id'];
        }
        
        // Verify the listing belongs to the other user
        $listingCheck = $this->db->fetchOne(
            "SELECT host_profile_id FROM listing WHERE id = ?",
            [$listingId]
        );
        
        if (!$listingCheck || $listingCheck['host_profile_id'] !== $otherProfileId) {
            return false;
        }
        
        // Create a pending application for this chat (direct contact)
        $applicationId = $this->generateUuid();
        $this->db->query(
            "INSERT INTO listing_application (
                id, listing_id, applicant_id, applicant_profile_id, 
                status, created_at, updated_at
            ) VALUES (?, ?, ?, ?, 'pending', NOW(), NOW())",
            [$applicationId, $listingId, $currentUser['account_id'], $currentProfileId]
        );
        
        // Create the chat
        $chatId = $this->generateUuid();
        $this->db->query(
            "INSERT INTO chat (id, application_id, created_at) VALUES (?, ?, NOW())",
            [$chatId, $applicationId]
        );
        
        return $chatId;
    }

    public function getMessageCount(string $chatId): int
    {
        $result = $this->db->fetchOne(
            "SELECT COUNT(*) as count FROM chat_message WHERE chat_id = ?",
            [$chatId]
        );
        
        return (int)($result['count'] ?? 0);
    }
}
