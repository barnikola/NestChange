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
     * Check if user has an active application for a listing
     */
    public function hasActiveApplication(string $userId, string $listingId): bool
    {
        $sql = "SELECT 1 FROM {$this->table} 
                WHERE applicant_id = ? 
                AND listing_id = ? 
                AND status NOT IN ('cancelled', 'rejected', 'withdrawn')
                LIMIT 1";
        return $this->db->fetchOne($sql, [$userId, $listingId]) !== false;
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
     * Get active application ID if exists
     */
    public function getActiveApplicationId(string $userId, string $listingId): ?string
    {
        $sql = "SELECT id FROM {$this->table} 
                WHERE applicant_id = ? 
                AND listing_id = ? 
                AND status NOT IN ('cancelled', 'rejected', 'withdrawn', 'completed')
                LIMIT 1";
        $result = $this->db->fetchOne($sql, [$userId, $listingId]);
        return $result['id'] ?? null;
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
    public function setStatus(string $id, string $status, ?string $requesterId = null): bool
    {
        $data = ['status' => $status];
        if ($status === 'cancel_requested' && $requesterId) {
            $data['cancel_requester_id'] = $requesterId;
        } elseif ($status === 'cancelled' || $status === 'accepted') {
            // Clear requester when finalized or rejected
            $data['cancel_requester_id'] = null;
        }
        return $this->update($id, $data) > 0;
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
        $sql = "SELECT a.*, 
                       l.title as listing_title, 
                       l.host_profile_id as owner_profile_id, 
                       l.cancellation_policy,
                       
                       -- Applicant Details
                       ac.email as applicant_email,
                       ap.first_name as applicant_name,
                       
                       -- Host Details
                       hc.email as host_email,
                       hp.first_name as host_name
                       
                FROM {$this->table} a
                LEFT JOIN listing l ON a.listing_id = l.id
                
                -- Join Applicant Info
                LEFT JOIN account ac ON a.applicant_id = ac.id
                LEFT JOIN user_profile ap ON a.applicant_profile_id = ap.id
                
                -- Join Host Info
                LEFT JOIN user_profile hp ON l.host_profile_id = hp.id
                LEFT JOIN account hc ON hp.account_id = hc.id
                
                WHERE a.id = ?";
            
        return $this->db->fetchOne($sql, [$id]);
    }

    public function getForDashboard(): array
    {
        return $this->findAll('created_at DESC', 5);
    }

    /**
     * Cancel application
     */
    public function cancelApplication(string $id, string $reason, array $penaltyDetails): bool
    {
        // FAIL-SAFE: If this was supposed to be a request, do not allow direct cancellation
        if (isset($penaltyDetails['allowed']) && $penaltyDetails['allowed'] === false) {
            error_log("[CRITICAL_BYPASS] Application::cancelApplication blocked direct cancellation because allowed is false. ID: $id");
            return false;
        }

        // 1. Insert into application_cancellations
        $cancellationId = $this->generateUuid();
        $this->db->insert('application_cancellations', [
            'id' => $cancellationId,
            'application_id' => $id,
            'reason' => $reason,
            'refund_amount' => $penaltyDetails['penalty'] ?? 'None',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // 2. Update listing_application status and clear requester
        return $this->setStatus($id, 'cancelled');
    }

    /**
     * Withdraw other pending applications for this applicant
     */
    public function withdrawPendingExcept(string $applicantId, string $excludeId): int
    {
        // Don't use $this->update because we need a custom WHERE clause
        // UPDATE listing_application SET status = 'withdrawn' 
        // WHERE applicant_id = ? AND id != ? AND status = 'pending'
        
        return $this->db->update(
            $this->table,
            ['status' => 'withdrawn'],
            "applicant_id = ? AND id != ? AND status = 'pending'",
            [$applicantId, $excludeId]
        );
    }

    /**
     * Record a cancellation request (pending approval)
     */
    public function recordCancellationRequest(string $id, string $reason, array $penaltyDetails, ?string $requesterId = null): bool
    {
        $cancellationId = $this->generateUuid();
        return $this->db->insert('application_cancellations', [
            'id' => $cancellationId,
            'application_id' => $id,
            'reason' => ($requesterId ? "[REQUEST] " : "") . $reason,
            'refund_amount' => $penaltyDetails['penalty'] ?? 'None',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Auto-complete exchanges whose end_date has passed
     * Returns the number of applications updated
     */
    public function markExpiredAsCompleted(): int
    {
        // 1. Find candidates
        $sql = "SELECT id FROM {$this->table} 
                WHERE status = 'accepted' 
                AND end_date < CURDATE()
                AND end_date IS NOT NULL";
        
        $candidates = $this->db->fetchAll($sql);
        $count = 0;

        foreach ($candidates as $app) {
            // 2. Ensure booking record exists (required for reviews)
            $booking = $this->db->fetchOne("SELECT id FROM booking WHERE application_id = ?", [$app['id']]);
            
            if (!$booking) {
                $this->db->insert('booking', [
                    'id' => $this->generateUuid(),
                    'application_id' => $app['id']
                ]);
            }

            // 3. Update status
            $this->db->query(
                "UPDATE {$this->table} SET status = 'completed', updated_at = NOW() WHERE id = ?", 
                [$app['id']]
            );
            $count++;
        }

        return $count;
    }

    /**
     * Get applications that were just auto-completed (for notifications)
     * Returns applications completed in the last 24 hours
     */
    public function getRecentlyCompleted(): array
    {
        $sql = "SELECT la.*, 
                       l.title as listing_title,
                       up_guest.account_id as applicant_id,
                       up_host.account_id as host_id
                FROM {$this->table} la
                LEFT JOIN listing l ON la.listing_id = l.id
                LEFT JOIN user_profile up_guest ON la.applicant_id = up_guest.account_id
                LEFT JOIN user_profile up_host ON l.host_profile_id = up_host.id
                WHERE la.status = 'completed' 
                AND la.updated_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
                ORDER BY la.updated_at DESC";
        
        return $this->db->fetchAll($sql);
    }

    private function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
