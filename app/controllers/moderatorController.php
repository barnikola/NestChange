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
        $userModel = $this->model('User');
        $listingModel = $this->model('Listing');

        $data = [
            'pendingDocuments' => $userModel->countAllPendingDocuments(),
            'pendingListings' => $listingModel->countSearch(['status' => 'pending-approval']) + $listingModel->countSearch(['status' => 'draft'])
        ];

        $this->view('moderator/dashboard', $data);
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
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /moderator/documents');
                exit;
            }
            $documentId = $_POST['document_id'];
            $userId = $_POST['user_id'] ?? null;
            $action = $_POST['action']; // 'approve' or 'reject'
            
            $userModel = $this->model('User');
            $document = $userModel->getDocument($documentId);
            $userId = $document['account_id'] ?? $userId; // Ensure we have userId

            $docLabel = match ((int)($document['document_type_id'] ?? 0)) {
                1 => 'Passport / ID',
                2 => 'Student ID',
                default => 'Document',
            };
            
            if ($action === 'approve') {
                if ($userModel->updateDocumentStatus($documentId, 'approved')) {
                    $this->setFlash('success', 'Document verified successfully.');
                    if ($userId) {
                        $this->model('Notification')->add($userId, "Your {$docLabel} has been verified successfully.", 'success');
                    }
                } else {
                     $this->setFlash('error', 'Failed to update document status.');
                }
            } elseif ($action === 'reject') {
                $userModel->updateDocumentStatus($documentId, 'rejected');
                 if ($userId) {
                    $this->model('Notification')->add($userId, "Your {$docLabel} verification was rejected. Please re-upload.", 'error');
                }
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
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /moderator/listings');
                exit;
            }
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
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /moderator/listings');
                exit;
            }
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
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /moderator/listings');
                exit;
            }
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
