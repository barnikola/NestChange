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
            <input type="text" id="location" placeholder="Anywhere" value="<?php echo htmlspecialchars($filters['location'] ?? ''); ?>">
        </div>
        <div class="search-chip">
            <label>Dates</label>
            <input type="text" id="available_from" placeholder="Anytime" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo htmlspecialchars($filters['available_from'] ?? ''); ?>">
        </div>
        <div class="search-chip">
            <label>Guests</label>
            <input type="number" id="guests" placeholder="Guests" min="1" value="<?php echo htmlspecialchars($filters['max_guests'] ?? '2'); ?>">
        </div>
        <button class="search-btn" onclick="performSearch()">🔍</button>
    </div>
</div>



<!-- Main Content Area -->
<div class="search-results-container">
    <!-- Left Sidebar - Filters -->
    <aside class="filters-sidebar">
        <h3 class="filters-title">Filters</h3>
        

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
            <?php if (empty($listings)): ?>
                <div class="no-results">
                    <h3>No listings found</h3>
                    <p>Try adjusting your search filters or exploring different locations.</p>
                </div>
            <?php else: ?>
                <?php foreach ($listings as $listing): ?>
                    <article class="result-card" data-listing-id="<?php echo htmlspecialchars($listing['id']); ?>">
                        <div class="result-image">
                            <?php if (!empty($listing['primary_image'])): ?>
                                <img src="/<?php echo ltrim($listing['primary_image'], '/'); ?>" alt="<?php echo htmlspecialchars($listing['title']); ?>">
                            <?php else: ?>
                                <img src="/assets/listing.jpg" alt="<?php echo htmlspecialchars($listing['title']); ?>">
                            <?php endif; ?>
                            <button class="btn-favorite">♡</button>
                        </div>
                        <div class="result-details">
                            <div class="result-header">
                                <div>
                                    <p class="result-type">
                                        <?php echo $listing['room_type'] === 'whole_apartment' ? 'Entire home' : 'Private room'; ?> 
                                        in <?php echo htmlspecialchars($listing['city']); ?>
                                    </p>
                                    <h3 class="result-title">
                                        <a href="<?php echo BASE_URL; ?>/listings/<?php echo htmlspecialchars($listing['id']); ?>">
                                            <?php echo htmlspecialchars($listing['title']); ?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <p class="result-features">
                                <?php if (!empty($listing['max_guests'])): ?>
                                    <?php echo htmlspecialchars($listing['max_guests']); ?> guests · 
                                <?php endif; ?>
                                <?php echo $listing['room_type'] === 'whole_apartment' ? 'Entire Home' : 'Private Room'; ?>
                                <?php if (!empty($listing['host_first_name'])): ?>
                                    <br>Host: <?php echo htmlspecialchars($listing['host_first_name']); ?>
                                <?php endif; ?>
                            </p>
                            <p class="result-description">
                                <?php echo htmlspecialchars(substr($listing['description'] ?? '', 0, 100)); ?>
                                <?php if (strlen($listing['description'] ?? '') > 100): ?>...<?php endif; ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

            
            <!-- Pagination -->
            <?php if (isset($pagination) && $pagination['total_pages'] > 1): ?>
                <div class="pagination" style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                    <?php 
                        $queryParams = $_GET;
                        $curPage = $pagination['current_page'];
                        $prevPage = max(1, $curPage - 1);
                        $nextPage = min($pagination['total_pages'], $curPage + 1);
                        
                        // Previous Link
                        $queryParams['page'] = $prevPage;
                        $prevUrl = '?' . http_build_query($queryParams);
                        
                        // Next Link
                        $queryParams['page'] = $nextPage;
                        $nextUrl = '?' . http_build_query($queryParams);
                    ?>
                    
                    <?php if ($curPage > 1): ?>
                        <a href="<?php echo htmlspecialchars($prevUrl); ?>" class="pagination-btn">« Previous</a>
                    <?php endif; ?>
                    
                    <span class="pagination-info">Page <?php echo $curPage; ?> of <?php echo $pagination['total_pages']; ?></span>
                    
                    <?php if ($curPage < $pagination['total_pages']): ?>
                        <a href="<?php echo htmlspecialchars($nextUrl); ?>" class="pagination-btn">Next »</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <aside class="map-container">
        <div id="map"></div>
    </aside>
</div>

<script>
    // Listings data from database
    const listingsData = <?php echo json_encode(array_map(function($l) {
        return [
            'id' => $l['id'],
            'lat' => floatval($l['latitude'] ?? 0),
            'lng' => floatval($l['longitude'] ?? 0),
            'title' => $l['title'],
            'city' => $l['city'],
            'room_type' => $l['room_type']
        ];
    }, $listings ?? [])); ?>;

    // Initialize the map - center on first listing or default location
    let defaultLat = 44.8378;
    let defaultLng = -0.5792;
    
    if (listingsData.length > 0 && listingsData[0].lat && listingsData[0].lng) {
        defaultLat = listingsData[0].lat;
        defaultLng = listingsData[0].lng;
    }
    
    const map = L.map('map').setView([defaultLat, defaultLng], 12);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
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

    // Add markers to the map for listings with coordinates
    const bounds = [];
    listingsData.forEach(listing => {
        if (listing.lat && listing.lng && listing.lat !== 0 && listing.lng !== 0) {
            const marker = L.marker([listing.lat, listing.lng], {
                icon: createMarker(listing.title)
            }).addTo(map);
            
            marker.bindPopup(`<b>${listing.title}</b><br>${listing.city}<br><a href="<?php echo BASE_URL; ?>/listings/${listing.id}">View Listing</a>`);
            
            marker.on('mouseover', function() {
                this.openPopup();
            });
            
            bounds.push([listing.lat, listing.lng]);
        }
    });
    
    // Fit map to show all markers
    if (bounds.length > 1) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }

    // Search functionality - redirects to search with query params
    function performSearch() {
        const location = document.getElementById('location').value;
        const guests = document.getElementById('guests').value;
        const availableFrom = document.getElementById('available_from').value;
        
        const params = new URLSearchParams();
        if (location) params.set('location', location);
        if (guests) {
            const guestNum = parseInt(guests);
            if (!isNaN(guestNum)) params.set('guests', guestNum);
        }
        if (availableFrom) params.set('available_from', availableFrom);
        
        window.location.href = '<?php echo BASE_URL; ?>/listings' + (params.toString() ? '?' + params.toString() : '');
    }

    // Filter functionality
    document.querySelector('.btn-clear').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('.date-input').forEach(input => input.value = '');
        document.querySelectorAll('.amenity-tag').forEach(tag => tag.classList.remove('active'));
    });

    document.querySelector('.btn-apply').addEventListener('click', function() {
        const filters = {
            stayTypes: Array.from(document.querySelectorAll('input[name="stay_type"]:checked')).map(cb => cb.value),
            rules: Array.from(document.querySelectorAll('input[name="rules"]:checked')).map(cb => cb.value),
            amenities: Array.from(document.querySelectorAll('.amenity-tag.active')).map(tag => tag.textContent)
        };
        
        window.location.href = '<?php echo BASE_URL; ?>/listings' + (params.toString() ? '?' + params.toString() : '');
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
