/**
 * Favorites functionality for NestChange
 * Handles AJAX toggling of favorites without page reload
 */

// Get BASE_URL from config if available
let BASE_URL = '';
const configScript = document.getElementById('favorites-config');
if (configScript) {
    try {
        const config = JSON.parse(configScript.textContent);
        BASE_URL = config.baseUrl || '';
    } catch (e) {
        console.warn('Could not parse favorites config');
    }
}

// Fallback: detect base URL from current location
if (!BASE_URL) {
    const path = window.location.pathname;
    const pathParts = path.split('/').filter(p => p);
    if (pathParts.length > 0 && pathParts[0] !== 'favorites') {
        BASE_URL = window.location.origin + '/' + pathParts[0];
    } else {
        BASE_URL = window.location.origin;
    }
}

/**
 * Toggle favorite status for a listing
 * @param {HTMLElement} button - The heart button element
 * @param {string} listingId - The listing ID
 */
function toggleFavorite(button, listingId) {
    // Prevent double-clicks
    if (button.disabled) return;
    button.disabled = true;

    const isFavorited = button.classList.contains('favorited');
    const endpoint = isFavorited
        ? `${BASE_URL}/listings/${listingId}/unfavorite`
        : `${BASE_URL}/listings/${listingId}/favorite`;

    fetch(endpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
        .then(response => {
            if (response.status === 401) {
                // User not logged in
                return response.json().then(data => {
                    if (data.login_required) {
                        window.location.href = BASE_URL + '/auth/signin';
                    }
                    throw new Error(data.error || 'Please log in to save favorites.');
                });
            }
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update button state
                if (data.favorited) {
                    button.classList.add('favorited');
                    button.innerHTML = '❤️';
                    button.setAttribute('title', 'Remove from favorites');
                } else {
                    button.classList.remove('favorited');
                    button.innerHTML = '♡';
                    button.setAttribute('title', 'Add to favorites');

                    // If we're on the favorites page, remove the card
                    const card = button.closest('.favorite-card');
                    if (card) {
                        card.style.transition = 'opacity 0.3s, transform 0.3s';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            card.remove();
                            // Check if grid is now empty
                            const grid = document.querySelector('.favorites-grid');
                            if (grid && grid.children.length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                }

                // Optional: Show toast notification
                showToast(data.message);
            }
        })
        .catch(error => {
            console.error('Error toggling favorite:', error);
            showToast(error.message || 'Something went wrong. Please try again.', 'error');
        })
        .finally(() => {
            button.disabled = false;
        });
}

/**
 * Show a toast notification
 * @param {string} message - Message to display
 * @param {string} type - 'success' or 'error'
 */
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.style.cssText = `
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        background: ${type === 'error' ? '#d9534f' : '#222'};
        color: #fff;
        padding: 14px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        z-index: 10000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideUp 0.3s ease;
    `;
    toast.textContent = message;

    // Add animation keyframes if not already added
    if (!document.querySelector('#toast-styles')) {
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = `
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(toast);

    // Auto-remove after 3 seconds
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
