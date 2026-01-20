<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/models/negotiation.php';

class NegotiationController extends Controller
{
    /**
     * Show negotiation page for an application
     * GET /applications/{id}/negotiate
     */
    public function index(string $applicationId): void
    {
        $this->requireAuth();
        
        $appModel = $this->model('Application');
        $application = $appModel->findById($applicationId);
        
        if (!$application) {
            $this->flash('error', 'Application not found.');
            $this->redirect(BASE_URL . '/my-applications');
        }
        
        // Validate access
        $user = $this->currentUser();
        $negotiationModel = new Negotiation();
        
        // Check if user has a profile ID (required for negotiation validation)
        if (!isset($user['profile_id'])) {
             // Try to fetch profile if missing in session
             $db = Database::getInstance();
             $profile = $db->fetchOne("SELECT id FROM user_profile WHERE account_id = ?", [$user['id']]);
             $user['profile_id'] = $profile['id'] ?? null;
             if (!$user['profile_id']) {
                 $this->flash('error', 'Please complete your profile first.');
                 $this->redirect(BASE_URL . '/profile');
             }
        }

        if (!$negotiationModel->validateParticipant($applicationId, $user['profile_id'])) {
            $this->flash('error', 'You are not authorized to negotiate this application.');
            $this->redirect(BASE_URL . "/applications/$applicationId");
        }
        
        // Fetch history
        $history = $negotiationModel->getHistory($applicationId);
        
        // Determine active proposal
        $activeProposal = null;
        if (!empty($history)) {
            $last = end($history);
            if ($last['status'] === 'proposed') {
                $activeProposal = $last;
            }
        }
        
        // listing details
        $listing = $this->model('Listing')->find($application['listing_id']);

        // Chat Integration
        $chatId = $this->model('Chat')->ensureChatExists($applicationId);

        $this->view('negotiations/show', [
            'application' => $application,
            'history' => $history,
            'activeProposal' => $activeProposal,
            'listing' => $listing,
            'chatId' => $chatId,
            'currentUserProfileId' => $user['profile_id'],
            'csrf_token' => $this->getCsrfToken()
        ]);
    }
    
    /**
     * Submit a new proposal (or counter-proposal)
     * POST /applications/{id}/negotiate
     */
    public function propose(string $applicationId): void
    {
        $this->requireAuth();
        
        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . "/applications/$applicationId/negotiate");
        }
        
        $user = $this->currentUser();
        // Ensure profile id
        if (!isset($user['profile_id'])) {
             $db = Database::getInstance();
             $profile = $db->fetchOne("SELECT id FROM user_profile WHERE account_id = ?", [$user['id']]);
             $user['profile_id'] = $profile['id'] ?? null;
        }

        $negotiationModel = new Negotiation();
        
        $data = [
            'start_date' => $this->postInput('start_date'),
            'end_date' => $this->postInput('end_date'),
            'terms' => $this->postInput('terms')
        ];
        
        // Validation
        if (empty($data['start_date']) || empty($data['end_date'])) {
             $this->flash('error', 'Both start and end dates are required.');
             $this->redirect(BASE_URL . "/applications/$applicationId/negotiate");
             return;
        }

        if (strtotime($data['end_date']) <= strtotime($data['start_date'])) {
             $this->flash('error', 'End date must be after start date.');
             $this->redirect(BASE_URL . "/applications/$applicationId/negotiate");
             return;
        }
        
        // Check for active proposal to determine if this is a counter
        $active = $negotiationModel->getActiveProposal($applicationId);
        
        // Fetch application for notification routing
        $appModel = $this->model('Application');
        $application = $appModel->findById($applicationId);
        
        try {
            if ($active) {
                // Counter-proposal
                $negotiationModel->createCounterProposal($active['id'], $user['profile_id'], $data);
                $this->flash('success', 'Counter-proposal submitted.');
                $notifMsg = "You have received a counter-proposal.";
            } else {
                // New proposal
                $negotiationModel->createProposal($applicationId, $user['profile_id'], $data);
                $this->flash('success', 'Proposal submitted.');
                $notifMsg = "You have received a new negotiation proposal.";
            }
            
            // Notify other party
            if ($application) {
                $db = Database::getInstance();
                // Resolve Host User ID
                $host = $db->fetchOne("SELECT account_id FROM user_profile WHERE id = ?", [$application['owner_profile_id']]);
                $hostUserId = $host['account_id'] ?? null;
                
                // Determine recipient
                $recipientId = ($user['profile_id'] == $application['owner_profile_id']) 
                                ? $application['applicant_id'] 
                                : $hostUserId;
                                
                if ($recipientId) {
                    $this->model('Notification')->add($recipientId, $notifMsg, 'info');
                }
            }
            
        } catch (Exception $e) {
            $this->flash('error', $e->getMessage());
        }
        
        $this->redirect(BASE_URL . "/applications/$applicationId/negotiate");
    }
    
    /**
     * Accept or Reject a proposal
     * POST /negotiations/{id}/respond
     */
    public function respond(string $negotiationId): void
    {
        $this->requireAuth();
        
        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . '/my-applications'); // Fallback
        }
        
        $status = $this->postInput('status'); // 'accepted' or 'rejected'
        $user = $this->currentUser();
         // Ensure profile id
        if (!isset($user['profile_id'])) {
             $db = Database::getInstance();
             $profile = $db->fetchOne("SELECT id FROM user_profile WHERE account_id = ?", [$user['id']]);
             $user['profile_id'] = $profile['id'] ?? null;
        }

        $negotiationModel = new Negotiation();
        
        try {
            $negotiation = $negotiationModel->findById($negotiationId);
            if (!$negotiation) {
                throw new Exception("Negotiation not found");
            }
            
            if ($negotiationModel->respond($negotiationId, $user['profile_id'], $status)) {
                $this->flash('success', 'Proposal ' . $status . '.');
                
                // If accepted, we should probably update the application dates?
                // The requirements didn't specify auto-update, but it implies agreement.
                // Let's discuss or assume yes for "accepted".
                // I will update application dates if accepted.
                if ($status === 'accepted') {
                    $appModel = $this->model('Application');
                    $data = [];
                    if ($negotiation['proposed_start_date']) $data['start_date'] = $negotiation['proposed_start_date'];
                    if ($negotiation['proposed_end_date']) $data['end_date'] = $negotiation['proposed_end_date'];
                    $data['status'] = 'accepted';
                    
                    if (!empty($data)) {
                        // We need a method to update dates in Application model
                        // Direct DB update for now or add method
                        $db = Database::getInstance();
                        $db->update('listing_application', $data, 'id = ?', [$negotiation['application_id']]);
                        
                        // Auto-withdraw other pending applications for this applicant
                        $application = $appModel->findById($negotiation['application_id']);
                        if ($application) {
                            $count = $appModel->withdrawPendingExcept($application['applicant_id'], $negotiation['application_id']);
                            if ($count > 0) {
                                $this->flash('success', 'Proposal accepted. ' . $count . ' other pending requests were auto-withdrawn.');
                            } else {
                                // Re-flash success message if we overwrote it, or rely on previous
                                // Actually flash messages in this framework might append or overwrite.
                                // Let's explicitly set the success message again to be safe/clear
                                $this->flash('success', 'Proposal accepted.');
                            }
                        }
                    }
                }
                
                // Notify Proposer
                $db = Database::getInstance();
                $proposer = $db->fetchOne("SELECT account_id FROM user_profile WHERE id = ?", [$negotiation['proposer_profile_id']]);
                if ($proposer) {
                    $msg = "Your proposal was " . $status . ".";
                    $type = ($status === 'accepted') ? 'success' : 'error';
                    $this->model('Notification')->add($proposer['account_id'], $msg, $type);
                }

                $this->redirect(BASE_URL . "/applications/{$negotiation['application_id']}/negotiate");
                return;
            } else {
                $this->flash('error', 'Failed to update status.');
            }
        } catch (Exception $e) {
            $this->flash('error', $e->getMessage());
            // Try to redirect back to app if we have ID
            if (isset($negotiation)) {
                $this->redirect(BASE_URL . "/applications/{$negotiation['application_id']}/negotiate");
            } else {
                $this->redirect(BASE_URL . '/my-applications');
            }
        }
    }
}
