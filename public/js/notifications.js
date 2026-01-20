document.addEventListener('DOMContentLoaded', function () {
    const badge = document.getElementById('notification-badge');
    const bellIcon = document.getElementById('notification-bell-wrapper');
    const dropdown = document.getElementById('notification-dropdown');
    const dropdownList = document.getElementById('notification-dropdown-list');

    // Check if elements exist
    if (!badge || !bellIcon) return;

    // Use global base URL injected from layout
    const BASE_URL = (typeof APP_BASE_URL !== 'undefined') ? APP_BASE_URL : '/';

    // --- 3.4 Auto-Refresh Logic ---
    function updateNotificationCount() {
        fetch(BASE_URL + '/notifications/count')
            .then(response => {
                if (response.status === 401) return null;
                return response.json();
            })
            .then(data => {
                if (!data) return;
                const count = data.count;
                if (count > 0) {
                    badge.textContent = count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(err => console.error('Poll error:', err));
    }

    // Poll every 30 seconds
    setInterval(updateNotificationCount, 30000);

    // --- 3.3 Dropdown Logic ---
    bellIcon.addEventListener('click', function (e) {
        e.preventDefault();

        // Toggle dropdown
        const isActive = dropdown.classList.contains('active');

        if (isActive) {
            dropdown.classList.remove('active');
        } else {
            dropdown.classList.add('active');
            loadLatestNotifications();
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!bellIcon.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });

    function loadLatestNotifications() {
        dropdownList.innerHTML = '<div class="notification-empty">Loading...</div>';

        fetch(BASE_URL + '/notifications/latest')
            .then(res => res.json())
            .then(data => {
                if (data.notifications && data.notifications.length > 0) {
                    renderDropdownList(data.notifications);
                } else {
                    dropdownList.innerHTML = '<div class="notification-empty">No notifications</div>';
                }
            })
            .catch(err => {
                dropdownList.innerHTML = '<div class="notification-empty">Error loading</div>';
            });
    }

    function renderDropdownList(notifications) {
        let html = '';
        notifications.forEach(n => {
            const isUnread = (!n.read || n.read === '0' || n.read === false);
            const unreadClass = isUnread ? 'unread' : '';
            // Basic formatting for date
            const date = new Date(n.created_at).toLocaleString();

            html += `
                <div class="notification-dropdown-item ${unreadClass}" data-id="${n.id}">
                    <div class="notification-message">${escapeHtml(n.message)}</div>
                    <div class="notification-time">${date}</div>
                </div>
            `;
        });
        dropdownList.innerHTML = html;

        // Add click handlers for items
        document.querySelectorAll('.notification-dropdown-item').forEach(item => {
            item.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                markAsRead(id, this);
            });
        });
    }

    function markAsRead(id, element) {
        fetch(BASE_URL + '/notifications/' + id + '/read', {
            method: 'POST'
        }).then(res => res.json())
            .then(data => {
                if (data.success) {
                    element.classList.remove('unread');
                    element.style.opacity = '0.7';
                    // Update badge immediately
                    updateNotificationCount();
                }
            });
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
});
