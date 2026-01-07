/**
 * My listings page interactions
 * - Filter and search listings
 * - Delete confirmation modal wiring
 */
(function() {
    'use strict';

    const configScript = document.getElementById('my-listings-config');
    const config = configScript ? JSON.parse(configScript.textContent || '{}') : {};
    const baseUrl = config.baseUrl || '';

    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const tableRows = document.querySelectorAll('#listings-table tbody tr');
        const searchInput = document.getElementById('listing-search');
        const deleteModal = document.getElementById('delete-modal');
        const deleteForm = document.getElementById('delete-form');
        const deleteTitleSpan = document.getElementById('delete-listing-title');
        const cancelBtn = document.getElementById('cancel-delete');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.style.background = '#f2f2f2';
                    b.style.color = '#000';
                });

                this.classList.add('active');
                this.style.background = '#000';
                this.style.color = '#fff';

                const status = this.dataset.status;
                tableRows.forEach(row => {
                    if (status === 'all' || row.dataset.status === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();

                tableRows.forEach(row => {
                    const title = (row.dataset.title || '').toLowerCase();
                    const location = (row.dataset.location || '').toLowerCase();

                    if (title.includes(query) || location.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        if (deleteModal && deleteForm && deleteTitleSpan && cancelBtn) {
            document.querySelectorAll('.delete-listing-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const listingId = this.dataset.listingId;
                    const listingTitle = this.dataset.listingTitle;

                    deleteTitleSpan.textContent = listingTitle;
                    deleteForm.action = baseUrl ? `${baseUrl}/listings/${listingId}/delete` : `/listings/${listingId}/delete`;
                    deleteModal.style.display = 'flex';
                });
            });

            cancelBtn.addEventListener('click', function() {
                deleteModal.style.display = 'none';
            });

            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.style.display = 'none';
                }
            });
        }

        const initialActive = document.querySelector('.filter-btn.active');
        if (initialActive) {
            initialActive.style.background = '#000';
            initialActive.style.color = '#fff';
        }
    });
})();





