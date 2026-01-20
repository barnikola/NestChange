<?php
require_once dirname(__DIR__, 2) . '/models/chat.php';

$pageTitle = 'NestChange - Chat';
$activeNav = 'chat';
$bodyClass = 'chat-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Chat'],
];

function buildActionCard($selectedChat, $otherName) {
    if (!$selectedChat || empty($selectedChat['application_id'])) {
        return null;
    }
    
    $applicationStatus = $selectedChat['application_status'] ?? null;
    $currentUserRole = $selectedChat['current_user_role'] ?? null;
    $applicationId = $selectedChat['application_id'];
    
    if ($applicationStatus === 'pending' && $currentUserRole === 'host') {
        return [
            'type' => 'host_pending',
            'eyebrow' => 'Action required',
            'title' => 'Respond to exchange request?',
            'text' => "Review and respond to the exchange request from {$otherName}.",
            'other_name' => $otherName,
            'application_id' => $applicationId,
            'primary_action' => [
                'label' => 'Accept',
                'url' => BASE_URL . '/applications/' . $applicationId . '/accept',
                'action' => ''
            ],
            'secondary_action' => [
                'label' => 'Decline',
                'url' => BASE_URL . '/applications/' . $applicationId . '/reject',
                'action' => ''
            ]
        ];
    }
    
    return null;
}

ob_start();
?>
<main class="chat-content-wrapper">
    <div class="chat-mobile-bar">
        <button type="button" class="chat-mobile-toggle" data-chat-toggle aria-expanded="false">
            Conversations
        </button>
    </div>
    <div class="chat-layout">
        <aside class="chat-sidebar" data-chat-sidebar>
            <button type="button" class="chat-sidebar-close" data-chat-close aria-label="Close conversations">×</button>
            <div class="chat-sidebar-header">
                <div>
                    <p class="chat-sidebar-eyebrow">Chats</p>
                    <h2 class="chat-sidebar-title">Stay on top of every exchange.</h2>
                </div>
            </div>

            <label class="chat-search">
                <span class="chat-search-icon">🔍</span>
                <input type="text" id="chat-search-input" placeholder="Search by user or listing" autocomplete="off">
            </label>

            <div class="chat-thread-list" id="chat-thread-list">
                <?php if (empty($chats)): ?>
                    <div class="chat-empty-state">
                        <p>No conversations yet.</p>
                        <p class="chat-empty-hint">Start by applying to a listing or receiving applications on your listings.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($chats as $chat): ?>
                        <?php 
                            $initials = Chat::getInitials($chat['other_first_name'] ?? null, $chat['other_last_name'] ?? null);
                            $isActive = ($chat['chat_id'] === $selectedChatId);
                            $formattedTime = Chat::formatTime($chat['last_message_at'] ?? null);
                            $otherName = trim(($chat['other_first_name'] ?? '') . ' ' . ($chat['other_last_name'] ?? ''));
                            if (empty($otherName)) $otherName = 'Unknown User';
                        ?>
                        <div class="chat-thread <?= $isActive ? 'active' : '' ?>" 
                             data-chat-id="<?= htmlspecialchars($chat['chat_id']) ?>"
                             onclick="selectChat('<?= htmlspecialchars($chat['chat_id']) ?>')">
                            <div class="chat-thread-avatar"><?= htmlspecialchars($initials) ?></div>
                            <div class="chat-thread-body">
                                <div class="chat-thread-row">
                                    <p class="chat-thread-name"><?= htmlspecialchars($otherName) ?></p>
                                    <span class="chat-thread-time"><?= htmlspecialchars($formattedTime) ?></span>
                                </div>
                                <p class="chat-thread-subtitle"><?= htmlspecialchars($chat['listing_title'] ?? 'Exchange') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </aside>

        <section class="chat-panel" id="chat-panel">
            <?php if ($selectedChat): ?>
                <?php 
                    $otherName = trim(($selectedChat['other_first_name'] ?? '') . ' ' . ($selectedChat['other_last_name'] ?? ''));
                    if (empty($otherName)) $otherName = 'Unknown User';
                    $initials = Chat::getInitials($selectedChat['other_first_name'] ?? null, $selectedChat['other_last_name'] ?? null);
                    
                    $dateRange = '';
                    if (!empty($selectedChat['start_date']) && !empty($selectedChat['end_date'])) {
                        $startDate = date('j M', strtotime($selectedChat['start_date']));
                        $endDate = date('j M Y', strtotime($selectedChat['end_date']));
                        $dateRange = " · {$startDate} – {$endDate}";
                    }
                    
                    // Build action card configuration
                    $actionCard = buildActionCard($selectedChat, $otherName);
                ?>
                <header class="chat-panel-header">
                    <div class="chat-panel-participant">
                        <div class="chat-thread-avatar large"><?= htmlspecialchars($initials) ?></div>
                        <div>
                            <h3 class="chat-panel-name"><?= htmlspecialchars($otherName) ?></h3>
                            <p class="chat-panel-meta"><?= htmlspecialchars($selectedChat['listing_title'] ?? 'Exchange') ?><?= htmlspecialchars($dateRange) ?></p>
                        </div>
                    </div>
                    <div class="chat-panel-actions">
                        <?php if (!empty($selectedChat['listing_id'])): ?>
                            <button class="chat-panel-btn" onclick="window.location.href='<?= BASE_URL ?>/listings/<?= htmlspecialchars($selectedChat['listing_id']) ?>'">View listing</button>
                        <?php else: ?>
                            <button class="chat-panel-btn">View listing</button>
                        <?php endif; ?>
                        <?php if (!empty($selectedChat['application_id'])): ?>
                            <button class="chat-panel-btn" onclick="window.location.href='<?= BASE_URL ?>/applications/<?= htmlspecialchars($selectedChat['application_id']) ?>'">View exchange details</button>
                        <?php else: ?>
                            <button class="chat-panel-btn">View exchange details</button>
                        <?php endif; ?>
                    </div>
                </header>

                <?php 
                    $statusLabels = [
                        'pending' => 'Exchange request pending',
                        'accepted' => 'Host accepted the exchange',
                        'rejected' => 'Exchange request declined',
                        'withdrawn' => 'Application withdrawn',
                        'cancelled' => 'Exchange cancelled'
                    ];
                    $statusLabel = $statusLabels[$selectedChat['application_status'] ?? ''] ?? 'No active request';
                ?>
                <div class="chat-status-pill"><?= htmlspecialchars($statusLabel) ?></div>

                <div class="chat-transcript">
                    <div class="chat-messages" id="chat-messages">
                        <?php if (empty($messages)): ?>
                            <div class="chat-message outgoing">
                                <p>Start the conversation!</p>
                                <span class="chat-message-time">Now</span>
                            </div>
                        <?php else: ?>
                            <?php foreach ($messages as $message): ?>
                                <?php 
                                    $isOutgoing = ($message['sender_profile_id'] === $currentProfileId);
                                    $messageTime = !empty($message['created_at']) ? date('H:i', strtotime($message['created_at'])) : '';
                                ?>
                                <div class="chat-message <?= $isOutgoing ? 'outgoing' : 'incoming' ?>">
                                    <p><?= htmlspecialchars($message['content']) ?></p>
                                    <span class="chat-message-time"><?= htmlspecialchars($messageTime) ?></span>
                                    <?php if (Session::isLoggedIn()): ?>
                                        <button onclick="openReportModal('message', '<?= htmlspecialchars($message['id']) ?>')" class="btn-report" style="margin-left:8px;">Report</button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Card: Conditionally included based on application status -->
                <div id="chat-action-container">
                    <?php if ($actionCard): ?>
                        <?php include __DIR__ . '/partials/_action_card.php'; ?>
                    <?php endif; ?>
                </div>
                <div id="chat-action-anchor"></div>

                <div class="chat-composer">
                    <div class="chat-composer-actions">
                        <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                        <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
                    </div>
                    <input type="text" id="message-input" placeholder="Write a message..." class="chat-composer-input" autocomplete="off">
                    <button class="chat-send-btn" onclick="sendMessage()" aria-label="Send message">
                        &#10148;
                    </button>
                </div>
            <?php else: ?>
                <!-- Default view when no chats exist -->
                <header class="chat-panel-header">
                    <div class="chat-panel-participant">
                        <div class="chat-thread-avatar large">?</div>
                        <div>
                            <h3 class="chat-panel-name">No conversation selected</h3>
                            <p class="chat-panel-meta">Select a chat or apply to a listing to start</p>
                        </div>
                    </div>
                    <div class="chat-panel-actions">
                        <button class="chat-panel-btn">View listing</button>
                        <button class="chat-panel-btn">View exchange details</button>
                    </div>
                </header>

                <div class="chat-status-pill">No active exchange</div>

                <div class="chat-messages">
                    <div class="chat-message outgoing">
                        <p>Apply to a listing to start a conversation.</p>
                        <span class="chat-message-time">Now</span>
                    </div>
                </div>

                <!-- Get Started Action Card -->
                <div id="chat-action-container">
                    <?php 
                        $actionCard = [
                            'type' => 'get_started',
                            'eyebrow' => 'Get started',
                            'title' => 'Find your next exchange',
                            'text' => 'Browse listings and apply to start a conversation with hosts.',
                            'primary_action' => [
                                'label' => 'Browse listings',
                                'url' => BASE_URL . '/listings'
                            ],
                            'secondary_action' => [
                                'label' => 'My listings',
                                'url' => BASE_URL . '/my-listings'
                            ]
                        ];
                        include __DIR__ . '/partials/_action_card.php';
                    ?>
                </div>
                <div id="chat-action-anchor"></div>

                <div class="chat-composer">
                    <div class="chat-composer-actions">
                        <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                        <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
                    </div>
                    <input type="text" placeholder="Write a message..." class="chat-composer-input" disabled>
                    <button class="chat-send-btn" aria-label="Send message" disabled>
                        &#10148;
                    </button>
                </div>
            <?php endif; ?>
        </section>
    </div>
    <div class="chat-overlay" data-chat-overlay aria-hidden="true"></div>
</main>

<script id="chat-config" type="application/json">
<?php
echo json_encode([
    'baseUrl' => rtrim(BASE_URL, '/'),
    'currentProfileId' => $currentProfileId ?? '',
    'currentChatId' => $selectedChatId ?? '',
    'csrfToken' => Session::getCsrfToken()
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
?>
</script>
<script src="<?= rtrim(BASE_URL, '/') ?>/js/chat.js?v=<?= time() ?>"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
