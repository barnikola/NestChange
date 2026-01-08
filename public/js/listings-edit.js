/**
 * Listings edit page interactions
 * - Delete listing images via AJAX
 */
(function() {
    'use strict';

    const configScript = document.getElementById('listing-edit-config');
    const config = configScript ? JSON.parse(configScript.textContent || '{}') : {};
    const csrfToken = config.csrfToken || '';
    const listingId = config.listingId || '';
    const baseUrl = config.baseUrl || '';

    document.addEventListener('DOMContentLoaded', function() {
        if (!csrfToken || !listingId || !baseUrl) return;

        const deleteImageBtns = document.querySelectorAll('.delete-image-btn');

        deleteImageBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Delete this image?')) return;

                const imageId = this.dataset.imageId;
                const imageItem = this.closest('.listing-image-item');
                if (!imageId || !imageItem) return;

                fetch(`${baseUrl}/listings/${listingId}/images/${imageId}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `csrf_token=${encodeURIComponent(csrfToken)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        imageItem.remove();
                    } else {
                        alert(data.error || 'Failed to delete image');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the image');
                });
            });
        });
    });
})();





