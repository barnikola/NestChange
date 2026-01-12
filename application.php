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
     */
    public function recordNegotiation(string $applicationId, array $data): string
    {
        $id = $this->generateUuid();
        $record = [
            'id' => $id,
            'application_id' => $applicationId,
            'sender_profile_id' => $data['sender_profile_id'],
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('application_negotiation', $record);
        return $id;
    }

    /**
     * Get negotiation history for an application
     */
    public function getNegotiationHistory(string $applicationId): array
    {
        $sql = "SELECT n.*, p.first_name, p.last_name
                FROM application_negotiation n
                JOIN user_profile p ON n.sender_profile_id = p.id
                WHERE n.application_id = ?
                ORDER BY n.created_at DESC";

        return $this->db->fetchAll($sql, [$applicationId]);
    }

    /**
     * Update negotiation status
     */
    public function updateNegotiationStatus(string $id, string $status): bool
    {
        return $this->db->update('application_negotiation', ['status' => $status], 'id = ?', [$id]) > 0;
    }

    /**
     * Get single negotiation entry
     */
    public function getNegotiation(string $id): ?array
    {
        $sql = "SELECT * FROM application_negotiation WHERE id = ?";
        return $this->db->fetchOne($sql, [$id]);
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
