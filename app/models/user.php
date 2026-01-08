<?php

require_once dirname(__DIR__) . '/core/model.php';
require_once dirname(__DIR__) . '/config.php';

class User extends Model
{
    protected string $table = 'account';
    protected string $primaryKey = 'id';


    public function findByEmail(string $email): array|false
    {
        return $this->findOneBy('email', $email);
    }

    public function emailExists(string $email): bool
    {
        return $this->findByEmail($email) !== false;
    }


    public function createUser(array $data): string
    {
        // Hash password
        if (isset($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_ALGO, ['cost' => PASSWORD_COST]);
            unset($data['password']);
        }
        
        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }
        
        // Set default role if not provided
        if (!isset($data['role'])) {
            $data['role'] = 'student';
        }
        
        return $this->create($data);
    }


    public function verifyPassword(array $user, string $password): bool
    {
        return password_verify($password, $user['password_hash']);
    }


    public function updatePassword(int|string $table, $userId, string $newPassword): bool
    {
        $hash = password_hash($newPassword, PASSWORD_ALGO, ['cost' => PASSWORD_COST]);
        return $this->update($userId, ['password_hash' => $hash]) > 0;
    }


    public function updateStatus(int|string $userId, string $status): bool
    {
        $validStatuses = ['pending', 'approved', 'rejected', 'suspended'];
        
        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException("Invalid status: {$status}");
        }
        
        return $this->update($userId, ['status' => $status]) > 0;
    }


    public function isActive(array $user): bool
    {
        return $user['status'] === 'approved';
    }


    public function isAdmin(array $user): bool
    {
        return $user['role'] === 'admin';
    }


    public function isModerator(array $user): bool
    {
        return in_array($user['role'], ['moderator', 'admin']);
    }


    public function getUserWithProfile(int|string $userId): array|false
    {
        $sql = "SELECT a.*, p.id as profile_id, p.first_name, p.last_name, p.phone, p.bio, p.city, p.country, p.profile_picture
                FROM account a
                LEFT JOIN user_profile p ON a.id = p.account_id
                WHERE a.id = ?";
        
        return $this->db->fetchOne($sql, [$userId]);
    }


    public function findByStatus(string $status): array
    {
        return $this->findBy('status', $status);
    }


    public function findByRole(string $role): array
    {
        return $this->findBy('role', $role);
    }


    public function search(string $query, int $limit = 20): array
    {
        $sql = "SELECT a.id, a.email, a.status, a.role, p.first_name, p.last_name
                FROM account a
                LEFT JOIN user_profile p ON a.id = p.account_id
                WHERE a.email LIKE ? 
                   OR p.first_name LIKE ? 
                   OR p.last_name LIKE ?
                LIMIT ?";
        
        $searchTerm = "%{$query}%";
        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm, $limit]);
    }


    public function countByStatus(string $status): int
    {
        return $this->count(['status' => $status]);
    }


    public function getRecent(int $limit = 10): array
    {
        return $this->findAll('created_at DESC', $limit);
    }


    public function updateStudentStatus(int|string $userId, ?string $expiryDate): bool
    {
        return $this->update($userId, ['student_status_until' => $expiryDate]) > 0;
    }


    public function hasValidStudentStatus(array $user): bool
    {
        if (empty($user['student_status_until'])) {
            return false;
        }
        
        return strtotime($user['student_status_until']) >= time();
    }


    public function getSafeUserData(array $user): array
    {
        unset($user['password_hash']);
        return $user;
    }

    public function getAllDocuments(): array
    {
        // Fetch document status as well
        $sql = "SELECT d.*, d.status as document_status, p.first_name, p.last_name, a.email, a.status as user_status, a.id as account_id
                FROM user_document d
                JOIN account a ON d.account_id = a.id
                LEFT JOIN user_profile p ON a.id = p.account_id
                ORDER BY d.created_at DESC";
                
        return $this->db->fetchAll($sql);
    }

    public function updateDocumentStatus(string $documentId, string $status): bool
    {
        $data = ['status' => $status];
        if ($status === 'approved') {
            $data['verified_at'] = date('Y-m-d H:i:s');
        }
        return $this->db->update('user_document', $data, 'id = ?', [$documentId]) > 0;
    }

    public function countPendingDocuments(int|string $userId): int
    {
        $sql = "SELECT COUNT(*) as count FROM user_document WHERE account_id = ? AND status = 'pending'";
        $result = $this->db->fetchOne($sql, [$userId]);
        return (int)($result['count'] ?? 0);
    }

    public function countAllPendingDocuments(): int
    {
        $sql = "SELECT COUNT(*) as count FROM user_document WHERE status = 'pending'";
        $result = $this->db->fetchOne($sql);
        return (int)($result['count'] ?? 0);
    }
}
