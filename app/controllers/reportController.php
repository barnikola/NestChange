<?php
require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/models/report.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';
require_once dirname(__DIR__) . '/services/EmailService.php';
require_once dirname(__DIR__) . '/core/database.php';

class ReportController extends Controller
{
    public function create(): void
    {
        $this->requireAuth();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->json(['success' => false, 'error' => 'Invalid request (CSRF mismatch).']);
                return;
            }
            $reporterId = $this->getUserProfileId();

            // If no profile, we cannot set reporter_id because it references user_profile.
            // But we can still allow the report as anonymous or handle it. 
            // However, the schema allows NULL.
            // Falling back to account id ($user['id']) causes FK constraint violation.
            
            // So, do NOT fallback to account ID if profile is missing.
            // Just leave it as null or handle the error.
            if (!$reporterId) {
                 // Try to find profile one more time or just proceed as anonymous/system
                 // For now, let's keep it null if not found to avoid 500 error
                 $reporterId = null; 
            }
            $reporterId = $this->getUserProfileId();
            
            // If no profile found, we used to fallback to account ID, but that causes FK violation.
            // If we want to strictly require a profile:
            if (!$reporterId) {
                // Try to see if we can just log it as anonymous (null) or if we strictly require profile.
                // For now, let's allow NULL if the database allows it (it does: DEFAULT NULL).
                // But wait, createReport() signature might expect something.
                 $reporterId = null;
            }
            
            // Re-check valid input
            $reportedType = $this->postInput('reported_type');
            $reportedId = $this->postInput('reported_id');
            
            // Normalize reason input to match ENUMs
            $rawReason = strtolower($this->postInput('reason') ?? '');
            $reasonMap = [
                'fraud' => 'scam',
                'inappropriate content' => 'inappropriate',
                'other' => 'other',
                'spam' => 'spam',
                'harassment' => 'harassment',
                'scam' => 'scam',
                'inappropriate' => 'inappropriate',
                'contact' => 'contact'
            ];
            $reason = $reasonMap[$rawReason] ?? $rawReason;
            
            $description = trim($this->postInput('description') ?? '');
            // Validation
            if (empty($reportedType) || empty($reportedId)) {
                $this->json(['success' => false, 'error' => 'Invalid report target.']);
                return;
            }
            if (empty($reason)) {
                $this->json(['success' => false, 'error' => 'Please select a reason.']);
                return;
            }
            if (empty($description) || strlen($description) < 10) {
                $this->json(['success' => false, 'error' => 'Description must be at least 10 characters long.']);
                return;
            }
            try {
                $model = new Report();
                $model->createReport($reporterId, $reportedType, $reportedId, $reason, $description);
                $this->json(['success' => true, 'message' => 'Report submitted successfully.']);
            } catch (Exception $e) {
                error_log('Report creation error: ' . $e->getMessage());
                $this->json(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
            }
            return;
        }
        $this->json(['success' => false, 'error' => 'Invalid request method.']);
    }

    public function index(): void
    {
        AuthMiddleware::requireModerator();
        $status = $this->getInput('status') ?? null;
        $model = new Report();
        $reports = $model->getReports($status);
        
        $pageTitle = 'Admin Reports - NestChange';
        $activeNav = '';
        $breadcrumbs = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Admin Dashboard', 'url' => '/admin/dashboard'],
            ['label' => 'Reports']
        ];
        
        ob_start();
        include dirname(__DIR__) . '/views/admin/reports.php';
        $content = ob_get_clean();
        
        include dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function update(): void
    {
        AuthMiddleware::requireModerator();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->json(['success' => false, 'error' => 'Invalid request (CSRF mismatch).']);
                return;
            }
            $id = $this->postInput('id');
            $status = $this->postInput('status');
            
            if (!in_array($status, ['pending', 'reviewed', 'resolved'])) {
                $this->json(['success' => false, 'error' => 'Invalid status.']);
                return;
            }
            
            $model = new Report();
            
            // Get report with reporter info before updating
            $report = $model->getReportWithReporter($id);
            
            if (!$report) {
                $this->json(['success' => false, 'error' => 'Report not found.']);
                return;
            }
            
            // Update status
            $extraData = [];
            if ($status === 'resolved') {
                $extraData = [
                    'resolved_by' => $this->currentUser()['id'] ?? null,
                    'resolved_at' => date('Y-m-d H:i:s')
                ];
            }

            if ($model->updateStatus($id, $status, $extraData)) {
                // Send email notification to reporter
                try {
                    $emailService = new EmailService();
                    $emailService->sendReportStatusUpdate($report, $status);
                } catch (Exception $e) {
                    // Log error but don't fail the request
                    error_log("Failed to send report status email: " . $e->getMessage());
                }
                
                $this->json(['success' => true, 'message' => 'Status updated successfully.']);
            } else {
                $this->json(['success' => false, 'error' => 'Failed to update status.']);
            }
            return;
        }
        $this->json(['success' => false, 'error' => 'Invalid request.']);
    }

    /**
     * Get user's profile ID
     */
    private function getUserProfileId(): ?string
    {
        $user = $this->currentUser();
        if (!$user) {
            return null;
        }
        
        $db = Database::getInstance();
        $profile = $db->fetchOne(
            "SELECT id FROM user_profile WHERE account_id = ?",
            [$user['id']]
        );
        
        return $profile['id'] ?? null;
    }
}
