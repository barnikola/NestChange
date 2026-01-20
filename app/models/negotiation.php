<?php

require_once dirname(__DIR__) . '/core/model.php';
require_once dirname(__DIR__) . '/core/database.php';

class Negotiation extends Model
{
    /**
     * Generate UUID v4
     */
    private function generateUuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Check if profile is guest or host of the application
     */
    public function validateParticipant(string $applicationId, string $profileId): bool
    {
        $sql = "SELECT a.id 
                FROM listing_application a
                JOIN listing l ON a.listing_id = l.id
                WHERE a.id = ? 
                AND (a.applicant_profile_id = ? OR l.host_profile_id = ?)";
        
        $result = $this->db->fetchOne($sql, [$applicationId, $profileId, $profileId]);
        return !empty($result);
    }

    /**
     * Create a new proposal
     */
    public function createProposal(string $applicationId, string $proposerProfileId, array $data): string
    {
        if (!$this->validateParticipant($applicationId, $proposerProfileId)) {
            throw new Exception("Unauthorized: You are not a participant in this application.");
        }

        $id = $this->generateUuid();
        
        $this->db->insert('negotiation', [
            'id' => $id,
            'application_id' => $applicationId,
            'proposer_profile_id' => $proposerProfileId,
            'proposed_start_date' => $data['start_date'] ?? null,
            'proposed_end_date' => $data['end_date'] ?? null,
            'terms' => $data['terms'] ?? '',
            'status' => 'proposed'
        ]);
        
        return $id;
    }

    /**
     * Create a counter-proposal
     */
    public function createCounterProposal(string $parentNegotiationId, string $proposerProfileId, array $data): string
    {
        // Get parent
        $parent = $this->findById($parentNegotiationId);
        if (!$parent) {
            throw new Exception("Parent negotiation not found.");
        }
        
        if (!$this->validateParticipant($parent['application_id'], $proposerProfileId)) {
            throw new Exception("Unauthorized.");
        }
        
        // Prevent self-countering (optional, but logical)
        if ($parent['proposer_profile_id'] === $proposerProfileId) {
            // throw new Exception("You cannot counter your own proposal.");
            // Actually, maybe you want to update your own terms? Let's allow it but typically it's alternating.
        }

        $id = $this->generateUuid();
        
        $this->db->insert('negotiation', [
            'id' => $id,
            'application_id' => $parent['application_id'],
            'proposer_profile_id' => $proposerProfileId,
            'proposed_start_date' => $data['start_date'] ?? $parent['proposed_start_date'],
            'proposed_end_date' => $data['end_date'] ?? $parent['proposed_end_date'],
            'terms' => $data['terms'] ?? $parent['terms'],
            'status' => 'proposed', // A counter proposal is a new 'proposed' state, but linked
            'parent_negotiation_id' => $parentNegotiationId
        ]);
        
        // Mark parent as 'countered'
        $this->updateStatus($parentNegotiationId, 'countered');
        
        return $id;
    }

    /**
     * Respond to a proposal (Accept/Reject)
     */
    public function respond(string $negotiationId, string $responderProfileId, string $status): bool
    {
        if (!in_array($status, ['accepted', 'rejected'])) {
            throw new Exception("Invalid status.");
        }
        
        $negotiation = $this->findById($negotiationId);
        if (!$negotiation) {
            throw new Exception("Negotiation not found.");
        }
        
        if (!$this->validateParticipant($negotiation['application_id'], $responderProfileId)) {
            throw new Exception("Unauthorized.");
        }
        
        // Ensure responder is NOT the proposer
        if ($negotiation['proposer_profile_id'] === $responderProfileId) {
             throw new Exception("You cannot accept/reject your own proposal.");
        }
        
        return $this->updateStatus($negotiationId, $status);
    }
    
    /**
     * Find by ID
     */
    public function findById(string $id): ?array
    {
         $result = $this->db->fetchOne("SELECT * FROM negotiation WHERE id = ?", [$id]);
         return $result ?: null;
    }

    /**
     * Update status
     */
    private function updateStatus(string $id, string $status): bool
    {
        return $this->db->update('negotiation', ['status' => $status], "id = ?", [$id]) > 0;
    }

    /**
     * Get negotiation history for an application
     */
    public function getHistory(string $applicationId): array
    {
        $sql = "SELECT n.*, 
                       p.first_name, p.last_name 
                FROM negotiation n
                LEFT JOIN user_profile p ON n.proposer_profile_id = p.id
                WHERE n.application_id = ?
                ORDER BY n.created_at ASC";
                
        return $this->db->fetchAll($sql, [$applicationId]);
    }
    
    /**
     * Get current active proposal (latest proposed)
     */
    public function getActiveProposal(string $applicationId): ?array
    {
        $sql = "SELECT * FROM negotiation 
                WHERE application_id = ? AND status = 'proposed' 
                ORDER BY created_at DESC LIMIT 1";
        $result = $this->db->fetchOne($sql, [$applicationId]);
        return $result ?: null;
    }
}
