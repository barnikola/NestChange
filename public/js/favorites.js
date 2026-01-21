/**
 * Favorites functionality for NestChange
 * Handles localStorage-based favorites with batch syncing to database
 * Only tracks pending operations - derives current state from server + pending changes
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
    BASE_URL = window.location.origin;
}

// Storage keys - only track pending operations
const STORAGE_KEY_PENDING_ADD = 'nestchange_pending_add';
const STORAGE_KEY_PENDING_REMOVE = 'nestchange_pending_remove';

/**
 * Get server favorites state from page elements
 * Reads initial state from buttons that have the 'favorited' class
 * @returns {Set<string>} Set of favorited listing IDs from server
 */
function getServerFavoritesState() {
    const serverFavorites = new Set();
    const buttons = document.querySelectorAll('.btn-favorite[data-listing-id]');
    
    buttons.forEach(button => {
        const listingId = button.getAttribute('data-listing-id');
        if (listingId && button.classList.contains('favorited')) {
            serverFavorites.add(listingId);
        }
    });
    
    return serverFavorites;
}

/**
 * Get current favorites state (server state + pending additions - pending removals)
 * @returns {Set<string>} Set of current favorite listing IDs
 */
function getCurrentFavoritesState() {
    const serverState = getServerFavoritesState();
    const pendingAdd = getPendingAdditions();
    const pendingRemove = getPendingRemovals();
    
    const currentState = new Set(serverState);
    pendingAdd.forEach(id => currentState.add(id));
    pendingRemove.forEach(id => currentState.delete(id));
    
    return currentState;
}

/**
 * Get pending additions from localStorage
 * @returns {Set<string>} Set of listing IDs to add
 */
function getPendingAdditions() {
    try {
        const stored = localStorage.getItem(STORAGE_KEY_PENDING_ADD);
        if (stored) {
            const ids = JSON.parse(stored);
            return new Set(Array.isArray(ids) ? ids : []);
        }
    } catch (e) {
        console.warn('Error reading pending additions:', e);
    }
    return new Set();
}

/**
 * Get pending removals from localStorage
 * @returns {Set<string>} Set of listing IDs to remove
 */
function getPendingRemovals() {
    try {
        const stored = localStorage.getItem(STORAGE_KEY_PENDING_REMOVE);
        if (stored) {
            const ids = JSON.parse(stored);
            return new Set(Array.isArray(ids) ? ids : []);
        }
    } catch (e) {
        console.warn('Error reading pending removals:', e);
    }
    return new Set();
}

/**
 * Save pending additions to localStorage
 * @param {Set<string>} pending Set of listing IDs to add
 */
function savePendingAdditions(pending) {
    try {
        if (pending.size > 0) {
            localStorage.setItem(STORAGE_KEY_PENDING_ADD, JSON.stringify(Array.from(pending)));
        } else {
            localStorage.removeItem(STORAGE_KEY_PENDING_ADD);
        }
    } catch (e) {
        console.warn('Error saving pending additions:', e);
    }
}

/**
 * Save pending removals to localStorage
 * @param {Set<string>} pending Set of listing IDs to remove
 */
function savePendingRemovals(pending) {
    try {
        if (pending.size > 0) {
            localStorage.setItem(STORAGE_KEY_PENDING_REMOVE, JSON.stringify(Array.from(pending)));
        } else {
            localStorage.removeItem(STORAGE_KEY_PENDING_REMOVE);
        }
    } catch (e) {
        console.warn('Error saving pending removals:', e);
    }
}

/**
 * Clear pending operations from localStorage
 */
function clearPendingOperations() {
    try {
        localStorage.removeItem(STORAGE_KEY_PENDING_ADD);
        localStorage.removeItem(STORAGE_KEY_PENDING_REMOVE);
    } catch (e) {
        console.warn('Error clearing pending operations:', e);
    }
}

/**
 * Sync pending favorites with the server
 * @returns {Promise<boolean>} True if sync was successful
 */
async function syncFavoritesWithServer() {
    const pendingAdd = getPendingAdditions();
    const pendingRemove = getPendingRemovals();

    if (pendingAdd.size === 0 && pendingRemove.size === 0) {
        return true;
    }

    try {
        const response = await fetch(`${BASE_URL}/favorites/batch`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                add: Array.from(pendingAdd),
                remove: Array.from(pendingRemove)
            })
        });

        if (response.status === 401) {
            clearPendingOperations();
            return false;
        }

        if (!response.ok) {
            throw new Error('Failed to sync favorites');
        }

        const data = await response.json();
        
        if (data.success) {
            clearPendingOperations();
            
            if (data.errors && data.errors.length > 0) {
                console.warn('Some favorites failed to sync:', data.errors);
            }
            
            return true;
        } else {
            throw new Error(data.error || 'Failed to sync favorites');
        }
    } catch (error) {
        console.error('Error syncing favorites:', error);
        return false;
    }
}

/**
 * Update button UI state
 * @param {HTMLElement} button - The heart button element
 * @param {boolean} isFavorited - Whether the listing is favorited
 */
function updateButtonState(button, isFavorited) {
    if (isFavorited) {
        button.classList.add('favorited');
        button.innerHTML = '❤️';
        button.setAttribute('title', 'Remove from favorites');
    } else {
        button.classList.remove('favorited');
        button.innerHTML = '♡';
        button.setAttribute('title', 'Add to favorites');
    }
}

/**
 * Update all favorite buttons on the page based on current favorites state
 */
function updateAllFavoriteButtons() {
    const currentFavorites = getCurrentFavoritesState();
    const buttons = document.querySelectorAll('.btn-favorite[data-listing-id]');
    
    buttons.forEach(button => {
        const listingId = button.getAttribute('data-listing-id');
        if (listingId) {
            updateButtonState(button, currentFavorites.has(listingId));
        }
    });
    
    updateFavoritesCount();
}

/**
 * Update the favorites count display on the favorites page
 */
function updateFavoritesCount() {
    const countElement = document.getElementById('favorites-count');
    if (!countElement) return;
    
    const currentFavorites = getCurrentFavoritesState();
    const count = currentFavorites.size;
    const grid = document.getElementById('favorites-grid');
    const emptyState = document.getElementById('empty-favorites');
    
    if (count === 0) {
        countElement.textContent = 'Save listings you love to find them easily later';
        if (grid) grid.style.display = 'none';
        if (emptyState) emptyState.style.display = 'block';
    } else {
        const plural = count !== 1 ? 's' : '';
        countElement.textContent = `You have ${count} saved listing${plural}`;
        if (grid) grid.style.display = 'grid';
        if (emptyState) emptyState.style.display = 'none';
    }
}

/**
 * Toggle favorite status for a listing
 * @param {HTMLElement} button - The heart button element
 * @param {string} listingId - The listing ID
 */
function toggleFavorite(button, listingId) {
    if (button.disabled) return;
    button.disabled = true;

    const currentFavorites = getCurrentFavoritesState();
    const pendingAdd = getPendingAdditions();
    const pendingRemove = getPendingRemovals();
    
    const isCurrentlyFavorited = currentFavorites.has(listingId);
    
    if (isCurrentlyFavorited) {
        // Remove from favorites
        if (pendingAdd.has(listingId)) {
            pendingAdd.delete(listingId);
            savePendingAdditions(pendingAdd);
        } else {
            pendingRemove.add(listingId);
            savePendingRemovals(pendingRemove);
        }
        
        updateButtonState(button, false);
        
        // If on favorites page, animate card removal
        const card = button.closest('.favorite-card');
        if (card) {
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            setTimeout(() => {
                card.remove();
                updateFavoritesCount();
            }, 300);
        } else {
            updateFavoritesCount();
        }
        
        showToast('Removed from favorites');
    } else {
        // Add to favorites
        if (pendingRemove.has(listingId)) {
            pendingRemove.delete(listingId);
            savePendingRemovals(pendingRemove);
        } else {
            pendingAdd.add(listingId);
            savePendingAdditions(pendingAdd);
        }
        
        updateButtonState(button, true);
        updateFavoritesCount();
        showToast('Added to favorites');
    }
    
    button.disabled = false;
}

/**
 * Show a toast notification
 * @param {string} message - Message to display
 * @param {string} type - 'success' or 'error'
 */
function showToast(message, type = 'success') {
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

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Track current URL for change detection
let currentUrl = window.location.href;

/**
 * Handle URL changes - sync favorites when navigating
 */
function handleUrlChange() {
    const newUrl = window.location.href;
    if (newUrl !== currentUrl) {
        currentUrl = newUrl;
        syncFavoritesWithServer().catch(err => {
            console.error('Failed to sync favorites on URL change:', err);
        });
    }
}

// Sync favorites when page unloads
window.addEventListener('beforeunload', () => {
    const pendingAdd = getPendingAdditions();
    const pendingRemove = getPendingRemovals();
    
    if (pendingAdd.size > 0 || pendingRemove.size > 0) {
        const data = JSON.stringify({
            add: Array.from(pendingAdd),
            remove: Array.from(pendingRemove)
        });
        
        if (navigator.sendBeacon) {
            const blob = new Blob([data], { type: 'application/json' });
            navigator.sendBeacon(`${BASE_URL}/favorites/batch`, blob);
        } else {
            fetch(`${BASE_URL}/favorites/batch`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: data,
                keepalive: true
            }).catch(() => {
                // Ignore errors during unload
            });
        }
    }
});

// Monitor URL changes
window.addEventListener('popstate', handleUrlChange);

const originalPushState = history.pushState;
const originalReplaceState = history.replaceState;

history.pushState = function(...args) {
    originalPushState.apply(history, args);
    setTimeout(handleUrlChange, 0);
};

history.replaceState = function(...args) {
    originalReplaceState.apply(history, args);
    setTimeout(handleUrlChange, 0);
};

// Initialize favorites when DOM is ready
function initializeFavorites() {
    syncFavoritesWithServer().catch(() => {
        // User might not be logged in, that's okay
    });
    updateAllFavoriteButtons();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeFavorites);
} else {
    initializeFavorites();
}
