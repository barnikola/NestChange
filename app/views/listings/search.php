<?php
$pageTitle = 'Search Listings - NestChange';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Listings', 'url' => '/listings'],
    ['label' => 'Search'],
];
$extraHead = <<<HTML
    <link rel="stylesheet" href="/css/listings.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
HTML;

// Helper to check if filter is active
function isFilterActive($key, $value, $filters) {
    if (!isset($filters[$key])) return '';
    if (is_array($filters[$key])) {
        return in_array($value, $filters[$key]) ? 'active' : '';
    }
    return $filters[$key] == $value ? 'active' : '';
}

// Helper to check checkbox state
function isCheckedFilter($key, $value, $filters) {
    if (!isset($filters[$key])) return '';
    if (is_array($filters[$key])) {
        return in_array($value, $filters[$key]) ? 'checked' : '';
    }
    return $filters[$key] == $value ? 'checked' : '';
}

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
            <label>Check-in</label>
            <input type="text"
            onfocus="this.type='date'"
            onblur="(this.type='text')" 
            id="available_from" 
            placeholder="Add dates" value="<?php echo htmlspecialchars($filters['available_from'] ?? ''); ?>">
        </div>
        <div class="search-chip">
            <label>Check-out</label>
            <input type="text"
            onfocus="this.type='date'"
            onblur="(this.type='text')" 
            id="available_until" placeholder="Add dates" value="<?php echo htmlspecialchars($filters['available_until'] ?? ''); ?>">
        </div>
        <div class="search-chip">
            <label>Guests</label>
            <input type="number" id="guests" placeholder="Add guests" min="1" value="<?php echo htmlspecialchars($filters['max_guests'] ?? ''); ?>">
        </div>
        <button class="search-btn" onclick="performSearch()" aria-label="Search">🔍</button>
    </div>
</div>

<!-- Main Content Area -->
<div class="search-results-container">
    <!-- Left Sidebar - Filters -->
    <aside class="filters-sidebar" id="filters-sidebar">
        
        <h3 class="filters-title">Filters</h3>
        
        <!-- Room Type Filter -->
        <div class="filter-group">
            <h4 class="filter-label">Room Type</h4>
            <label class="checkbox-label">
                <input type="checkbox" name="room_type" value="whole_apartment" 
                       <?php echo isCheckedFilter('room_type', 'whole_apartment', $filters); ?>>
                <span>Entire home</span>
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="room_type" value="room" 
                       <?php echo isCheckedFilter('room_type', 'room', $filters); ?>>
                <span>Private room</span>
            </label>
        </div>

        <!-- Amenities Filter -->
        <?php 
        // Separate amenities and rules from attributes
        $amenities = [];
        $rules = [];
        
        if (!empty($attributes)) {
            // Flatten attributes if grouped by category
            $flatAttributes = [];
            foreach ($attributes as $catOrAttr) {
                if (is_array($catOrAttr) && isset($catOrAttr[0])) {
                    // It's a grouped array
                    foreach ($catOrAttr as $attr) {
                        $flatAttributes[] = $attr;
                    }
                } elseif (is_array($catOrAttr) && isset($catOrAttr['id'])) {
                    // It's a single attribute
                    $flatAttributes[] = $catOrAttr;
                }
            }
            
            // Separate by category
            foreach ($flatAttributes as $attr) {
                $category = strtoupper($attr['category'] ?? '');
                if ($category === 'RULES' || $category === 'RULE') {
                    $rules[] = $attr;
                } else {
                    // Default to amenities if category is not explicitly RULES
                    $amenities[] = $attr;
                }
            }
        }
        ?>
        
        <?php if (!empty($amenities)): ?>
        <div class="filter-group">
            <h4 class="filter-label">Amenities</h4>
            <div class="amenity-tags" id="amenities-container">
                <?php 
                // Show all amenities, first 5 visible, rest hidden (unless active)
                $totalAmenities = count($amenities);
                $showLimit = 5;
                $activeAttributeIds = isset($filters['attributes']) && is_array($filters['attributes']) ? $filters['attributes'] : [];
                
                foreach ($amenities as $index => $attr) {
                    $isActive = in_array($attr['id'], $activeAttributeIds);
                    // Show if within limit OR if it's active
                    $shouldShow = $index < $showLimit || $isActive;
                    $isHidden = $shouldShow ? '' : 'style="display: none;"';
                    echo '<button type="button" class="amenity-tag' . ($isActive ? ' active' : '') . '" data-id="' . $attr['id'] . '" data-amenity-index="' . $index . '" ' . $isHidden . '>' . htmlspecialchars($attr['name']) . '</button>';
                }
                ?>
            </div>
            <?php 
            // Count how many are actually hidden (excluding active ones that are shown)
            $hiddenAmenitiesCount = 0;
            foreach ($amenities as $index => $attr) {
                if ($index >= $showLimit && !in_array($attr['id'], $activeAttributeIds)) {
                    $hiddenAmenitiesCount++;
                }
            }
            if ($hiddenAmenitiesCount > 0): ?>
                <button type="button" class="show-more-btn" id="show-more-amenities" onclick="toggleAmenities()">
                    + See more (<?php echo $hiddenAmenitiesCount; ?>)
                </button>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Rules Filter -->
        <?php if (!empty($rules)): ?>
        <div class="filter-group">
            <h4 class="filter-label">Rules</h4>
            <div class="amenity-tags" id="rules-container">
                <?php 
                // Show all rules, first 5 visible, rest hidden (unless active)
                $totalRules = count($rules);
                $showLimit = 5;
                $activeAttributeIds = isset($filters['attributes']) && is_array($filters['attributes']) ? $filters['attributes'] : [];
                
                foreach ($rules as $index => $attr) {
                    $isActive = in_array($attr['id'], $activeAttributeIds);
                    // Show if within limit OR if it's active
                    $shouldShow = $index < $showLimit || $isActive;
                    $isHidden = $shouldShow ? '' : 'style="display: none;"';
                    echo '<button type="button" class="amenity-tag rule-tag' . ($isActive ? ' active' : '') . '" data-id="' . $attr['id'] . '" data-rule-index="' . $index . '" ' . $isHidden . '>' . htmlspecialchars($attr['name']) . '</button>';
                }
                ?>
            </div>
            <?php 
            // Count how many are actually hidden (excluding active ones that are shown)
            $hiddenRulesCount = 0;
            foreach ($rules as $index => $attr) {
                if ($index >= $showLimit && !in_array($attr['id'], $activeAttributeIds)) {
                    $hiddenRulesCount++;
                }
            }
            if ($hiddenRulesCount > 0): ?>
                <button type="button" class="show-more-btn" id="show-more-rules" onclick="toggleRules()">
                    + See more (<?php echo $hiddenRulesCount; ?>)
                </button>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Services Filter -->
        <?php if (!empty($services)): ?>
        <div class="filter-group">
            <h4 class="filter-label">Guest Requirements</h4>
            <div class="amenity-tags" id="services-container">
                <?php 
                // Show all services, first 5 visible, rest hidden (unless active)
                $totalServices = count($services);
                $showLimit = 5;
                $activeServiceIds = isset($filters['services']) && is_array($filters['services']) ? $filters['services'] : [];
                
                foreach ($services as $index => $service) {
                    $isActive = in_array($service['id'], $activeServiceIds);
                    // Show if within limit OR if it's active
                    $shouldShow = $index < $showLimit || $isActive;
                    $isHidden = $shouldShow ? '' : 'style="display: none;"';
                    echo '<button type="button" class="amenity-tag service-tag' . ($isActive ? ' active' : '') . '" data-id="' . $service['id'] . '" data-service-index="' . $index . '" ' . $isHidden . '>' . htmlspecialchars($service['name']) . '</button>';
                }
                ?>
            </div>
            <?php 
            // Count how many are actually hidden (excluding active ones that are shown)
            $hiddenServicesCount = 0;
            foreach ($services as $index => $service) {
                if ($index >= $showLimit && !in_array($service['id'], $activeServiceIds)) {
                    $hiddenServicesCount++;
                }
            }
            if ($hiddenServicesCount > 0): ?>
                <button type="button" class="show-more-btn" id="show-more-services" onclick="toggleServices()">
                    + See more (<?php echo $hiddenServicesCount; ?>)
                </button>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Sort Options -->
        <div class="filter-group">
            <h4 class="filter-label">Sort by</h4>
            <select id="sort-select" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                <option value="newest" <?php echo ($filters['sort'] ?? 'newest') === 'newest' ? 'selected' : ''; ?>>Newest first</option>
                <option value="oldest" <?php echo ($filters['sort'] ?? '') === 'oldest' ? 'selected' : ''; ?>>Oldest first</option>
                <option value="title" <?php echo ($filters['sort'] ?? '') === 'title' ? 'selected' : ''; ?>>Title A-Z</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="filter-actions">
            <button class="btn-clear" onclick="clearFilters()">Clear all</button>
            <button class="btn-apply" onclick="applyFilters()">Apply</button>
        </div>
    </aside>

    <!-- Center - Listings Results -->
    <main class="listings-results">
        <div class="results-header">
            <span class="results-count">
                <?php if (isset($pagination)): ?>
                    <?php echo $pagination['total_items']; ?> listing<?php echo $pagination['total_items'] !== 1 ? 's' : ''; ?> found
                <?php endif; ?>
            </span>
        </div>
        
        <div class="listings-list" id="listings-list">
            <?php if (empty($listings)): ?>
                <div class="no-results">
                    <h3>No listings found</h3>
                    <p>Try adjusting your search filters or exploring different locations.</p>
                </div>
            <?php else: ?>
                <?php foreach ($listings as $listing): ?>
                    <article class="result-card" 
                             data-listing-id="<?php echo htmlspecialchars($listing['id']); ?>"
                             onclick="window.location.href='<?php echo BASE_URL; ?>/listings/<?php echo htmlspecialchars($listing['id']); ?>'">
                        <div class="result-image">
                            <?php if (!empty($listing['primary_image'])): ?>
                                <img src="/<?php echo ltrim($listing['primary_image'], '/'); ?>" 
                                     alt="<?php echo htmlspecialchars($listing['title']); ?>">
                            <?php else: ?>
                                <img src="/assets/listing.jpg" alt="<?php echo htmlspecialchars($listing['title']); ?>">
                            <?php endif; ?>
                            <button class="btn-favorite <?php echo !empty($listing['is_favorited']) ? 'favorited' : ''; ?>" 
                                    onclick="event.stopPropagation(); toggleFavorite(this, '<?php echo $listing['id']; ?>')"
                                    data-listing-id="<?php echo $listing['id']; ?>"
                                    title="<?php echo !empty($listing['is_favorited']) ? 'Remove from favorites' : 'Add to favorites'; ?>">
                                <?php echo !empty($listing['is_favorited']) ? '❤️' : '♡'; ?>
                            </button>
                        </div>
                        <div class="result-details">
                            <div class="result-header">
                                <div>
                                    <p class="result-type">
                                        <?php echo $listing['room_type'] === 'whole_apartment' ? 'Entire home' : 'Private room'; ?> 
                                        in <?php echo htmlspecialchars($listing['city']); ?>
                                    </p>
                                    <h3 class="result-title">
                                        <?php echo htmlspecialchars($listing['title']); ?>
                                    </h3>
                                </div>
                            </div>
                            <p class="result-features">
                                <?php if (!empty($listing['max_guests'])): ?>
                                    <?php echo htmlspecialchars($listing['max_guests']); ?> guests · 
                                <?php endif; ?>
                                <?php echo $listing['room_type'] === 'whole_apartment' ? 'Entire Home' : 'Private Room'; ?>
                                <?php if (!empty($listing['host_first_name'])): ?>
                                    <br><span style="color: #666;">Host: <?php echo htmlspecialchars($listing['host_first_name']); ?></span>
                                <?php endif; ?>
                            </p>
                            <p class="result-description">
                                <?php echo htmlspecialchars(substr($listing['description'] ?? '', 0, 120)); ?>
                                <?php if (strlen($listing['description'] ?? '') > 120): ?>...<?php endif; ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if (isset($pagination) && $pagination['total_pages'] > 1): ?>
                <div class="pagination">
                    <?php 
                        $queryParams = $_GET;
                        $curPage = $pagination['current_page'];
                        $totalPages = $pagination['total_pages'];
                    ?>
                    
                    <?php if ($curPage > 1): ?>
                        <?php $queryParams['page'] = $curPage - 1; ?>
                        <a href="?<?php echo http_build_query($queryParams); ?>" class="pagination-btn">« Previous</a>
                    <?php endif; ?>
                    
                    <span class="pagination-info">
                        Page <?php echo $curPage; ?> of <?php echo $totalPages; ?>
                    </span>
                    
                    <?php if ($curPage < $totalPages): ?>
                        <?php $queryParams['page'] = $curPage + 1; ?>
                        <a href="?<?php echo http_build_query($queryParams); ?>" class="pagination-btn">Next »</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Map Container -->
    <aside class="map-container">
        <div id="map"></div>
    </aside>
</div>

<script id="listings-filters-config" type="application/json">
<?php
echo json_encode([
    'baseUrl' => BASE_URL,
    'filterState' => [
        'location' => $filters['location'] ?? '',
        'available_from' => $filters['available_from'] ?? '',
        'available_until' => $filters['available_until'] ?? '',
        'max_guests' => $filters['max_guests'] ?? '',
        'room_type' => $filters['room_type'] ?? null,
        'attributes' => $filters['attributes'] ?? [],
        'services' => $filters['services'] ?? [],
        'sort' => $filters['sort'] ?? 'newest'
    ],
    'listingsData' => array_map(function($l) {
        return [
            'id' => $l['id'],
            'lat' => floatval($l['latitude'] ?? 0),
            'lng' => floatval($l['longitude'] ?? 0),
            'title' => $l['title'],
            'city' => $l['city'],
            'room_type' => $l['room_type']
        ];
    }, $listings ?? [])
]);
?>
</script>
<script src="/js/listings-filters.js"></script>
<script src="/js/favorites.js"></script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
