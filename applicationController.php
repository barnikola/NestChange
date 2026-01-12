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
            'listingId' => $listingId,
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
            'listingid' => $listingId,
            'applicantid' => $user['id'],
            'applicantprofileid' => $applicantProfileId,
            'startdate' => $this->postInput('startdate'),
            'enddate' => $this->postInput('enddate'),
            'message' => $this->postInput('message', ''),
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
    public function accept(string $id): void
    {
        $this->updateStatus($id, 'accepted');
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
     * Helper to update status
     */
    private function updateStatus(string $id, string $status): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request');
            $this->redirect(BASE_URL . "/applications/$id");
            return;
        }

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application) {
            $this->flash('error', 'Application not found');
            $this->redirect(BASE_URL . '/my-applications');
            return;
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
            $this->redirect(BASE_URL . "/applications/$id");
            return;
        }

        $appModel->setStatus($id, $status);

        $this->flash('success', 'Application status updated to ' . ucfirst($status));
        $this->redirect(BASE_URL . "/applications/$id");
    }

    /**
     * Show negotiation form
     * GET /applications/{id}/negotiate
     */
    public function negotiate(string $id): void
    {
        $this->requireAuth();

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application) {
            $this->flash('error', 'Application not found.');
            $this->redirect(BASE_URL . '/my-applications');
        }

        // Check if application status allows negotiation
        if (!in_array($application['status'], ['pending'])) {
            $this->flash('error', 'Negotiation is only available for pending applications.');
            $this->redirect(BASE_URL . "/applications/{$id}");
            return;
        }

        $user = $this->currentUser();
        $isHost = isset($user['profile_id']) && ($user['profile_id'] === ($application['owner_profile_id'] ?? null));
        $isApplicant = ($user['id'] === ($application['applicant_id'] ?? null));

        if (!$isHost && !$isApplicant) {
            $this->flash('error', 'You are not authorized to negotiate this application.');
            $this->redirect(BASE_URL . '/my-applications');
            return;
        }

        $history = $appModel->getNegotiationHistory($id);

        $this->view('applications/negotiate', [
            'application' => $application,
            'history' => $history,
            'isHost' => $isHost,
            'isApplicant' => $isApplicant,
            'csrf_token' => $this->getCsrfToken()
        ]);
    }

    /**
     * Submit a negotiation offer
     * POST /applications/{id}/negotiate
     */
    public function submitNegotiation(string $id): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . "/applications/{$id}/negotiate");
        }

        $appModel = $this->model('Application');
        $application = $appModel->findById($id);

        if (!$application) {
            $this->flash('error', 'Application not found.');
            $this->redirect(BASE_URL . '/my-applications');
        }

        $user = $this->currentUser();
        $profileId = $user['profile_id'] ?? null;

        if (!$profileId) {
            $this->flash('error', 'Profile not found.');
            $this->redirect(BASE_URL . "/applications/{$id}");
            return;
        }

        // Prevent negotiation on non-pending applications
        if ($application['status'] !== 'pending') {
            $this->flash('error', 'Cannot negotiate on applications that are not pending.');
            $this->redirect(BASE_URL . "/applications/{$id}");
            return;
        }

        // Get and validate dates
        $startDate = $this->postInput('start_date');
        $endDate = $this->postInput('end_date');

        // Validate dates
        if (empty($startDate) || empty($endDate)) {
            $this->flash('error', 'Both start and end dates are required.');
            $this->redirect(BASE_URL . "/applications/{$id}/negotiate");
            return;
        }

        // Check if dates are valid
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $today = strtotime('today');

        if ($start === false || $end === false) {
            $this->flash('error', 'Invalid date format.');
            $this->redirect(BASE_URL . "/applications/{$id}/negotiate");
            return;
        }

        // Check if start date is in the past
        if ($start < $today) {
            $this->flash('error', 'Start date cannot be in the past.');
            $this->redirect(BASE_URL . "/applications/{$id}/negotiate");
            return;
        }

        // Check if end date is before start date
        if ($end <= $start) {
            $this->flash('error', 'End date must be after start date.');
            $this->redirect(BASE_URL . "/applications/{$id}/negotiate");
            return;
        }

        $data = [
            'sender_profile_id' => $profileId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'message' => $this->postInput('message'),
            'status' => 'pending'
        ];

        $appModel->recordNegotiation($id, $data);

        $this->flash('success', 'Negotiation offer sent.');
        $this->redirect(BASE_URL . "/applications/{$id}");
    }

    /**
     * Accept a negotiation offer
     * POST /negotiations/{id}/accept
     */
    public function acceptNegotiation(string $negotiationId): void
    {
        $this->requireAuth();

        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . '/my-applications');
            return;
        }

        $appModel = $this->model('Application');
        $negotiation = $appModel->getNegotiation($negotiationId);

        if (!$negotiation) {
            $this->flash('error', 'Negotiation not found.');
            $this->redirect(BASE_URL . '/my-applications');
            return;
        }

        // Check if negotiation is still pending
        if ($negotiation['status'] !== 'pending') {
            $this->flash('error', 'This negotiation offer is no longer available.');
            $this->redirect(BASE_URL . '/my-applications');
            return;
        }

        $application = $appModel->findById($negotiation['application_id']);

        if (!$application) {
            $this->flash('error', 'Application not found.');
            $this->redirect(BASE_URL . '/my-applications');
            return;
        }

        // Check if application is still pending
        if ($application['status'] !== 'pending') {
            $this->flash('error', 'Cannot accept negotiation for non-pending applications.');
            $this->redirect(BASE_URL . "/applications/{$application['id']}");
            return;
        }

        $user = $this->currentUser();

        // Only the other party can accept
        if ($negotiation['sender_profile_id'] === $user['profile_id']) {
            $this->flash('error', 'You cannot accept your own offer.');
            $this->redirect(BASE_URL . "/applications/{$application['id']}");
            return;
        }

        // Verify user is authorized (host or applicant)
        $isHost = isset($user['profile_id']) && ($user['profile_id'] === ($application['owner_profile_id'] ?? null));
        $isApplicant = ($user['id'] === ($application['applicant_id'] ?? null));

        if (!$isHost && !$isApplicant) {
            $this->flash('error', 'You are not authorized to accept this negotiation.');
            $this->redirect(BASE_URL . '/my-applications');
            return;
        }

        // Update application terms
        $appModel->update($application['id'], [
            'start_date' => $negotiation['start_date'],
            'end_date' => $negotiation['end_date']
        ]);

        // Update negotiation status
        $appModel->updateNegotiationStatus($negotiationId, 'accepted');

        $this->flash('success', 'Negotiation offer accepted. Application terms updated.');
        $this->redirect(BASE_URL . "/applications/{$application['id']}");
    }
}
