<?php

require_once dirname(__DIR__) . '/core/model.php';

class Application extends Model
{
    protected string $table = 'listing_application';

    /**
     * Create a new application
     */
    public function createApplication(array $data): string
    {
        // Use app timezone (set in config.php) so this matches other chat messages.
        $now = date('Y-m-d H:i:s');

        // 1. Prepare Application Data
        if (!isset($data['id'])) {
            $data['id'] = $this->generateUuid();
        }
        
        // Map controller keys to DB columns
        $appData = [
            'id' => $data['id'],
            'listing_id' => $data['listingid'] ?? $data['listing_id'],
            'applicant_id' => $data['applicantid'] ?? $data['applicant_id'],
            'applicant_profile_id' => $data['applicantprofileid'] ?? $data['applicant_profile_id'],
            'start_date' => $data['startdate'] ?? $data['start_date'] ?? null,
            'end_date' => $data['enddate'] ?? $data['end_date'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'created_at' => $now
        ];

        // 2. Insert Application
        $this->db->insert($this->table, $appData);

        // 3. Create Chat & Initial Message if message provided
        if (!empty($data['message'])) {
            $chatId = $this->generateUuid();
             
             // Create Chat linked to Application
            $this->db->insert('chat', [
                'id' => $chatId,
                'application_id' => $appData['id'],
                'created_at' => $now,
                // Chat list ordering uses chat.last_message_at; set it for the initial application message
                'last_message_at' => $now
            ]);

            // Create Message
            $this->db->insert('chat_message', [
                'id' => $this->generateUuid(),
                'chat_id' => $chatId,
                'sender_id' => $appData['applicant_id'],
                'sender_profile_id' => $appData['applicant_profile_id'],
                'content' => $data['message'],
                'status' => 'ok',
                'created_at' => $now
            ]);
        }

        return $appData['id'];
    }

    /**
     * Get applications by applicant ID
     */
    public function getByApplicantId(string $userId): array
    {
        $sql = "SELECT a.*, l.title as listing_title 
                FROM {$this->table} a
                LEFT JOIN listing l ON a.listing_id = l.id
                WHERE a.applicant_id = ?
                ORDER BY a.created_at DESC";
        
        return $this->db->fetchAll($sql, [$userId]);
    }

    /**
     * Get applications for a host (received applications)
     */
    public function getReceivedByUserId(string $hostProfileId): array
    {
        $sql = "SELECT a.*, l.title as listing_title, 
                       u.first_name as applicant_first_name, u.last_name as applicant_last_name
                FROM {$this->table} a
                JOIN listing l ON a.listing_id = l.id
                LEFT JOIN user_profile u ON a.applicant_profile_id = u.id
                WHERE l.host_profile_id = ?
                ORDER BY a.created_at DESC";
                
        return $this->db->fetchAll($sql, [$hostProfileId]);
    }


    /**
     * Update application status
     */
    public function setStatus(string $id, string $status): bool
    {
        return $this->update($id, ['status' => $status]) > 0;
    }

    /**
     * Record a negotiation entry
     * Assumes a separate table 'application_negotiation' exists or we create one
     */
    public function recordNegotiation(string $applicationId, array $data): bool
    {
        $negotiationTable = 'application_negotiation';
        
        $record = array_merge([
            'id' => $this->generateUuid(),
            'application_id' => $applicationId,
            'created_at' => date('Y-m-d H:i:s')
        ], $data);

        // We use the db instance directly
        // Note: usage of insert might fail if table doesn't exist, 
        // but requirement asks for methods to be present.
        try {
            $this->db->insert($negotiationTable, $record);
            return true;
        } catch (Exception $e) {
            // If table doesn't exist, we might log or shallow error for now
            // Or maybe the user meant updating a field in the application table?
            // "Record negotiation" implies a history. 
            // Let's assume table exists or we just return true for mock purposes if it fails.
            if (APP_DEBUG) throw $e;
            return false;
        }
    }

    public function findById(string $id): ?array
    {
        $sql = "SELECT a.*, l.title as listing_title, l.host_profile_id as owner_profile_id
                FROM {$this->table} a
                LEFT JOIN listing l ON a.listing_id = l.id
                WHERE a.id = ?";
                
        return $this->db->fetchOne($sql, [$id]);
    }

    public function getForDashboard(): array
    {
        return $this->findAll('created_at DESC', 5);
    }

    private function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
