/**
 * Notifications functionality for NestChange
 */
document.addEventListener('DOMContentLoaded', function() {
    const bellBtn = document.getElementById('notification-bell');
    const dropdownMenu = document.getElementById('notification-dropdown-menu');
    const badge = document.querySelector('.notification-count');
    const listContainer = document.getElementById('notifications-list');

    if (!bellBtn) return;

    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Toggle dropdown
    bellBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = dropdownMenu.classList.contains('show');
        
        // Close other dropdowns if any (not implemented here but good practice)
        
        if (!isOpen) {
            loadNotifications();
            dropdownMenu.classList.add('show');
        } else {
            dropdownMenu.classList.remove('show');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        if (dropdownMenu) dropdownMenu.classList.remove('show');
    });

    dropdownMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    /**
     * Load recent notifications from API
     */
    function loadNotifications() {
        listContainer.innerHTML = '<div class="dropdown-item text-center text-muted">Loading...</div>';

        fetch('/api/notifications')
            .then(response => response.json())
            .then(data => {
                if (data.notifications && data.notifications.length > 0) {
                    renderNotifications(data.notifications);
                } else {
                    listContainer.innerHTML = '<div class="dropdown-item text-center text-muted">No notifications</div>';
                }
            })
            .catch(err => {
                console.error('Error loading notifications:', err);
                listContainer.innerHTML = '<div class="dropdown-item text-center text-danger">Error loading notifications</div>';
            });
    }

    /**
     * Render notifications list
     */
    function renderNotifications(notifications) {
        listContainer.innerHTML = '';
        notifications.forEach(n => {
            const item = document.createElement('div');
            item.className = `notification-item ${n.is_read == 0 ? 'unread' : ''}`;
            item.dataset.id = n.id;
            
            const timeStr = formatTime(new Date(n.created_at));
            
            item.innerHTML = `
                <div class="notification-content">
                    <p class="notification-message">${n.message}</p>
                    <span class="notification-time">${timeStr}</span>
                </div>
            `;

            item.addEventListener('click', function() {
                if (n.is_read == 0) {
                    markAsRead(n.id, item);
                }
                if (n.link) {
                    window.location.href = n.link;
                }
            });

            listContainer.appendChild(item);
        });
    }

    /**
     * Mark a notification as read via API
     */
    function markAsRead(id, element) {
        fetch(`/api/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                element.classList.remove('unread');
                updateBadgeCount();
            }
        })
        .catch(err => console.error('Error marking as read:', err));
    }

    /**
     * Update badge count via API
     */
    function updateBadgeCount() {
        fetch('/api/notifications/count')
            .then(response => response.json())
            .then(data => {
                if (data.count !== undefined) {
                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                            badge.style.display = 'block';
                        } else {
                            // Create badge if it doesn't exist
                            const newBadge = document.createElement('span');
                            newBadge.className = 'notification-count';
                            newBadge.textContent = data.count;
                            bellBtn.appendChild(newBadge);
                        }
                    } else if (badge) {
                        badge.style.display = 'none';
                    }
                }
            })
            .catch(err => console.error('Error updating badge count:', err));
    }

    /**
     * Format time (Simple version)
     */
    function formatTime(date) {
        const now = new Date();
        const diff = Math.floor((now - date) / 1000); // seconds
        
        if (diff < 60) return 'Just now';
        if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
        if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
        return date.toLocaleDateString();
    }

    // Auto-refresh every 30 seconds
    setInterval(updateBadgeCount, 30000);
});
