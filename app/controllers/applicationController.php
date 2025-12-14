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
}
