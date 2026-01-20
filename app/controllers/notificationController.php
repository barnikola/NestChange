<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/services/EmailService.php';

class NotificationController extends Controller
{
    /**
     * Trigger approval workflow for a user
     * POST /notifications/trigger-approval
     */
    public function triggerApproval(): void
    {
        $this->requireAuth();

        if (!$this->isPost()) {
             $this->json(['error' => 'Method not allowed. Use POST.'], 405);
        }

        $userId = $this->postInput('user_id');
        
        if (!$userId) {
            $this->json(['error' => 'User ID is required'], 400);
        }

        $userModel = $this->model('User');
        $user = $userModel->find($userId);
        
        if (!$user) {
            $this->json(['error' => 'User not found'], 404);
        }
        
        try {

            $emailService = new EmailService();
            $emailService->sendAccountApproved($user);
            $notifModel = $this->model('Notification');
            $notifModel->add($userId, "Your account has been approved! Welcome to NestChange.", 'success');

            $this->json([
                'success' => true, 
                'message' => 'Approval triggered successfully. Email sent and notification created.'
            ]);
            
        } catch (Exception $e) {
            $this->json(['error' => 'Error processing request: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Mark a notification as read
     * POST /notifications/{id}/read
     */
    public function read(string $id): void
    {
        $this->requireAuth();
        
        if (!$this->isPost()) {
             $this->json(['error' => 'Method not allowed'], 405);
        }
        
        $userId = Session::getUserId();
        $notifModel = $this->model('Notification');
        
        if ($notifModel->markAsRead($id, $userId)) {
            $this->json(['success' => true]);
        } else {
            $this->json(['error' => 'Notification not found or access denied'], 404);
        }
    }

    /**
     * Get latest notifications
     * GET /notifications/latest
     */
    public function latest(): void
    {
        $this->requireAuth();
        
        $userId = Session::getUserId();
        $notifModel = $this->model('Notification');
        
        $notifications = $notifModel->getLatest($userId, 5);
        
        $this->json(['notifications' => $notifications]);
    }

    /**
     * Get unread notification count
     * GET /notifications/count
     */
    public function unreadCount(): void
    {
        $this->requireAuth();
        
        $userId = Session::getUserId();
        $notifModel = $this->model('Notification');
        
        $count = $notifModel->getUnreadCount($userId);
        
        $this->json(['count' => $count]);
    }

    /**
     * View user notifications
     * GET /notifications
     */
    public function index(): void
    {
        $this->requireAuth();
        
        $userId = Session::getUserId();
        $notifModel = $this->model('Notification');
        
        // Mark as read when viewing the list
        $notifModel->markAllAsRead($userId);
        
        $notifications = $notifModel->getByUserId($userId);
        
        $this->view('notifications/index', ['notifications' => $notifications]);
    }
}
