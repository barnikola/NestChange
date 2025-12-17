<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/services/EmailService.php';

class ModeratorController extends Controller
{
    private function requireModerator(): void
    {
        $this->requireAuth();
        $userId = Session::getUserId();
        $user = $this->model('User')->find($userId);
        
        if (!$user || !in_array($user['role'], ['admin', 'moderator'])) {
            header('Location: /');
            exit;
        }
    }

    public function index(): void
    {
        $this->requireModerator();
        $this->view('moderator/dashboard');
    }

    public function documents(): void
    {
        $this->requireModerator();
        $userModel = $this->model('User');
        $documents = $userModel->getAllDocuments();
        $this->view('moderator/document_table', ['documents' => $documents]);
    }

    public function listings(): void
    {
        $this->requireModerator();
        $listingModel = $this->model('Listing');
        $listings = $listingModel->getAllListings();
        $this->view('moderator/listing_table', ['listings' => $listings]);
    }

    // --- Actions ---

    public function approveDocument(): void
    {
        $this->requireModerator();
        if ($this->isPost()) {
            $documentId = $_POST['document_id'];
            $userId = $_POST['user_id'] ?? null;
            $action = $_POST['action']; // 'approve' or 'reject'
            
            $userModel = $this->model('User');
            
            if ($action === 'approve') {
                if ($userModel->updateDocumentStatus($documentId, 'approved')) {
                    $this->setFlash('success', 'Document verified successfully.');
                } else {
                     $this->setFlash('error', 'Failed to update document status.');
                }
            } elseif ($action === 'reject') {
                $userModel->updateDocumentStatus($documentId, 'rejected');
                 $this->setFlash('success', 'Document rejected.');
            }
        }
        header('Location: /moderator/documents');
        exit;
    }

    public function publishListing(): void
    {
        $this->requireModerator();
        if ($this->isPost()) {
            $id = $_POST['listing_id'];
            $this->model('Listing')->update($id, ['status' => 'published']);
            $this->setFlash('success', 'Listing published.');
        }
        header('Location: /moderator/listings');
        exit;
    }

    public function pauseListing(): void
    {
         $this->requireModerator();
        if ($this->isPost()) {
            $id = $_POST['listing_id'];
             $this->model('Listing')->update($id, ['status' => 'paused']);
             $this->setFlash('success', 'Listing paused.');
        }
        header('Location: /moderator/listings');
         exit;
    }
    
    public function deleteListing(): void
    {
         $this->requireModerator();
        if ($this->isPost()) {
            $id = $_POST['listing_id'];
             $this->model('Listing')->delete($id);
             $this->setFlash('success', 'Listing deleted.');
        }
        header('Location: /moderator/listings');
         exit;
    }

    // Helper for flash messages
    private function setFlash($type, $message) {
        $_SESSION['flash_type'] = $type;
        $_SESSION['flash_message'] = $message;
    }
}
