<?php

require_once dirname(__DIR__) . '/core/database.php';

class Negotiation
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Generate a UUID for new records
     */
    private function generateUuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    /**
     * Create a new negotiation proposal
     * 
     * @param string $applicationId The application ID
     * @param array $data Negotiation data (sender_profile_id, start_date, end_date, message, status)
     * @return string|false The negotiation ID or false on failure
     */
    public function createProposal(string $applicationId, array $data)
    {
        $negotiationId = $this->generateUuid();

        $record = [
            'id' => $negotiationId,
            'application_id' => $applicationId,
            'sender_profile_id' => $data['sender_profile_id'],
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'parent_negotiation_id' => null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            $this->db->insert('application_negotiation', $record);
            return $negotiationId;
        } catch (Exception $e) {
            error_log("Failed to create negotiation proposal: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Create a counter-proposal linked to a parent negotiation
     * 
     * @param string $parentNegotiationId The parent negotiation ID
     * @param string $applicationId The application ID
     * @param array $data Negotiation data
     * @return string|false The negotiation ID or false on failure
     */
    public function createCounterProposal(string $parentNegotiationId, string $applicationId, array $data)
    {
        $negotiationId = $this->generateUuid();

        $record = [
            'id' => $negotiationId,
            'application_id' => $applicationId,
            'sender_profile_id' => $data['sender_profile_id'],
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => 'pending',
            'parent_negotiation_id' => $parentNegotiationId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            // Mark parent as countered
            $this->updateStatus($parentNegotiationId, 'countered');

            // Create new counter-proposal
            $this->db->insert('application_negotiation', $record);
            return $negotiationId;
        } catch (Exception $e) {
            error_log("Failed to create counter-proposal: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Accept a negotiation proposal
     * 
     * @param string $negotiationId The negotiation ID
     * @return bool Success status
     */
    public function acceptProposal(string $negotiationId): bool
    {
        try {
            $this->updateStatus($negotiationId, 'accepted');

            // Mark all other pending negotiations for this application as rejected
            $negotiation = $this->findById($negotiationId);
            if ($negotiation) {
                $this->rejectOtherProposals($negotiation['application_id'], $negotiationId);
            }

            return true;
        } catch (Exception $e) {
            error_log("Failed to accept proposal: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Reject a negotiation proposal
     * 
     * @param string $negotiationId The negotiation ID
     * @return bool Success status
     */
    public function rejectProposal(string $negotiationId): bool
    {
        try {
            $this->updateStatus($negotiationId, 'rejected');
            return true;
        } catch (Exception $e) {
            error_log("Failed to reject proposal: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update negotiation status
     * 
     * @param string $negotiationId The negotiation ID
     * @param string $status The new status
     * @return bool Success status
     */
    public function updateStatus(string $negotiationId, string $status): bool
    {
        try {
            $this->db->update('application_negotiation', ['status' => $status], ['id' => $negotiationId]);
            return true;
        } catch (Exception $e) {
            error_log("Failed to update negotiation status: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get negotiation history for an application
     * 
     * @param string $applicationId The application ID
     * @return array Array of negotiations ordered by created_at DESC
     */
    public function getHistory(string $applicationId): array
    {
        $sql = "SELECT n.*, 
                       p.first_name, 
                       p.last_name,
                       parent.id as parent_id,
                       parent.start_date as parent_start_date,
                       parent.end_date as parent_end_date
                FROM application_negotiation n
                LEFT JOIN user_profile p ON n.sender_profile_id = p.id
                LEFT JOIN application_negotiation parent ON n.parent_negotiation_id = parent.id
                WHERE n.application_id = ?
                ORDER BY n.created_at DESC";

        try {
            return $this->db->query($sql, [$applicationId]);
        } catch (Exception $e) {
            error_log("Failed to get negotiation history: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Find a negotiation by ID
     * 
     * @param string $negotiationId The negotiation ID
     * @return array|null The negotiation or null if not found
     */
    public function findById(string $negotiationId): ?array
    {
        try {
            $result = $this->db->fetchOne('application_negotiation', ['id' => $negotiationId]);
            return $result ?: null;
        } catch (Exception $e) {
            error_log("Failed to find negotiation: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if user is authorized to negotiate on an application
     * 
     * @param string $applicationId The application ID
     * @param string $profileId The user's profile ID
     * @return bool Authorization status
     */
    public function canNegotiate(string $applicationId, string $profileId): bool
    {
        $sql = "SELECT 
                    (SELECT owner_profile_id FROM listing WHERE id = la.listing_id) as owner_profile_id,
                    la.applicant_profile_id
                FROM listing_application la
                WHERE la.id = ?";

        try {
            $result = $this->db->query($sql, [$applicationId]);
            if (empty($result)) {
                return false;
            }

            $application = $result[0];
            return $profileId === $application['owner_profile_id'] ||
                $profileId === $application['applicant_profile_id'];
        } catch (Exception $e) {
            error_log("Failed to check negotiation authorization: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Reject all other pending proposals for an application
     * 
     * @param string $applicationId The application ID
     * @param string $exceptNegotiationId The negotiation ID to exclude
     * @return bool Success status
     */
    private function rejectOtherProposals(string $applicationId, string $exceptNegotiationId): bool
    {
        $sql = "UPDATE application_negotiation 
                SET status = 'rejected' 
                WHERE application_id = ? 
                AND id != ? 
                AND status = 'pending'";

        try {
            $this->db->execute($sql, [$applicationId, $exceptNegotiationId]);
            return true;
        } catch (Exception $e) {
            error_log("Failed to reject other proposals: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the latest pending proposal for an application
     * 
     * @param string $applicationId The application ID
     * @return array|null The latest proposal or null
     */
    public function getLatestPendingProposal(string $applicationId): ?array
    {
        $sql = "SELECT * FROM application_negotiation 
                WHERE application_id = ? 
                AND status = 'pending' 
                ORDER BY created_at DESC 
                LIMIT 1";

        try {
            $result = $this->db->query($sql, [$applicationId]);
            return $result[0] ?? null;
        } catch (Exception $e) {
            error_log("Failed to get latest pending proposal: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get counter-proposal chain for a negotiation
     * 
     * @param string $negotiationId The negotiation ID
     * @return array Array of negotiations in the chain
     */
    public function getProposalChain(string $negotiationId): array
    {
        $chain = [];
        $currentId = $negotiationId;

        // Get the negotiation and walk up the parent chain
        while ($currentId) {
            $negotiation = $this->findById($currentId);
            if (!$negotiation) {
                break;
            }

            array_unshift($chain, $negotiation);
            $currentId = $negotiation['parent_negotiation_id'];
        }

        return $chain;
    }
}
