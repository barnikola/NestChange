/**
 * Listings Filters JavaScript
 * Handles filter functionality, map display, and search for listings page
 */

(function() {
    'use strict';

    // Get configuration from data attribute or global variable
    const configScript = document.getElementById('listings-filters-config');
    if (!configScript) {
        console.error('Listings filters config not found');
        return;
    }

    const config = JSON.parse(configScript.textContent);
    const BASE_URL = config.baseUrl;
    const filterState = config.filterState || {};
    const listingsData = config.listingsData || [];

    // Initialize the map
    let defaultLat = 44.8378;
    let defaultLng = -0.5792;
    
    if (listingsData.length > 0 && listingsData[0].lat && listingsData[0].lng) {
        defaultLat = listingsData[0].lat;
        defaultLng = listingsData[0].lng;
    }
    
    const map = L.map('map').setView([defaultLat, defaultLng], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19
    }).addTo(map);

    // Custom marker icon
    const createMarker = (title) => {
        return L.divIcon({
            className: 'property-marker',
            html: `<div class="property-marker-content">📍</div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });
    };

    // Add markers
    const bounds = [];
    listingsData.forEach(listing => {
        if (listing.lat && listing.lng && listing.lat !== 0 && listing.lng !== 0) {
            const marker = L.marker([listing.lat, listing.lng], {
                icon: createMarker(listing.title)
            }).addTo(map);
            
            marker.bindPopup(`
                <b>${listing.title}</b><br>
                ${listing.city}<br>
                <a href="${BASE_URL}/listings/${listing.id}">View Listing</a>
            `);
            
            marker.on('mouseover', function() {
                this.openPopup();
            });
            
            bounds.push([listing.lat, listing.lng]);
        }
    });
    
    if (bounds.length > 1) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }

    // Search functionality
    window.performSearch = function() {
        const location = document.getElementById('location').value;
        const guests = document.getElementById('guests').value;
        const availableFrom = document.getElementById('available_from').value;
        const availableUntil = document.getElementById('available_until').value;
        
        const params = new URLSearchParams();
        if (location) params.set('location', location);
        if (guests) params.set('guests', guests);
        if (availableFrom) params.set('available_from', availableFrom);
        if (availableUntil) params.set('available_until', availableUntil);
        
        // Preserve other filters
        if (filterState.room_type) params.set('room_type', filterState.room_type);
        if (filterState.sort) params.set('sort', filterState.sort);
        if (filterState.attributes?.length) {
            filterState.attributes.forEach(id => params.append('attributes[]', id));
        }
        if (filterState.services?.length) {
            filterState.services.forEach(id => params.append('services[]', id));
        }
        
        window.location.href = BASE_URL + '/listings' + (params.toString() ? '?' + params.toString() : '');
    };

    // Filter functions
    window.applyFilters = function() {
        const params = new URLSearchParams();
        
        // Get main search values
        const location = document.getElementById('location').value;
        const guests = document.getElementById('guests').value;
        const availableFrom = document.getElementById('available_from').value;
        const availableUntil = document.getElementById('available_until').value;
        
        if (location) params.set('location', location);
        if (guests) params.set('guests', guests);
        if (availableFrom) params.set('available_from', availableFrom);
        if (availableUntil) params.set('available_until', availableUntil);
        
        // Room type
        const roomTypes = document.querySelectorAll('input[name="room_type"]:checked');
        if (roomTypes.length === 1) {
            params.set('room_type', roomTypes[0].value);
        }
        
        // Amenities and Rules (both use attributes filter)
        const activeAmenities = document.querySelectorAll('.amenity-tag.active:not(.service-tag):not(.rule-tag)');
        const activeRules = document.querySelectorAll('.rule-tag.active');
        activeAmenities.forEach(tag => {
            params.append('attributes[]', tag.dataset.id);
        });
        activeRules.forEach(tag => {
            params.append('attributes[]', tag.dataset.id);
        });
        
        // Services
        const activeServices = document.querySelectorAll('.amenity-tag.service-tag.active');
        activeServices.forEach(tag => {
            params.append('services[]', tag.dataset.id);
        });
        
        // Sort
        const sort = document.getElementById('sort-select').value;
        if (sort) params.set('sort', sort);
        
        window.location.href = BASE_URL + '/listings' + (params.toString() ? '?' + params.toString() : '');
    };

    window.clearFilters = function() {
        // Uncheck all checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        
        // Clear date inputs
        document.getElementById('available_from').value = '';
        document.getElementById('available_until').value = '';
        
        // Remove active class from tags
        document.querySelectorAll('.amenity-tag').forEach(tag => tag.classList.remove('active'));
        
        // Reset sort
        document.getElementById('sort-select').value = 'newest';
        
        // Clear main search inputs
        document.getElementById('location').value = '';
        document.getElementById('guests').value = '';
        document.getElementById('available_from').value = '';
        
        // Reset expanded states
        amenitiesExpanded = false;
        servicesExpanded = false;
        rulesExpanded = false;
        
        window.location.href = BASE_URL + '/listings';
    };

    window.toggleFilters = function() {
        const sidebar = document.getElementById('filters-sidebar');
        const toggleText = document.getElementById('filter-toggle-text');
        
        sidebar.classList.toggle('collapsed');
        
        if (sidebar.classList.contains('collapsed')) {
            toggleText.textContent = 'Show Filters';
        } else {
            toggleText.textContent = 'Hide Filters';
        }
    };

    window.toggleFavorite = function(btn, listingId) {
        btn.classList.toggle('active');
        btn.textContent = btn.classList.contains('active') ? '♥' : '♡';
        // TODO: Save to favorites via API
    };

    // Amenity/Service tag toggle
    document.querySelectorAll('.amenity-tag').forEach(tag => {
        tag.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
        });
    });

    // Enter key support for search
    document.querySelectorAll('#location, #guests, #available_from, #available_until').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                window.performSearch();
            }
        });
    });
    
    // Validate date range: check-out must be after check-in
    const availableUntilInput = document.getElementById('available_until');
    if (availableUntilInput) {
        availableUntilInput.addEventListener('change', function() {
            const checkIn = document.getElementById('available_from').value;
            const checkOut = this.value;
            
            if (checkIn && checkOut && checkOut < checkIn) {
                alert('Check-out date must be after check-in date');
                this.value = '';
            }
        });
    }

    // Toggle amenities show more/less
    let amenitiesExpanded = false;
    window.toggleAmenities = function() {
        const container = document.getElementById('amenities-container');
        const btn = document.getElementById('show-more-amenities');
        if (!container || !btn) return;
        
        const allTags = Array.from(container.querySelectorAll('.amenity-tag:not(.service-tag)'));
        const showLimit = 5;
        
        if (!amenitiesExpanded) {
            // Show all hidden tags
            allTags.forEach((tag, index) => {
                if (index >= showLimit && !tag.classList.contains('active')) {
                    tag.style.display = '';
                }
            });
            btn.textContent = '− Show less';
            amenitiesExpanded = true;
        } else {
            // Hide tags beyond first 5 (but keep active ones visible)
            let hiddenCount = 0;
            allTags.forEach((tag, index) => {
                if (index >= showLimit && !tag.classList.contains('active')) {
                    tag.style.display = 'none';
                    hiddenCount++;
                }
            });
            btn.textContent = '+ See more (' + hiddenCount + ')';
            amenitiesExpanded = false;
        }
    };

    // Toggle services show more/less
    let servicesExpanded = false;
    window.toggleServices = function() {
        const container = document.getElementById('services-container');
        const btn = document.getElementById('show-more-services');
        if (!container || !btn) return;
        
        const allTags = Array.from(container.querySelectorAll('.service-tag'));
        const showLimit = 5;
        
        if (!servicesExpanded) {
            // Show all hidden tags
            allTags.forEach((tag, index) => {
                if (index >= showLimit && !tag.classList.contains('active')) {
                    tag.style.display = '';
                }
            });
            btn.textContent = '− Show less';
            servicesExpanded = true;
        } else {
            // Hide tags beyond first 5 (but keep active ones visible)
            let hiddenCount = 0;
            allTags.forEach((tag, index) => {
                if (index >= showLimit && !tag.classList.contains('active')) {
                    tag.style.display = 'none';
                    hiddenCount++;
                }
            });
            btn.textContent = '+ See more (' + hiddenCount + ')';
            servicesExpanded = false;
        }
    };

    // Toggle rules show more/less
    let rulesExpanded = false;
    window.toggleRules = function() {
        const container = document.getElementById('rules-container');
        const btn = document.getElementById('show-more-rules');
        if (!container || !btn) return;
        
        const allTags = Array.from(container.querySelectorAll('.rule-tag'));
        const showLimit = 5;
        
        if (!rulesExpanded) {
            // Show all hidden tags
            allTags.forEach((tag, index) => {
                if (index >= showLimit && !tag.classList.contains('active')) {
                    tag.style.display = '';
                }
            });
            btn.textContent = '− Show less';
            rulesExpanded = true;
        } else {
            // Hide tags beyond first 5 (but keep active ones visible)
            let hiddenCount = 0;
            allTags.forEach((tag, index) => {
                if (index >= showLimit && !tag.classList.contains('active')) {
                    tag.style.display = 'none';
                    hiddenCount++;
                }
            });
            btn.textContent = '+ See more (' + hiddenCount + ')';
            rulesExpanded = false;
        }
    };

    // Initialize filter sidebar state on mobile
    if (window.innerWidth <= 900) {
        const sidebar = document.getElementById('filters-sidebar');
        if (sidebar) {
            sidebar.classList.add('collapsed');
        }
    }
})();
