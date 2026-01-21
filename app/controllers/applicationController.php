<?php

require_once dirname(__DIR__) . '/core/controller.php';

class ApplicationController extends Controller
{
    /**
     * Applications of registered users
     * GET /my-applications
     */
    public function myApplications(): void
    {
        $this->requireAuth();
        $user = $this->currentUser();

        $appModel = $this->model('Application');
        
        // Auto-complete any expired exchanges before display
        try {
            $completedCount = $appModel->markExpiredAsCompleted();
            if ($completedCount > 0) {
                // If we completed any, functionality to send notifications is in AuthController
                // We could duplicate it here or abstract it.
                // For now, ensuring the status is correct on screen is the priority.
                // Notifications might be missed if they only visit this page and don't re-login,
                // but the status will be correct.
                // Let's trigger the notification logic too for consistency.
                $notifModel = $this->model('Notification');
                $completed = $appModel->getRecentlyCompleted();
                
                foreach ($completed as $exchange) {
                     if (!empty($exchange['applicant_id'])) {
                        $notifModel->add($exchange['applicant_id'], "Your exchange for '{$exchange['listing_title']}' is complete! Leave a review.", 'success');
                    }
                    if (!empty($exchange['host_id'])) {
                        $notifModel->add($exchange['host_id'], "Exchange for '{$exchange['listing_title']}' is complete! Leave a review.", 'success');
                    }
                }
            }
        } catch (Exception $e) {
            // Silent fail
        }

        $applications = $appModel->getByApplicantId($user['id']);

        $this->view('applications/my', [
            'applications' => $applications,
        ]);
    }

    /**
     * Applications received for user's listings
     * GET /received-applications
     */
    public function receivedApplications(): void
    {
        $this->requireAuth();
        $user = $this->currentUser();

        $appModel = $this->model('Application');

        $profileId = $user['profile_id'] ?? null;
        
        if (!$profileId) {
             $applications = [];
        } else {
             $applications = $appModel->getReceivedByUserId($profileId);
        }

        $this->view('applications/received', [
            'applications' => $applications,
        ]);
    }

    /**
     * Show single application
     * GET /applications/{id}
     */
    public function show(string $id): void
    {
        $this->requireAuth();

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application) {
            $this->flash('error', 'Application not found.');
            $this->redirect(BASE_URL . '/my-applications');
        }

        $user = $this->currentUser();

        $isHost = isset($user['profile_id']) && ($user['profile_id'] == ($application['owner_profile_id'] ?? null));
        $isApplicant = ($user['id'] == ($application['applicant_id'] ?? null));

        if (!$isHost && !$isApplicant) {
            $this->flash('error', 'You are not authorized to view this application.');
            $this->redirect(BASE_URL . '/my-applications');
        }

        $this->view('applications/show', [
            'application' => $application,
            'isHost' => $isHost,
            'isApplicant' => $isApplicant
        ]);
    }

    /**
     * Application form
     * GET /listings/{listingId}/apply
     */
    public function create(string $listingId): void
    {
        $this->requireAuth();
        $user = $this->currentUser();

        if (isset($user['profile_id'])) {
            $listingModel = $this->model('Listing');
            if ($listingModel->isOwner($listingId, $user['profile_id'])) {
                $this->flash('error', 'You cannot apply to your own listing.');
                $this->redirect(BASE_URL . '/listings/' . $listingId);
                return;
            }
        }
        $this->view('applications/create', [
            'listingId'  => $listingId,
            'csrf_token' => $this->getCsrfToken(),
        ]);
    }

    /**
     * Submit new application
     * POST /listings/{listingId}/apply
     */
    public function store(string $listingId): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . "/listings/{$listingId}/apply");
        }

        $user = $this->currentUser();
        $applicantProfileId = $user['profile_id'] ?? null;

        if (!$applicantProfileId) {
            $db = Database::getInstance();
            $profile = $db->fetchOne("SELECT id FROM user_profile WHERE account_id = ?", [$user['id']]);
            $applicantProfileId = $profile['id'] ?? null;
        }

        if (!$applicantProfileId) {
            $this->flash('error', 'Please complete your profile before applying.');
            $this->redirect(BASE_URL . '/profile/edit');
            return;
        }

        $data = [
            'listingid'          => $listingId,
            'applicantid'        => $user['id'],
            'applicantprofileid' => $applicantProfileId,
            'startdate'          => $this->postInput('startdate'),
            'enddate'            => $this->postInput('enddate'),
            'message'            => $this->postInput('message', ''),
        ];

        $appModel = $this->model('Application');

        // Check for existing active application
        $existingAppId = $appModel->getActiveApplicationId($user['id'], $listingId);
        if ($existingAppId) {
            $this->flash('info', 'You already have an active application for this listing.');
            $this->redirect(BASE_URL . '/applications/' . $existingAppId);
        }

        $appModel->createApplication($data);
        
        // Notify the Host
        try {
            $listingModel = $this->model('Listing');
            $listing = $listingModel->find($listingId);
            if ($listing && isset($listing['host_profile_id'])) {
                $db = Database::getInstance();
                $owner = $db->fetchOne("SELECT account_id FROM user_profile WHERE id = ?", [$listing['host_profile_id']]);
                if ($owner && isset($owner['account_id'])) {
                    $this->model('Notification')->add(
                        $owner['account_id'], 
                        "New application received for '{$listing['title']}'", 
                        'info'
                    );
                }
            }
        } catch (Exception $e) { /* Ignore notification error */ }

        $this->flash('success', 'Application submitted successfully.');

        $this->redirect(BASE_URL . '/my-applications');
    }

    /**
     * Accept application
     * POST /applications/{id}/accept
     */
    public function accept(string $id): void
    {
        if ($this->updateStatus($id, 'accepted', false)) {
            // Auto-withdraw other pending applications for this applicant
            $appModel = $this->model('Application');
            $application = $appModel->findById($id);
            
            if ($application) {
                $count = $appModel->withdrawPendingExcept($application['applicant_id'], $id);
                if ($count > 0) {
                    // Update the flash message set by updateStatus to include this info
                    // Since updateStatus sets a specific message, we might overwrite it or append.
                    // Session::getFlash('success') might consume it.
                    // Let's just set a combined message.
                    $this->flash('success', 'Application accepted. ' . $count . ' other pending requests for this user were auto-withdrawn.');
                }
            }
            
        } else {
            $this->flash('error', 'Failed to approve application. Please check your permissions.');
        }
        
        // Always redirect to detail page
        $this->redirect(BASE_URL . "/applications/$id");
    }

    /**
     * Reject application
     * POST /applications/{id}/reject
     */
    public function reject(string $id): void
    {
        $this->updateStatus($id, 'rejected');
    }

    /**
     * Withdraw application
     * POST /applications/{id}/withdraw
     */
    public function withdraw(string $id): void
    {
        $this->updateStatus($id, 'withdrawn');
    }

    /**
     * JSON list for dashboard
     * GET /applications/list.json
     */
    public function listJson(): void
    {
        $this->requireAuth();

        $appModel = $this->model('Application');
        $list = $appModel->getForDashboard();
        $this->json($list);
    }

    /**
     * Cancel application
     * POST /applications/{id}/cancel
     */
    public function cancel(string $id): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . "/applications/$id");
        }

        $appModel = $this->model('Application');
        // Fetches listing data including cancellation_policy
        $application = $appModel->findById($id);

        if (!$application) {
            $this->flash('error', 'Application not found.');
            $this->redirect(BASE_URL . '/my-applications');
        }

        $user = $this->currentUser();
        
        $appApplicantId = $application['applicant_id'] ?? null;
        $appOwnerId = null;
        if (isset($application['owner_profile_id'])) {
            $db = Database::getInstance();
            $owner = $db->fetchOne("SELECT account_id FROM user_profile WHERE id = ?", [$application['owner_profile_id']]);
            if ($owner) $appOwnerId = $owner['account_id'];
        }

        // Use loose comparison as IDs might be different types (string/int)
        $isApplicant = ($user['id'] == $appApplicantId);
        $isHost = (isset($user['id']) && $user['id'] == $appOwnerId);


        if (!$isApplicant && !$isHost) {
             $this->flash('error', 'You are not authorized to cancel this application.');
             $this->redirect(BASE_URL . "/applications/$id");
        }

        // Check if status allows cancellation
        if (!in_array($application['status'], ['pending', 'accepted'])) {
             $this->flash('error', 'Application cannot be cancelled in its current status.');
             $this->redirect(BASE_URL . "/applications/$id");
        }

        // Check eligibility
        if ($isHost) {
            // Host cancellation - no penalty to guest
            $eligibility = [
                'allowed' => true,
                'penalty' => 'None',
                'message' => 'Application cancelled by Host.'
            ];
        } else {
            // Applicant cancellation - check policy
            require_once dirname(__DIR__) . '/helpers/CancellationPolicyHelper.php';
            
            // CRITICAL: Ensure we have a policy. If missing, something went wrong with the join/data.
            $policy = $application['cancellation_policy'] ?? null;
            $startDate = $application['start_date'] ?? null;
            
            if (!$policy || !$startDate) {
                // If we don't know the policy or date, assume restricted for safety
                $eligibility = [
                    'allowed' => false, 
                    'penalty' => 'Restricted', 
                    'message' => 'Cancellation policy or start date is missing. Please contact support.'
                ];
            } else {
                $eligibility = CancellationPolicyHelper::checkEligibility($policy, $startDate);
            }
        }
        
        if (!$eligibility['allowed'] && !$isHost) {
             // For any applicant cancellation that is not allowed directly (Warning or Restricted),
             // proceed to the mutual cancellation request logic below.
        }

        // Host cancellation OR Restricted Guest cancellation - always a request
        if ($isHost || ($isApplicant && !$eligibility['allowed'])) {
            $reason = $this->postInput('reason', ($isHost ? 'Host' : 'Guest') . ' requested cancellation');
            
            if ($appModel->setStatus($id, 'cancel_requested', $user['id'])) {
                // Record the request details
                $appModel->recordCancellationRequest($id, $reason, $eligibility, $user['id']);

                $otherParty = $isHost ? "Guest" : "Host";
                $this->flash('success', "Cancellation request sent to {$otherParty}. They must approve it to finalize cancellation.");
                
                // Notify Other Party
                $notifModel = $this->model('Notification');
                $targetId = null;
                if ($isHost) {
                    $targetId = $application['applicant_id'];
                } else {
                    $db = Database::getInstance();
                    $owner = $db->fetchOne("SELECT account_id FROM user_profile WHERE id = ?", [$application['owner_profile_id']]);
                    if ($owner) $targetId = $owner['account_id'];
                }

                if ($targetId) {
                    $senderType = $isHost ? "Host" : "Guest";
                    $notifModel->add(
                        $targetId,
                        "{$senderType} has requested to cancel the booking for '{$application['listing_title']}'. Please review and approve/reject.",
                        'info'
                    );
                }
            } else {
                $this->flash('error', 'Failed to send cancellation request.');
            }
            $this->redirect(BASE_URL . "/applications/$id");
            return;
        }

        // Applicant Cancellation (Direct if allowed)
        if (!$eligibility['allowed']) {
             $this->flash('error', 'Direct cancellation is no longer possible for this booking. A request has been sent instead.');
             $this->redirect(BASE_URL . "/applications/$id");
             return;
        }

        $reason = $this->postInput('reason', 'User requested cancellation');
        if ($appModel->cancelApplication($id, $reason, $eligibility)) {
             $this->flash('success', 'Application cancelled. ' . $eligibility['message']);
             
             // Send Email Notifications
             require_once dirname(__DIR__) . '/services/EmailService.php';
             $emailService = new EmailService();
             $emailService->sendCancellationNotification($application, $eligibility);

             // Send System Notifications
             $notifModel = $this->model('Notification');
             $cancelByMsg = "the guest";
             
             // Notify Guest (Applicant)
             if (!empty($application['applicant_id'])) {
                 $notifModel->add($application['applicant_id'], "Booking for '{$application['listing_title']}' has been cancelled by the guest.", 'warning');
             }

             // Notify Host (Owner)
             if (!empty($application['owner_profile_id'])) {
                 $db = Database::getInstance();
                 $owner = $db->fetchOne("SELECT account_id FROM user_profile WHERE id = ?", [$application['owner_profile_id']]);
                 if ($owner) {
                     $notifModel->add($owner['account_id'], "Booking for '{$application['listing_title']}' has been cancelled by the guest.", 'warning');
                 }
             }
             
        } else {
             $this->flash('error', 'Failed to cancel application.');
        }

        $this->redirect(BASE_URL . "/applications/$id");
    }

    /**
     * Approve cancellation request
     * POST /applications/{id}/approve-cancel
     */
    public function approveCancellation(string $id): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . "/applications/$id");
        }

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application || $application['status'] !== 'cancel_requested') {
            $this->flash('error', 'No pending cancellation request found.');
            $this->redirect(BASE_URL . "/applications/$id");
        }

        $user = $this->currentUser();
        
        // Only the party who DID NOT request can approve
        if ($user['id'] == $application['cancel_requester_id']) {
            $this->flash('error', 'You cannot approve your own cancellation request.');
            $this->redirect(BASE_URL . "/applications/$id");
            return;
        }

        // Finalize cancellation
        $eligibility = ['allowed' => true, 'penalty' => 'None', 'message' => 'Mutual cancellation approved.'];
        if ($appModel->cancelApplication($id, 'Mutual agreement cancellation', $eligibility)) {
            $this->flash('success', 'Booking cancelled by mutual agreement.');
            
            // Notify the requester
            $notifModel = $this->model('Notification');
            $notifModel->add($application['cancel_requester_id'], "Your cancellation request for '{$application['listing_title']}' has been approved.", 'success');
        } else {
            $this->flash('error', 'Failed to approve cancellation.');
        }

        $this->redirect(BASE_URL . "/applications/$id");
    }

    /**
     * Reject cancellation request
     * POST /applications/{id}/reject-cancel
     */
    public function rejectCancellation(string $id): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . "/applications/$id");
        }

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application || $application['status'] !== 'cancel_requested') {
            $this->flash('error', 'No pending cancellation request found.');
            $this->redirect(BASE_URL . "/applications/$id");
        }

        $user = $this->currentUser();
        
        // Only the party who DID NOT request can reject
        if ($user['id'] == $application['cancel_requester_id']) {
            $this->flash('error', 'You cannot reject your own cancellation request.');
            $this->redirect(BASE_URL . "/applications/$id");
            return;
        }

        // Revert to accepted
        if ($appModel->setStatus($id, 'accepted')) {
            $this->flash('success', 'Cancellation request rejected. Booking remains active.');
            
            // Notify the requester
            $notifModel = $this->model('Notification')->add(
                $application['cancel_requester_id'], 
                "Your cancellation request for '{$application['listing_title']}' has been rejected.", 
                'warning'
            );
        } else {
            $this->flash('error', 'Failed to reject cancellation.');
        }

        $this->redirect(BASE_URL . "/applications/$id");
    }

    /**
     * Helper to update status
     */
    private function updateStatus(string $id, string $status, bool $shouldRedirect = true): bool
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request');
            if ($shouldRedirect) $this->redirect(BASE_URL . "/applications/$id");
            return false;
        }

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application) {
            $this->flash('error', 'Application not found');
            if ($shouldRedirect) $this->redirect(BASE_URL . '/my-applications');
            return false;
        }

        $user = $this->currentUser();
        $isHost = isset($user['profile_id']) && ($user['profile_id'] == ($application['owner_profile_id'] ?? null));
        $isApplicant = ($user['id'] == ($application['applicant_id'] ?? null));


        $allowed = false;
        if (in_array($status, ['accepted', 'rejected']) && $isHost) {
            $allowed = true;
        } elseif ($status === 'withdrawn' && $isApplicant && ($application['status'] === 'pending' || $application['status'] === 'accepted')) {
            $allowed = true;
        }

        if (!$allowed) {
            $this->flash('error', 'You are not authorized to perform this action or application status does not allow it.');
            if ($shouldRedirect) $this->redirect(BASE_URL . "/applications/$id");
            return false;
        }

        $appModel->setStatus($id, $status);
        
        // Notify Applicant
        if ($isHost && in_array($status, ['accepted', 'rejected'])) {
             $msg = "Your application was " . $status;
             $type = ($status === 'accepted') ? 'success' : 'error';
             $this->model('Notification')->add($application['applicant_id'], $msg, $type);
        }

        // Chat Bootstrap Hook
        if ($status === 'accepted' && class_exists('Chat') && method_exists('Chat', 'bootstrapThread')) {
            Chat::bootstrapThread($id);
        }
        
        $this->flash('success', 'Application status updated to ' . ucfirst($status));
        
        if ($shouldRedirect) {
            $this->redirect(BASE_URL . "/applications/$id");
        }
        
        return true;
    }
}
