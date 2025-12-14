<?php
$pageTitle = 'NestChange - Chat';
$activeNav = 'chat';
$bodyClass = 'chat-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Chat'],
];

function chatFormatTime($datetime) {
    $timestamp = strtotime($datetime);
    $now = time();
    if (date('Y-m-d', $timestamp) === date('Y-m-d', $now)) {
        return date('g:i A', $timestamp);
    }
    if (date('Y-m-d', $timestamp) === date('Y-m-d', strtotime('-1 day'))) {
        return 'Yesterday';
    }
    if ($now - $timestamp < 7 * 24 * 60 * 60) {
        return date('D', $timestamp);
    }
    if (date('Y', $timestamp) === date('Y', $now)) {
        return date('M j', $timestamp);
    }
    return date('M j, Y', $timestamp);
}

function chatGetInitials($firstName, $lastName) {
    $initials = '';
    if ($firstName) $initials .= strtoupper(substr($firstName, 0, 1));
    if ($lastName) $initials .= strtoupper(substr($lastName, 0, 1));
    return $initials ?: '?';
}

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
    <div class="chat-layout">
        <aside class="chat-sidebar">
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
                            $initials = chatGetInitials($chat['other_first_name'], $chat['other_last_name']);
                            $isActive = ($chat['chat_id'] === $selectedChatId);
                            $formattedTime = chatFormatTime($chat['last_message_at']);
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
                    $initials = chatGetInitials($selectedChat['other_first_name'], $selectedChat['other_last_name']);
                    
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
                                $messageTime = date('g:i A', strtotime($message['created_at']));
                            ?>
                            <div class="chat-message <?= $isOutgoing ? 'outgoing' : 'incoming' ?>">
                                <p><?= htmlspecialchars($message['content']) ?></p>
                                <span class="chat-message-time"><?= htmlspecialchars($messageTime) ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Action Card: Conditionally included based on application status -->
                <div id="chat-action-container">
                    <?php if ($actionCard): ?>
                        <?php include __DIR__ . '/partials/_action_card.php'; ?>
                    <?php endif; ?>
                </div>

                <div class="chat-composer">
                    <div class="chat-composer-actions">
                        <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                        <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
                    </div>
                    <input type="text" id="message-input" placeholder="Write a message..." class="chat-composer-input" autocomplete="off">
                    <button class="chat-send-btn" onclick="sendMessage()">Send</button>
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

                <div class="chat-composer">
                    <div class="chat-composer-actions">
                        <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                        <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
                    </div>
                    <input type="text" placeholder="Write a message..." class="chat-composer-input" disabled>
                    <button class="chat-send-btn" disabled>Send</button>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
const BASE_URL = '<?= BASE_URL ?>';
const currentProfileId = '<?= htmlspecialchars($currentProfileId ?? '') ?>';
let currentChatId = '<?= htmlspecialchars($selectedChatId ?? '') ?>';

function selectChat(chatId) {
    window.history.pushState({}, '', BASE_URL + '/chat?chat=' + chatId);
    
    document.querySelectorAll('.chat-thread').forEach(thread => {
        thread.classList.remove('active');
        if (thread.dataset.chatId === chatId) {
            thread.classList.add('active');
        }
    });
    
    fetch(BASE_URL + '/chat/details?chat_id=' + encodeURIComponent(chatId))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentChatId = chatId;
                renderChatPanel(data.chat, data.messages);
                scrollToBottom();
            }
        })
        .catch(error => console.error('Error loading chat:', error));
}

function buildActionCardHtml(chat, otherName) {
    if (!chat || !chat.application_id) {
        return '';
    }
    
    const applicationStatus = chat.application_status || null;
    const currentUserRole = chat.current_user_role || null;
    const applicationId = chat.application_id;
    
    // Host can accept/decline pending applications
    if (applicationStatus === 'pending' && currentUserRole === 'host') {
        return `
            <div class="chat-action-card" data-action-type="host_pending">
                <div class="chat-action-content">
                    <p class="chat-action-eyebrow">Action required</p>
                    <h4 class="chat-action-title">Respond to exchange request?</h4>
                    <p class="chat-action-text">
                        Review and respond to the exchange request from ${escapeHtml(otherName)}.
                    </p>
                </div>
                <div class="chat-action-buttons">
                    <button class="chat-action-btn primary" onclick="window.location.href='${BASE_URL}/applications/${escapeHtml(applicationId)}/accept'">
                        Accept
                    </button>
                    <button class="chat-action-btn ghost" onclick="window.location.href='${BASE_URL}/applications/${escapeHtml(applicationId)}/reject'">
                        Decline
                    </button>
                </div>
            </div>`;
    }
    
    return '';
}

function renderChatPanel(chat, messages) {
    const panel = document.getElementById('chat-panel');
    const otherName = ((chat.other_first_name || '') + ' ' + (chat.other_last_name || '')).trim() || 'Unknown User';
    const initials = getInitials(chat.other_first_name, chat.other_last_name);
    
    let dateRange = '';
    if (chat.start_date && chat.end_date) {
        dateRange = ` · ${formatShortDate(chat.start_date)} – ${formatShortDate(chat.end_date)}`;
    }
    
    const statusLabels = {
        'pending': 'Exchange request pending',
        'accepted': 'Host accepted the exchange',
        'rejected': 'Exchange request declined',
        'withdrawn': 'Application withdrawn',
        'cancelled': 'Exchange cancelled'
    };
    const statusLabel = statusLabels[chat.application_status] || 'No active request';
    
    let messagesHtml = '';
    if (messages.length === 0) {
        messagesHtml = `<div class="chat-message outgoing"><p>Start the conversation!</p><span class="chat-message-time">Now</span></div>`;
    } else {
        messages.forEach(msg => {
            const isOutgoing = msg.sender_profile_id === currentProfileId;
            messagesHtml += `
                <div class="chat-message ${isOutgoing ? 'outgoing' : 'incoming'}">
                    <p>${escapeHtml(msg.content)}</p>
                    <span class="chat-message-time">${formatTime(msg.created_at)}</span>
                </div>`;
        });
    }
    
    const actionCardHtml = buildActionCardHtml(chat, otherName);
    
    panel.innerHTML = `
        <header class="chat-panel-header">
            <div class="chat-panel-participant">
                <div class="chat-thread-avatar large">${escapeHtml(initials)}</div>
                <div>
                    <h3 class="chat-panel-name">${escapeHtml(otherName)}</h3>
                    <p class="chat-panel-meta">${escapeHtml(chat.listing_title || 'Exchange')}${escapeHtml(dateRange)}</p>
                </div>
            </div>
            <div class="chat-panel-actions">
                ${chat.listing_id 
                    ? `<button class="chat-panel-btn" onclick="window.location.href='${BASE_URL}/listings/${escapeHtml(chat.listing_id)}'">View listing</button>`
                    : `<button class="chat-panel-btn" disabled>View listing</button>`}
                ${chat.application_id 
                    ? `<button class="chat-panel-btn" onclick="window.location.href='${BASE_URL}/applications/${escapeHtml(chat.application_id)}'">View exchange details</button>`
                    : `<button class="chat-panel-btn" disabled>View exchange details</button>`}
            </div>
        </header>
        
        <div class="chat-status-pill">${escapeHtml(statusLabel)}</div>
        
        <div class="chat-messages" id="chat-messages">${messagesHtml}</div>
        
        <div id="chat-action-container">${actionCardHtml}</div>
        
        <div class="chat-composer">
            <div class="chat-composer-actions">
                <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
            </div>
            <input type="text" id="message-input" placeholder="Write a message..." class="chat-composer-input" autocomplete="off">
            <button class="chat-send-btn" onclick="sendMessage()">Send</button>
        </div>`;
}

function sendMessage() {
    const input = document.getElementById('message-input');
    const content = input.value.trim();
    
    if (!content || !currentChatId) return;
    
    const formData = new FormData();
    formData.append('chat_id', currentChatId);
    formData.append('content', content);
    
    fetch(BASE_URL + '/chat/send', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const container = document.getElementById('chat-messages');
                container.insertAdjacentHTML('beforeend', `
                    <div class="chat-message outgoing">
                        <p>${escapeHtml(data.message.content)}</p>
                        <span class="chat-message-time">${data.message.formatted_time}</span>
                    </div>`);
                input.value = '';
                scrollToBottom();
            }
        })
        .catch(error => console.error('Error sending message:', error));
}

let searchTimeout = null;
document.getElementById('chat-search-input')?.addEventListener('input', function(e) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        fetch(BASE_URL + '/chat/search?q=' + encodeURIComponent(e.target.value.trim()))
            .then(response => response.json())
            .then(data => {
                if (data.success) renderChatList(data.chats);
            });
    }, 300);
});

function renderChatList(chats) {
    const list = document.getElementById('chat-thread-list');
    if (chats.length === 0) {
        list.innerHTML = '<div class="chat-empty-state"><p>No conversations found.</p></div>';
        return;
    }
    
    list.innerHTML = chats.map(chat => {
        const isActive = chat.chat_id === currentChatId;
        const otherName = ((chat.other_first_name || '') + ' ' + (chat.other_last_name || '')).trim() || 'Unknown User';
        return `
            <div class="chat-thread ${isActive ? 'active' : ''}" data-chat-id="${escapeHtml(chat.chat_id)}" onclick="selectChat('${escapeHtml(chat.chat_id)}')">
                <div class="chat-thread-avatar">${escapeHtml(chat.initials)}</div>
                <div class="chat-thread-body">
                    <div class="chat-thread-row">
                        <p class="chat-thread-name">${escapeHtml(otherName)}</p>
                        <span class="chat-thread-time">${escapeHtml(chat.formatted_time)}</span>
                    </div>
                    <p class="chat-thread-subtitle">${escapeHtml(chat.listing_title || 'Exchange')}</p>
                </div>
            </div>`;
    }).join('');
}

setInterval(() => {
    if (!currentChatId) return;
    fetch(BASE_URL + '/chat/messages?chat_id=' + encodeURIComponent(currentChatId))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const current = document.querySelectorAll('.chat-message').length;
                if (data.messages.length > current) {
                    const container = document.getElementById('chat-messages');
                    container.innerHTML = data.messages.map(msg => `
                        <div class="chat-message ${msg.sender_profile_id === currentProfileId ? 'outgoing' : 'incoming'}">
                            <p>${escapeHtml(msg.content)}</p>
                            <span class="chat-message-time">${formatTime(msg.created_at)}</span>
                        </div>`).join('');
                    scrollToBottom();
                }
            }
        });
}, 5000);

function scrollToBottom() {
    const container = document.getElementById('chat-messages');
    if (container) container.scrollTop = container.scrollHeight;
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function getInitials(firstName, lastName) {
    let initials = '';
    if (firstName) initials += firstName.charAt(0).toUpperCase();
    if (lastName) initials += lastName.charAt(0).toUpperCase();
    return initials || '?';
}

function formatTime(datetime) {
    return new Date(datetime).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
}

function formatShortDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
}

document.addEventListener('DOMContentLoaded', scrollToBottom);

document.addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && e.target.id === 'message-input') {
        e.preventDefault();
        sendMessage();
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
