<?php
$pageTitle = 'NestChange - ' . htmlspecialchars($listing['title'] ?? 'Listing Details');
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Listings', 'url' => '/listings'],
    ['label' => htmlspecialchars($listing['title'] ?? 'Listing')],
];

$extraHead = '<link rel="stylesheet" href="/css/listings.css">';

// Helper function to get initials from name
function getInitials($firstName, $lastName = ''): string {
    $initials = '';
    if ($firstName) $initials .= strtoupper(substr($firstName, 0, 1));
    if ($lastName) $initials .= strtoupper(substr($lastName, 0, 1));
    return $initials ?: '?';
}

// Helper function to get icon for amenity/service
function getAmenityIcon($name): string {
    $icons = [
        'wifi' => '📶',
        'air conditioning' => '❄️',
        'heating' => '🔥',
        'kitchen' => '🍳',
        'washing machine' => '🧺',
        'dryer' => '💨',
        'tv' => '📺',
        'workspace' => '💻',
        'smoke alarm' => '🚨',
        'carbon monoxide alarm' => '⚠️',
        'first aid kit' => '🏥',
        'fire extinguisher' => '🧯',
        'near public transport' => '🚌',
        'city center' => '🏙️',
        'near university' => '🎓',
        'quiet neighborhood' => '🌳',
        'private bathroom' => '🚿',
        'balcony' => '🌅',
        'garden access' => '🌿',
        'furnished' => '🛋️',
    ];
    
    $key = strtolower($name);
    return $icons[$key] ?? 'ℹ️';
}

function getServiceIcon($name): string {
    $icons = [
        'cleaning' => '🧹',
        'laundry' => '👕',
        'breakfast' => '🥐',
        'airport pickup' => '✈️',
        'bike rental' => '🚴',
        'parking' => '🅿️',
        'gym access' => '🏋️',
        'pool access' => '🏊',
        'pet friendly' => '🐾',
        'language exchange' => '🗣️',
    ];
    
    $key = strtolower($name);
    return $icons[$key] ?? '✓';
}

// Group attributes by category
$attributesByCategory = [];
if (!empty($listing['attributes'])) {
    foreach ($listing['attributes'] as $attr) {
        $category = $attr['category'] ?? 'Other';
        if (!isset($attributesByCategory[$category])) {
            $attributesByCategory[$category] = [];
        }
        $attributesByCategory[$category][] = $attr;
    }
}

ob_start();
?>
<!-- Listing Header with Carousel -->
<section class="holder">
    <div class="listing-carousel">
        <button class="carousel-control prev" type="button" aria-label="Previous photo">‹</button>
        <div class="carousel-track">
            <?php if (!empty($listing['images'])): ?>
                <?php foreach ($listing['images'] as $index => $img): ?>
                    <img
                        src="/<?php echo ltrim($img['image'], '/'); ?>"
                        alt="<?php echo htmlspecialchars($listing['title']); ?> photo <?php echo $index + 1; ?>"
                        class="carousel-slide<?php echo $index === 0 ? ' active' : ''; ?>">
                <?php endforeach; ?>
            <?php else: ?>
                <img src="/assets/listing.jpg" alt="Default listing photo" class="carousel-slide active">
            <?php endif; ?>
        </div>
        <button class="carousel-control next" type="button" aria-label="Next photo">›</button>
        <div class="carousel-dots">
            <?php $imageCount = !empty($listing['images']) ? count($listing['images']) : 1; ?>
            <?php for ($i = 0; $i < $imageCount; $i++): ?>
                <span class="carousel-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>"></span>
            <?php endfor; ?>
        </div>
    </div>
    <div class="text-box">
        <h2><?php echo htmlspecialchars($listing['title']); ?></h2>
        <p class="listing-location"><?php echo htmlspecialchars($listing['city']); ?>, <?php echo htmlspecialchars($listing['country']); ?></p>
        <p class="listing-details">
            <?php echo $listing['room_type'] === 'whole_apartment' ? 'Entire home' : 'Private room'; ?> · 
            <?php echo htmlspecialchars($listing['max_guests'] ?? 0); ?> guests
        </p>
        <div class="listing-description">
            <?php echo nl2br(htmlspecialchars($listing['description'])); ?>
        </div>
    </div>
</section>

<!-- Host Panel -->
<section class="host-panel">
    <div class="host-panel-header">
        <div class="host-avatar">
            <?php if (!empty($listing['host']['profile_picture'])): ?>
                <img src="/<?php echo ltrim($listing['host']['profile_picture'], '/'); ?>" 
                     alt="<?php echo htmlspecialchars($listing['host']['first_name'] ?? 'Host'); ?>">
            <?php else: ?>
                <div class="host-avatar-placeholder">
                    <?php echo getInitials($listing['host']['first_name'] ?? '', $listing['host']['last_name'] ?? ''); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="host-info">
            <span class="host-label">Hosted by</span>
            <h3 class="host-name">
                <a href="<?php echo BASE_URL; ?>/profile/<?php echo htmlspecialchars($listing['host_profile_id']); ?>">
                    <?php echo htmlspecialchars(($listing['host']['first_name'] ?? 'Anonymous') . ' ' . ($listing['host']['last_name'] ?? '')); ?>
                </a>
            </h3>
            
            </div>
        </div>
    </div>
    
    <div class="host-details">
        <?php if (!empty($listing['host']['created_at'])): ?>
        <div class="host-detail-item">
            <span class="host-detail-label">Member since</span>
            <span class="host-detail-value"><?php echo date('M Y', strtotime($listing['host']['created_at'])); ?></span>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="host-actions">
        <a href="<?php echo BASE_URL; ?>/profile/<?php echo htmlspecialchars($listing['host_profile_id']); ?>" class="host-action-btn">
            View Profile
        </a>
        <a href="<?php echo BASE_URL; ?>/chat/<?php echo htmlspecialchars($listing['host_profile_id']); ?>?listing_id=<?php echo htmlspecialchars($listing['id']); ?>" class="host-action-btn primary">
            Contact Host
        </a>
    </div>
</section>

<!-- Amenities & Preferences Section -->
<section class="preferences-box">
    <div class="preferences">
        <h3>Amenities & Rules</h3>
        <p class="subtext">Hover over each item to learn more</p>
    </div>
    
    <?php if (!empty($attributesByCategory)): ?>
        <?php foreach ($attributesByCategory as $category => $attrs): ?>
            <div class="amenities-section">
                <h4 class="amenities-category-title"><?php echo htmlspecialchars($category); ?></h4>
                <div class="amenities-grid">
                    <?php foreach ($attrs as $attr): ?>
                        <div class="amenity-item" 
                             data-tooltip="<?php echo htmlspecialchars($attr['description'] ?? $attr['name'] . ' is available at this property'); ?>">
                            <span class="amenity-icon"><?php echo getAmenityIcon($attr['name']); ?></span>
                            <span class="amenity-name"><?php echo htmlspecialchars($attr['name']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: #666; padding: 20px 0;">No specific amenities listed for this property.</p>
    <?php endif; ?>
</section>

<!-- Services Section -->
<?php if (!empty($listing['services'])): ?>
<section class="preferences-box">
    <div class="preferences">
        <h3>Guest Requirements</h3>
        <p class="subtext">Mandatory services and responsibilities for guests</p>
    </div>
    <div class="amenities-grid" style="margin-top: 16px;">
        <?php foreach ($listing['services'] as $service): ?>
            <div class="service-item" 
                 data-tooltip="<?php echo htmlspecialchars($service['description'] ?? 'Guest is required to handle ' . strtolower($service['name'])); ?>">
                <span class="service-icon"><?php echo getServiceIcon($service['name']); ?></span>
                <span class="service-name"><?php echo htmlspecialchars($service['name']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- Availability Calendar -->
<section class="calendar-card">
    <div class="calendar-header-row">
        <button class="calendar-nav" data-direction="prev" aria-label="Previous month" type="button">‹</button>
        <div class="calendar-month-label"><?php echo date('F Y'); ?></div>
        <button class="calendar-nav" data-direction="next" aria-label="Next month" type="button">›</button>
    </div>
    <div class="listing-calendar">
        <div id="availability-calendar" 
             data-year="<?php echo date('Y'); ?>" 
             data-month="<?php echo date('n'); ?>"
             data-listing-id="<?php echo $listing['id']; ?>">
        </div>
    </div>
    
    <!-- Legend -->
    <div class="availability-legend">
        <div class="legend-item">
            <span class="legend-dot available"></span>
            <span>Available</span>
        </div>
        <div class="legend-item">
            <span class="legend-dot blocked"></span>
            <span>Unavailable</span>
        </div>
        <div class="legend-item">
            <span class="legend-dot selected"></span>
            <span>Selected</span>
        </div>
    </div>
    
    <?php if (!empty($listing['availability'])): ?>
        <div class="availability-info" style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #f0f0f0; font-size: 0.9em; color: #666;">
            <strong>Available periods:</strong><br>
            <?php foreach ($listing['availability'] as $period): ?>
                <?php 
                    $from = date('M j, Y', strtotime($period['available_from']));
                    $until = $period['available_until'] ? date('M j, Y', strtotime($period['available_until'])) : 'Ongoing';
                    echo "📅 {$from} – {$until}<br>";
                ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<!-- Action Buttons -->
<section class="container">
    <div class="div-button">
        <?php 
        $currentUser = Session::getUser();
        $userProfileId = $currentUser['profile_id'] ?? null;
        $isOwner = $userProfileId && $userProfileId === $listing['host_profile_id'];
        $applyUrl = BASE_URL . '/listings/' . $listing['id'] . '/apply';
        ?>

        <?php if (!$isOwner): ?>
            <a class="listing" href="<?php echo htmlspecialchars($applyUrl, ENT_QUOTES, 'UTF-8'); ?>">Apply for listing</a>
        <?php else: ?>
             <button class="listing" style="background: #ccc; cursor: default;" disabled>You own this listing</button>
        <?php endif; ?>
    </div>
</section>

<?php
$listingConfig = [
    'availability' => $listing['availability'] ?? [],
    'applyUrl' => $applyUrl,
];
?>
<script id="listing-config" type="application/json">
<?php echo json_encode($listingConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>
</script>
<script src="/js/listing.js" defer></script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
