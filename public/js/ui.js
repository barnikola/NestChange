/**
 * NestChange UI helpers
 * Loading states, form submission handling, and utility functions
 */

(function() {
    'use strict';

    // Create and inject loading bar
    function createLoadingBar() {
        const bar = document.createElement('div');
        bar.className = 'loading-bar';
        bar.setAttribute('role', 'progressbar');
        bar.setAttribute('aria-label', 'Loading');
        document.body.appendChild(bar);
        return bar;
    }

    const loadingBar = createLoadingBar();

    // Show loading bar
    function showLoading() {
        loadingBar.classList.add('is-loading');
    }

    // Hide loading bar
    function hideLoading() {
        loadingBar.classList.remove('is-loading');
        setTimeout(() => {
            loadingBar.style.transform = '';
        }, 300);
    }

    // Handle form submissions
    document.addEventListener('submit', function(e) {
        const form = e.target;
        
        // Skip if form has data-no-loading attribute
        if (form.hasAttribute('data-no-loading')) {
            return;
        }

        // Find submit buttons in the form
        const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
        
        // Add loading state to buttons
        submitButtons.forEach(button => {
            if (!button.classList.contains('is-loading')) {
                button.classList.add('is-loading');
                button.disabled = true;
                
                // Store original text
                if (!button.hasAttribute('data-original-text')) {
                    button.setAttribute('data-original-text', button.textContent);
                }
            }
        });

        // Show loading bar
        showLoading();

        // Remove loading state after page unload or if form validation fails
        // (in case the form doesn't actually submit due to validation)
        setTimeout(() => {
            if (form.checkValidity && !form.checkValidity()) {
                submitButtons.forEach(button => {
                    button.classList.remove('is-loading');
                    button.disabled = false;
                });
                hideLoading();
            }
        }, 100);
    });

    // Hide loading bar when page loads
    window.addEventListener('load', function() {
        hideLoading();
    });

    // Handle page visibility changes
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            // Page is hidden, might be navigating away
            showLoading();
        }
    });

    // Expose utility functions globally
    window.NestChangeUI = {
        showLoading: showLoading,
        hideLoading: hideLoading,
        
        // Toggle button loading state
        setButtonLoading: function(button, isLoading) {
            if (isLoading) {
                button.classList.add('is-loading');
                button.disabled = true;
            } else {
                button.classList.remove('is-loading');
                button.disabled = false;
            }
        },

        // Show a simple toast notification (if you want to add this later)
        showToast: function(message, type = 'info') {
            // Placeholder for future toast implementation
            console.log(`[${type.toUpperCase()}] ${message}`);
        }
    };

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            // Skip if alert has data-no-auto-hide
            if (alert.hasAttribute('data-no-auto-hide')) {
                return;
            }

            setTimeout(function() {
                alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }, 5000);
        });
    });
})();
