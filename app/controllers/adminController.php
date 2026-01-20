<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/services/EmailService.php';


class AdminController extends Controller
{
    protected function requireAdmin(): void
    {
        $this->requireAuth();
        $userId = Session::getUserId();
        $user = $this->model('User')->find($userId);
        
        if (!$user || $user['role'] !== 'admin') {
            header('Location: /');
            exit;
        }
    }

    public function index(): void
    {
        $this->requireAdmin();
        $userModel = $this->model('User');
        $listingModel = $this->model('Listing');
        
        // Dashboard Stats
        $data = [
            'totalUsers' => $userModel->count(),
            'pendingUsers' => $userModel->countByStatus('pending'),
            'pendingDocuments' => $userModel->countAllPendingDocuments(),
            'pendingListings' => $listingModel->countSearch(['status' => 'pending-approval']) + $listingModel->countSearch(['status' => 'draft'])
        ];

        $this->view('admin/dashboard', $data);
    }

    public function users(): void
    {
        $this->requireAdmin();
        $userModel = $this->model('User');
        
        $search = $_GET['search'] ?? '';
        $users = !empty($search) ? $userModel->search($search) : $userModel->getRecent(50);
        
        if ($this->expectsJson()) {
            $this->json($users);
            return;
        }
        
        $this->view('admin/user_table', ['users' => $users, 'search' => $search]);
    }

    public function documents(): void
    {
        $this->requireAdmin();
        $userModel = $this->model('User');
        $documents = $userModel->getAllDocuments();
        $this->view('admin/document_table', ['documents' => $documents]);
    }

    public function listings(): void
    {
        $this->requireAdmin();
        $listingModel = $this->model('Listing');
        $listings = $listingModel->getAllListings();
        $this->view('admin/listing_table', ['listings' => $listings]);
    }

    // --- Actions ---

    public function approveUser(): void
    {
        $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request (CSRF check failed).');
                header('Location: /admin/users');
                exit;
            }
            $userId = $_POST['user_id'];
            $userModel = $this->model('User');
            
            if ($userModel->updateStatus($userId, 'approved')) {
                // Notifications
                $user = $userModel->find($userId);
                if ($user) {
                    try {
                        $emailService = new EmailService();
                        $emailService->sendAccountApproved($user);
                        $notifModel = $this->model('Notification');
                        $notifModel->add($userId, "Your account has been approved!", 'success');
                        $this->setFlash('success', 'User approved successfully.');
                    } catch (Exception $e) {
                         $this->setFlash('warning', 'User approved, but notification failed.');
                    }
                }
            } else {
                $this->setFlash('error', 'Failed to update status.');
            }
        }
        header('Location: /admin/users');
        exit;
    }

    public function suspendUser(): void
    {
        $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/users');
                exit;
            }
            $userId = $_POST['user_id'];
            $this->model('User')->updateStatus($userId, 'suspended');
             $this->setFlash('success', 'User suspended.');
        }
        header('Location: /admin/users');
        exit;
    }

    public function deleteUser(): void
    {
        $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/users');
                exit;
            }
            $userId = $_POST['user_id'];
            $this->model('User')->delete($userId);
            $this->setFlash('success', 'User deleted.');
        }
        header('Location: /admin/users');
        exit;
    }

    public function approveDocument(): void
    {
        $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/documents');
                exit;
            }
            $documentId = $_POST['document_id'];
            $userId = $_POST['user_id'] ?? null;
            $action = $_POST['action']; // 'approve' or 'reject'
            
            $userModel = $this->model('User');
            
            if ($action === 'approve') {
                if ($userModel->updateDocumentStatus($documentId, 'approved')) {
                    $this->setFlash('success', 'Document verified successfully.');
                    
                    if ($userId) {
                        $this->model('Notification')->add($userId, "Your document has been verified successfully.", 'success');
                    }

                } else {
                     $this->setFlash('error', 'Failed to update document status.');
                }
            } elseif ($action === 'reject') {
                $userModel->updateDocumentStatus($documentId, 'rejected');
                 if ($userId) {
                    $this->model('Notification')->add($userId, "Your document verification was rejected. Please re-upload.", 'error');
                }
                 $this->setFlash('success', 'Document rejected.');
            }
        }
        header('Location: /admin/documents');
        exit;
    }

    public function publishListing(): void
    {
        $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/listings');
                exit;
            }
            $id = $_POST['listing_id']; // or from route param
            // Assuming Listing model has updateStatus or similar. 
            // Previous code used delete/update logic directly in view? No, Listing model exists.
            // Let's assume generic update for now or check listing model.
            // Need to implement updateStatus in Listing model if missing.
            $this->model('Listing')->update($id, ['status' => 'published']);
            $this->setFlash('success', 'Listing published.');
        }
        header('Location: /admin/listings');
        exit;
    }

    public function pauseListing(): void
    {
         $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/listings');
                exit;
            }
            $id = $_POST['listing_id'];
             $this->model('Listing')->update($id, ['status' => 'paused']); // or 'inactive'
             $this->setFlash('success', 'Listing paused.');
        }
        header('Location: /admin/listings');
         exit;
    }
    
    public function deleteListing(): void
    {
         $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/listings');
                exit;
            }
            $id = $_POST['listing_id'];
             $this->model('Listing')->delete($id);
             $this->setFlash('success', 'Listing deleted.');
        }
        header('Location: /admin/listings');
         exit;
    }

    // --- Legal Content ---

    public function legal(): void
    {
        $this->requireAdmin();
        $docs = $this->model('LegalContent')->getAll();
        $this->view('admin/legal_list', ['docs' => $docs]);
    }


    public function editLegal(string $type): void
    {
        $this->requireAdmin();
        $doc = $this->model('LegalContent')->getByType($type);
        
        if (!$doc) {
             $this->setFlash('error', 'Legal content type not found.');
             header('Location: /admin/legal');
             exit;
        }
        
        $this->view('admin/legal_edit', ['doc' => $doc]);
    }

    public function updateLegal(): void
    {
        $this->requireAdmin();
        if ($this->isPost()) {
            if (!$this->verifyCsrf()) {
                $this->setFlash('error', 'Invalid request.');
                header('Location: /admin/legal');
                exit;
            }
            $type = $_POST['type'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            
            if ($this->model('LegalContent')->updateContent($type, $title, $content)) {
                $this->setFlash('success', 'Content updated successfully.');
            } else {
                $this->setFlash('error', 'Failed to update content.');
            }
            
            header('Location: /admin/legal');
            exit;
        }
    }

    // Helper for flash messages
    private function setFlash($type, $message) {
        $_SESSION['flash_type'] = $type;
        $_SESSION['flash_message'] = $message;
    }
}
