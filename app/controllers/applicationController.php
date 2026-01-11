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

        $isHost = isset($user['profile_id']) && ($user['profile_id'] === ($application['owner_profile_id'] ?? null));
        $isApplicant = ($user['id'] === ($application['applicant_id'] ?? null));

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
        $appModel->createApplication($data);
        $this->flash('success', 'Application submitted successfully.');

        $this->redirect(BASE_URL . '/my-applications');
    }

    /**
     * Accept application
     * POST /applications/{id}/accept
     */
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
            
            $this->redirect(BASE_URL . "/applications/$id");
        }
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
        
        $isApplicant = ($user['id'] === ($application['applicant_id'] ?? null));
        $isHost = (isset($user['profile_id']) && $user['profile_id'] === ($application['owner_profile_id'] ?? null));

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
            // Host cancellation always full refund
            $eligibility = [
                'allowed' => true,
                'refund' => 'Full',
                'message' => 'Full refund (Cancelled by Host).'
            ];
        } else {
            // Applicant cancellation - check policy
            require_once dirname(__DIR__) . '/helpers/CancellationPolicyHelper.php';
            $policy = $application['cancellation_policy'] ?? 'flexible'; 
            $startDate = $application['start_date'];
            
            if (!$startDate) {
                 $eligibility = ['allowed' => true, 'refund' => 'Full', 'message' => 'Full refund (No start date).'];
            } else {
                 $eligibility = CancellationPolicyHelper::checkEligibility($policy, $startDate);
            }
        }

        if (!$eligibility['allowed']) {
             $this->flash('error', $eligibility['message']);
             $this->redirect(BASE_URL . "/applications/$id");
        }

        // Cancel
        $reason = $this->postInput('reason', 'User requested cancellation');
        if ($appModel->cancelApplication($id, $reason, $eligibility)) {
             $this->flash('success', 'Application cancelled. ' . $eligibility['message']);
             
             // Send Email Notifications
             require_once dirname(__DIR__) . '/services/EmailService.php';
             $emailService = new EmailService();
             // Refetch application to get updated status if needed, but we have enough info in $application and $eligibility
             // We just need to pass the basic info we already fetched.
             // Note: findById was updated to include email/names, so $application has them.
             $emailService->sendCancellationNotification($application, $eligibility);
             
        } else {
             $this->flash('error', 'Failed to cancel application.');
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
        $isHost = isset($user['profile_id']) && ($user['profile_id'] === ($application['owner_profile_id'] ?? null));
        $isApplicant = ($user['id'] === ($application['applicant_id'] ?? null));

        $allowed = false;
        if (in_array($status, ['accepted', 'rejected']) && $isHost) {
            $allowed = true;
        } elseif ($status === 'withdrawn' && $isApplicant) {
            $allowed = true;
        }

        if (!$allowed) {
            $this->flash('error', 'You are not authorized to perform this action.');
            if ($shouldRedirect) $this->redirect(BASE_URL . "/applications/$id");
            return false;
        }

        $appModel->setStatus($id, $status);
        
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
