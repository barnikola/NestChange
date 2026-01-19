/**
 * Chat JavaScript
 * Handles chat functionality, message sending, and real-time updates
 */

(function () {
    'use strict';

    // Get configuration from data attribute or global variable
    const configScript = document.getElementById('chat-config');
    if (!configScript) {
        console.error('Chat config not found');
        return;
    }

    const config = JSON.parse(configScript.textContent);
    const BASE_URL = config.baseUrl;
    let currentProfileId = config.currentProfileId || '';
    let currentChatId = config.currentChatId || '';
    const csrfToken = config.csrfToken || '';
    const isMobileViewport = () => window.matchMedia ? window.matchMedia('(max-width: 1024px)').matches : window.innerWidth <= 1024;
    let closeMobileSidebar = () => { };

    window.selectChat = function (chatId) {
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
                    if (isMobileViewport()) {
                        closeMobileSidebar();
                    }
                }
            })
            .catch(error => console.error('Error loading chat:', error));
    };

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
        if (!panel) return;

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
            
            <div class="chat-transcript">
                <div class="chat-messages" id="chat-messages">${messagesHtml}</div>
            </div>
            
            <div id="chat-action-container">${actionCardHtml}</div>
            <div id="chat-action-anchor"></div>
            
            <div class="chat-composer">
                <div class="chat-composer-actions">
                    <button class="chat-icon-btn" aria-label="Add attachment">📎</button>
                    <button class="chat-icon-btn" aria-label="Insert media">🖼️</button>
                </div>
                <input type="text" id="message-input" placeholder="Write a message..." class="chat-composer-input" autocomplete="off">
                <button class="chat-send-btn" onclick="sendMessage()">Send</button>
            </div>`;

        updateActionPlacement();
    }

    window.sendMessage = function () {
        const input = document.getElementById('message-input');
        if (!input) return;

        const content = input.value.trim();

        if (!content || !currentChatId) return;

        const formData = new FormData();
        formData.append('chat_id', currentChatId);
        formData.append('content', content);
        if (csrfToken) {
            formData.append('csrf_token', csrfToken);
        }

        fetch(BASE_URL + '/chat/send', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById('chat-messages');
                    if (container) {
                        container.insertAdjacentHTML('beforeend', `
                            <div class="chat-message outgoing">
                                <p>${escapeHtml(data.message.content)}</p>
                                <span class="chat-message-time">${data.message.formatted_time}</span>
                            </div>`);
                    }
                    input.value = '';
                    scrollToBottom();
                }
            })
            .catch(error => console.error('Error sending message:', error));
    };

    let searchTimeout = null;
    const searchInput = document.getElementById('chat-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                fetch(BASE_URL + '/chat/search?q=' + encodeURIComponent(e.target.value.trim()))
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) renderChatList(data.chats);
                    });
            }, 300);
        });
    }

    function renderChatList(chats) {
        const list = document.getElementById('chat-thread-list');
        if (!list) return;

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
                        if (container) {
                            container.innerHTML = data.messages.map(msg => `
                                <div class="chat-message ${msg.sender_profile_id === currentProfileId ? 'outgoing' : 'incoming'}">
                                    <p>${escapeHtml(msg.content)}</p>
                                    <span class="chat-message-time">${formatTime(msg.created_at)}</span>
                                </div>`).join('');
                            scrollToBottom();
                        }
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
        return new Date(datetime).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
    }

    function formatShortDate(dateStr) {
        return new Date(dateStr).toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
    }

    function updateActionPlacement() {
        const transcript = document.querySelector('.chat-transcript');
        const actionContainer = document.getElementById('chat-action-container');
        let anchor = document.getElementById('chat-action-anchor');

        if (!transcript || !actionContainer) {
            return;
        }

        if (!anchor) {
            anchor = document.createElement('div');
            anchor.id = 'chat-action-anchor';
            actionContainer.insertAdjacentElement('afterend', anchor);
        }

        const shouldEmbed = window.matchMedia('(max-width: 768px)').matches;

        if (shouldEmbed && !transcript.contains(actionContainer)) {
            transcript.appendChild(actionContainer);
        } else if (!shouldEmbed && transcript.contains(actionContainer) && anchor.parentNode) {
            anchor.parentNode.insertBefore(actionContainer, anchor);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        scrollToBottom();
        updateActionPlacement();

        const sidebar = document.querySelector('[data-chat-sidebar]');
        const overlay = document.querySelector('[data-chat-overlay]');
        const toggleBtn = document.querySelector('[data-chat-toggle]');
        const closeBtn = document.querySelector('[data-chat-close]');

        const setOverlayState = (isVisible) => {
            if (!overlay) return;
            overlay.classList.toggle('is-visible', isVisible);
            overlay.setAttribute('aria-hidden', isVisible ? 'false' : 'true');
        };

        const openSidebar = () => {
            if (!sidebar) return;
            sidebar.classList.add('is-open');
            document.body.classList.add('chat-drawer-open');
            setOverlayState(true);
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'true');
            }
        };

        const closeSidebar = () => {
            if (!sidebar) return;
            sidebar.classList.remove('is-open');
            document.body.classList.remove('chat-drawer-open');
            setOverlayState(false);
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'false');
            }
        };

        closeMobileSidebar = closeSidebar;

        toggleBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        window.addEventListener('resize', () => {
            if (!isMobileViewport()) {
                closeSidebar();
            }
            updateActionPlacement();
        });

        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && sidebar?.classList.contains('is-open')) {
                closeSidebar();
            }
        });
    });

    document.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && e.target.id === 'message-input') {
            e.preventDefault();
            sendMessage();
        }
    });
})();
