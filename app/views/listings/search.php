<?php
$pageTitle = 'Search Listings - NestChange';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Listings', 'url' => '/listings'],
    ['label' => 'Search'],
];
$extraHead = <<<HTML
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
HTML;

ob_start();
?>
<!-- Search Bar -->
<div class="search-bar-container">
    <div class="search-bar">
        <div class="search-chip">
            <label>Location</label>
            <input type="text" id="location" placeholder="Bordeaux" value="Bordeaux">
        </div>
        <div class="search-chip">
            <label>Dates</label>
            <input type="text" id="checkin" placeholder="Feb 19-26" value="Feb 19-26">
        </div>
        <div class="search-chip">
            <label>Guests</label>
            <input type="text" id="guests" placeholder="2 guests" value="2 guests">
        </div>
        <button class="search-btn" onclick="performSearch()">🔍</button>
    </div>
</div>



<!-- Main Content Area -->
<div class="search-results-container">
    <!-- Left Sidebar - Filters -->
    <aside class="filters-sidebar">
        <h3 class="filters-title">Filters</h3>
        
        <!-- Price Range -->
        <div class="filter-group">
            <h4 class="filter-label">Price range</h4>
            <div class="price-inputs">
                <input type="number" class="price-input" placeholder="0" value="0">
                <span>—</span>
                <input type="number" class="price-input" placeholder="1000" value="1000">
            </div>
        </div>

        <!-- Dates -->
        <div class="filter-group">
            <h4 class="filter-label">Dates</h4>
            <input type="date" class="date-input" value="2025-02-12">
            <input type="date" class="date-input" value="2025-02-12">
        </div>

        <!-- Type of Stay -->
        <div class="filter-group">
            <h4 class="filter-label">Type of stay</h4>
            <label class="checkbox-label">
                <input type="checkbox" name="stay_type" value="house_exchange">
                <span>House exchange</span>
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="stay_type" value="room_exchange">
                <span>Room exchange</span>
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="stay_type" value="hospitality_exchange">
                <span>Hospitality exchange</span>
            </label>
        </div>

        <!-- Services / Amenities -->
        <div class="filter-group">
            <h4 class="filter-label">Services / Amenities</h4>
            <div class="amenity-tags">
                <button class="amenity-tag">WiFi</button>
                <button class="amenity-tag">Kitchen</button>
                <button class="amenity-tag">Parking</button>
                <button class="amenity-tag">Pool</button>
                <button class="amenity-tag">Air conditioning</button>
                <button class="amenity-tag">Workspace</button>
            </div>
        </div>

        <!-- Rules -->
        <div class="filter-group">
            <h4 class="filter-label">Rules</h4>
            <label class="checkbox-label">
                <input type="checkbox" name="rules" value="no_smoking">
                <span>No smoking</span>
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="rules" value="pets_allowed">
                <span>Pets allowed</span>
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="rules" value="children_welcome">
                <span>Children welcome</span>
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="rules" value="events_allowed">
                <span>Events allowed</span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="filter-actions">
            <button class="btn-clear">Clear all</button>
            <button class="btn-apply">Apply</button>
        </div>
    </aside>

    <!-- Center - Listings Results -->
    <main class="listings-results">
        <div class="listings-list" id="listings-list">
            <!-- Listing Card 1 -->
            <article class="result-card">
                <div class="result-image">
                    <img src="/assets/listing.jpg" alt="Bordeaux Getaway">
                    <button class="btn-favorite">♡</button>
                </div>
                <div class="result-details">
                    <div class="result-header">
                        <div>
                            <p class="result-type">Entire home in Bordeaux</p>
                            <h3 class="result-title">Bordeaux Getaway</h3>
                        </div>
                        <div class="result-price-section">
                            <span class="result-price">$325</span>
                            <span class="price-period">/night</span>
                        </div>
                    </div>
                    <p class="result-features">6 guests · Entire Home · 4 beds · 2 bath<br>Wifi · Pool · Parking</p>
                    <div class="result-rating">
                        <span class="rating-star">★</span>
                        <span class="rating-value">4.8</span>
                        <span class="rating-count">(210 reviews)</span>
                    </div>
                </div>
            </article>

            <!-- Listing Card 2 -->
            <article class="result-card">
                <div class="result-image">
                    <img src="/assets/listing.jpg" alt="Charming Waterfront Condo">
                    <button class="btn-favorite">♡</button>
                </div>
                <div class="result-details">
                    <div class="result-header">
                        <div>
                            <p class="result-type">Entire home in Bordeaux</p>
                            <h3 class="result-title">Charming Waterfront Condo</h3>
                        </div>
                        <div class="result-price-section">
                            <span class="result-price">$200</span>
                            <span class="price-period">/night</span>
                        </div>
                    </div>
                    <p class="result-features">4 guests · Entire Home · 2 beds · 2 bath<br>Wifi · Kitchen · Washer</p>
                    <div class="result-rating">
                        <span class="rating-star">★</span>
                        <span class="rating-value">4.9</span>
                        <span class="rating-count">(145 reviews)</span>
                    </div>
                </div>
            </article>

            <!-- Listing Card 3 -->
            <article class="result-card">
                <div class="result-image">
                    <img src="/assets/listing.jpg" alt="Historic City Center Home">
                    <button class="btn-favorite">♡</button>
                </div>
                <div class="result-details">
                    <div class="result-header">
                        <div>
                            <p class="result-type">Entire home in Bordeaux</p>
                            <h3 class="result-title">Historic City Center Home</h3>
                        </div>
                        <div class="result-price-section">
                            <span class="result-price">$125</span>
                            <span class="price-period">/night</span>
                        </div>
                    </div>
                    <p class="result-features">4-6 guests · Entire Home · 5 beds · 3 bath<br>Wifi · Kitchen · Free Parking</p>
                    <div class="result-rating">
                        <span class="rating-star">★</span>
                        <span class="rating-value">5.0</span>
                        <span class="rating-count">(318 reviews)</span>
                    </div>
                </div>
            </article>
        </div>
    </main>

    <aside class="map-container">
        <div id="map"></div>
    </aside>
</div>

<script>
    // Initialize the map centered on Bordeaux
    const map = L.map('map').setView([44.8378, -0.5792], 12);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Sample listings data with coordinates
    const listings = [
        { lat: 44.8378, lng: -0.5792, price: '$325', title: 'Bordeaux Getaway' },
        { lat: 44.8450, lng: -0.5650, price: '$200', title: 'Charming Waterfront Condo' },
        { lat: 44.8320, lng: -0.5900, price: '$125', title: 'Historic City Center Home' }
    ];

    // Custom marker icon for price tags
    const createPriceMarker = (price) => {
        return L.divIcon({
            className: 'price-marker',
            html: `<div class="price-marker-content">${price}</div>`,
            iconSize: [60, 30],
            iconAnchor: [30, 30]
        });
    };

    // Add markers to the map
    listings.forEach(listing => {
        const marker = L.marker([listing.lat, listing.lng], {
            icon: createPriceMarker(listing.price)
        }).addTo(map);
        
        marker.bindPopup(`<b>${listing.title}</b><br>${listing.price}/night`);
        
        // Add hover effect
        marker.on('mouseover', function() {
            this.openPopup();
        });
    });

    // Search functionality
    function performSearch() {
        const location = document.getElementById('location').value;
        const checkin = document.getElementById('checkin').value;
        const guests = document.getElementById('guests').value;
        
        console.log('Searching for:', { location, checkin, guests });
        // Add AJAX call to backend here
    }

    // Filter functionality
    document.querySelector('.btn-clear').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('.price-input').forEach(input => input.value = '');
        document.querySelectorAll('.date-input').forEach(input => input.value = '');
        document.querySelectorAll('.amenity-tag').forEach(tag => tag.classList.remove('active'));
    });

    document.querySelector('.btn-apply').addEventListener('click', function() {
        const filters = {
            priceMin: document.querySelectorAll('.price-input')[0].value,
            priceMax: document.querySelectorAll('.price-input')[1].value,
            stayTypes: Array.from(document.querySelectorAll('input[name="stay_type"]:checked')).map(cb => cb.value),
            rules: Array.from(document.querySelectorAll('input[name="rules"]:checked')).map(cb => cb.value),
            amenities: Array.from(document.querySelectorAll('.amenity-tag.active')).map(tag => tag.textContent)
        };
        
        console.log('Applying filters:', filters);
        // Add AJAX call to backend here
    });

    // Amenity tag toggle
    document.querySelectorAll('.amenity-tag').forEach(tag => {
        tag.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });

    // Favorite button toggle
    document.querySelectorAll('.btn-favorite').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
            this.textContent = this.classList.contains('active') ? '♥' : '♡';
        });
    });
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
