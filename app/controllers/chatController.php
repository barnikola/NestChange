<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';

class ChatController extends Controller
{
    private Chat $chatModel;

    public function __construct()
    {
        parent::__construct();
        $this->chatModel = $this->model('Chat');
    }

    /**
     * Display chat interface
     */
    public function index(): void
    {
        AuthMiddleware::requireAuth();
        
        $user = $this->currentUser();
        $profileId = $this->getUserProfileId();
        
        if (!$profileId) {
            $this->flash('error', 'Please complete your profile first.');
            $this->redirect(BASE_URL . '/profile');
        }
        
        // Get all chats for the user
        $chats = $this->chatModel->getUserChats($user['id'], $profileId);
        
        // Get selected chat ID from query param
        $selectedChatId = $this->getInput('chat');
        
        // Default to first chat if none selected
        $selectedChat = null;
        $messages = [];
        
        if ($selectedChatId) {
            $selectedChat = $this->chatModel->getChatDetails($selectedChatId, $profileId);
            if ($selectedChat) {
                $messages = $this->chatModel->getMessages($selectedChatId);
            }
        } elseif (!empty($chats)) {
            $selectedChatId = $chats[0]['chat_id'];
            $selectedChat = $this->chatModel->getChatDetails($selectedChatId, $profileId);
            if ($selectedChat) {
                $messages = $this->chatModel->getMessages($selectedChatId);
            }
        }
        
        $this->data['chats'] = $chats;
        $this->data['selectedChat'] = $selectedChat;
        $this->data['selectedChatId'] = $selectedChatId;
        $this->data['messages'] = $messages;
        $this->data['currentProfileId'] = $profileId;
        $this->data['csrf_token'] = $this->getCsrfToken();
        
        $this->view('chat/index', $this->data);
    }

    /**
     * Send a message (AJAX)
     */
    public function sendMessage(): void
    {
        AuthMiddleware::requireAuth();
        
        if (!$this->isPost()) {
            $this->json(['success' => false, 'error' => 'Invalid request method.'], 400);
        }
        
        $user = $this->currentUser();
        $profileId = $this->getUserProfileId();
        
        $chatId = $this->postInput('chat_id');
        $content = $this->postInput('content');
        
        if (!$chatId || !$content) {
            $this->json(['success' => false, 'error' => 'Missing required fields.'], 400);
        }
        
        // Check access
        if (!$this->chatModel->userHasAccess($chatId, $profileId)) {
            $this->json(['success' => false, 'error' => 'Access denied.'], 403);
        }
        
        // Send message
        $messageId = $this->chatModel->sendMessage($chatId, $user['id'], $profileId, $content);
        
        // Get user name for response
        $db = Database::getInstance();
        $profile = $db->fetchOne("SELECT first_name, last_name FROM user_profile WHERE id = ?", [$profileId]);
        
        $this->json([
            'success' => true,
            'message' => [
                'id' => $messageId,
                'content' => $content,
                'sender_profile_id' => $profileId,
                'first_name' => $profile['first_name'] ?? '',
                'last_name' => $profile['last_name'] ?? '',
                'created_at' => date('Y-m-d H:i:s'),
                'formatted_time' => date('g:i A')
            ]
        ]);
    }

    /**
     * Get messages for a chat (AJAX - for real-time updates)
     */
    public function getMessages(): void
    {
        AuthMiddleware::requireAuth();
        
        $profileId = $this->getUserProfileId();
        $chatId = $this->getInput('chat_id');
        
        if (!$chatId) {
            $this->json(['success' => false, 'error' => 'Missing chat ID.'], 400);
        }
        
        if (!$this->chatModel->userHasAccess($chatId, $profileId)) {
            $this->json(['success' => false, 'error' => 'Access denied.'], 403);
        }
        
        $messages = $this->chatModel->getMessages($chatId);
        
        $this->json([
            'success' => true,
            'messages' => $messages,
            'currentProfileId' => $profileId
        ]);
    }

    /**
     * Search chats (AJAX)
     */
    public function search(): void
    {
        AuthMiddleware::requireAuth();
        
        $profileId = $this->getUserProfileId();
        $query = $this->getInput('q', '');
        
        if (strlen($query) < 2) {
            $user = $this->currentUser();
            $chats = $this->chatModel->getUserChats($user['id'], $profileId);
        } else {
            $chats = $this->chatModel->searchChats($profileId, $query);
        }
        
        $formattedChats = array_map(function($chat) {
            return [
                'chat_id' => $chat['chat_id'],
                'other_first_name' => $chat['other_first_name'],
                'other_last_name' => $chat['other_last_name'],
                'other_profile_id' => $chat['other_profile_id'],
                'listing_title' => $chat['listing_title'],
                'listing_city' => $chat['listing_city'] ?? '',
                'last_message' => $chat['last_message'],
                'last_message_at' => $chat['last_message_at'],
                'formatted_time' => Chat::formatTime($chat['last_message_at']),
                'initials' => Chat::getInitials($chat['other_first_name'], $chat['other_last_name'])
            ];
        }, $chats);
        
        $this->json([
            'success' => true,
            'chats' => $formattedChats
        ]);
    }

    /**
     * Get chat details (AJAX)
     */
    public function getChatDetails(): void
    {
        AuthMiddleware::requireAuth();
        
        $profileId = $this->getUserProfileId();
        $chatId = $this->getInput('chat_id');
        
        if (!$chatId) {
            $this->json(['success' => false, 'error' => 'Missing chat ID.'], 400);
        }
        
        $chat = $this->chatModel->getChatDetails($chatId, $profileId);
        
        if (!$chat) {
            $this->json(['success' => false, 'error' => 'Chat not found.'], 404);
        }
        
        $messages = $this->chatModel->getMessages($chatId);
        
        $this->json([
            'success' => true,
            'chat' => $chat,
            'messages' => $messages,
            'currentProfileId' => $profileId
        ]);
    }

    public function startChat(string $profileId): void
    {
        AuthMiddleware::requireAuth();
        
        $user = $this->currentUser();
        $currentProfileId = $this->getUserProfileId();
        
        if (!$currentProfileId) {
            $this->flash('error', 'Please complete your profile first.');
            $this->redirect(BASE_URL . '/profile');
        }
        
        // Prevent chatting with yourself
        if ($currentProfileId === $profileId) {
            $this->flash('error', 'You cannot start a chat with yourself.');
            $this->redirect(BASE_URL . '/chat');
        }
        
        // Get listing ID from query if provided (for context)
        $listingId = $this->getInput('listing_id');
        
        // Find or create a chat
        $chatId = $this->chatModel->findOrCreateDirectChat($currentProfileId, $profileId, $listingId);
        
        if (!$chatId) {
            $this->flash('error', 'Unable to start chat. Please try again.');
            $this->redirect(BASE_URL . '/chat');
        }
        
        // Redirect to chat with the chat ID
        $this->redirect(BASE_URL . '/chat?chat=' . urlencode($chatId));
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
