<?php
require_once dirname(__DIR__, 2) . '/helpers/CancellationPolicyHelper.php';
$pageTitle = 'NestChange - ' . htmlspecialchars($listing['title'] ?? 'Listing Details');
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Listings', 'url' => '/listings'],
    ['label' => htmlspecialchars($listing['title'] ?? 'Listing')],
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

$hasMapCoordinates = isset($listing['latitude'], $listing['longitude']) &&
    $listing['latitude'] !== null &&
    $listing['longitude'] !== null &&
    $listing['latitude'] !== '' &&
    $listing['longitude'] !== '';

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

function renderStarRating(float $rating, int $max = 5): string {
    $rating = max(0, min($max, $rating));
    $output = '';
    for ($i = 1; $i <= $max; $i++) {
        $output .= '<span class="star ' . ($rating >= $i ? 'filled' : '') . '">★</span>';
    }
    return '<div class="star-display" data-rating="' . htmlspecialchars(number_format($rating, 1, '.', ''), ENT_QUOTES, 'UTF-8') . '" data-max="' . $max . '">' . $output . '</div>';
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
$reviewForm = array_merge([
    'eligible' => false,
    'booking_id' => null,
    'role' => null,
    'message' => 'Book and complete an exchange to review this listing.',
    'csrf_token' => Session::getCsrfToken(),
], $reviewForm ?? []);
$reviews = $listingReviews ?? [];
$reviewCount = count($reviews);
$averageRating = $reviewCount > 0
    ? round(array_sum(array_map(fn($review) => (int) ($review['rating'] ?? 0), $reviews)) / $reviewCount, 1)
    : null;
?>
<!-- Listing Status Banner for Owner/Admin/Moderator -->
<?php 
$currentUser = Session::getUser();
$userProfileId = $currentUser['profile_id'] ?? null;
$isOwner = $userProfileId && $userProfileId === $listing['host_profile_id'];
$canViewStatus = $isOwner || AuthMiddleware::hasAnyRole(['admin', 'moderator']);
?>

<?php if ($canViewStatus): ?>
    <div style="background: #e3f2fd; color: #0d47a1; padding: 15px; text-align: center; border-bottom: 1px solid #bbdefb; margin-bottom: 20px; font-size: 16px;">
        Listing Status: <span style="text-transform: uppercase; font-weight: 700; color: #1565c0;"><?= htmlspecialchars($listing['status']) ?></span>
    </div>
<?php endif; ?>

<!-- Listing Header with Carousel -->
<section class="holder">
    <div class="listing-carousel">
        <button class="carousel-control prev" type="button" aria-label="Previous photo">‹</button>
        <div class="carousel-track">
            <?php if (!empty($listing['images'])): ?>
                <?php foreach ($listing['images'] as $index => $img): ?>
                    <img
                        src="/<?php echo htmlspecialchars(ltrim($img['image'], '/')); ?>"
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
                <img src="/<?php echo htmlspecialchars(ltrim($listing['host']['profile_picture'], '/')); ?>" 
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
            <!-- Report Button for Listing -->
            <?php if (Session::isLoggedIn()): ?>
                <button onclick="openReportModal('listing', '<?php echo htmlspecialchars($listing['id']); ?>')" style="margin-top:8px;" class="btn-report">Report Listing</button>
            <?php endif; ?>
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
        <a href="<?php echo BASE_URL; ?>/chat" class="host-action-btn primary">
            Contact Host
        </a>
    </div>
</section>

<?php if ($hasMapCoordinates): ?>
<section class="listing-map-section">
    <div class="listing-map-header">
        <div>
            <h3>Explore the area</h3>
            <p>
                <?php
                $locationParts = array_filter([
                    $listing['city'] ?? null,
                    $listing['country'] ?? null,
                ]);
                echo htmlspecialchars(!empty($locationParts) ? implode(', ', $locationParts) : 'Location shared after booking');
                ?>
            </p>
        </div>
        <span class="map-helper-text">Exact location shared after booking.</span>
    </div>
    <div class="listing-map-wrapper">
        <div id="listing-map" role="presentation" aria-hidden="true"></div>
    </div>
</section>
<?php endif; ?>

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
</section>
<?php endif; ?>

<!-- Cancellation Policy -->
<section class="preferences-box">
    <div class="preferences">
        <h3>Cancellation Policy</h3>
        <p class="subtext">Review the cancellation rules for this booking</p>
    </div>
    <div class="row" style="padding: 0 15px;">
        <div class="col-12">
            <p><strong><?= htmlspecialchars(CancellationPolicyHelper::getLabel($listing['cancellation_policy'] ?? 'flexible')) ?>:</strong> <?= htmlspecialchars(CancellationPolicyHelper::getDescription($listing['cancellation_policy'] ?? 'flexible')) ?></p>
            <ul class="text-muted small" style="margin-top: 10px; padding-left: 20px;">
                <?php foreach (CancellationPolicyHelper::getDetails($listing['cancellation_policy'] ?? 'flexible') as $detail): ?>
                    <li><?= htmlspecialchars($detail) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

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
            <?php if (AuthMiddleware::hasAnyRole(['admin', 'moderator'])): ?>
                <button class="listing" onclick="window.location.href='/listings/<?php echo $listing['id']; ?>/edit'" style="background: #2196F3;">Edit Listing (Mod)</button>
                <?php if ($listing['status'] === 'draft'): ?>
                    <form method="POST" action="/listings/<?php echo $listing['id']; ?>/publish" style="display:inline; margin-left:10px;">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(Session::getCsrfToken()); ?>">
                        <button type="submit" class="listing" style="background: #4CAF50; color: #fff;">Publish Listing</button>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <?php if (!empty($activeApplicationId)): ?>
                    <a href="/applications/<?php echo $activeApplicationId; ?>" class="listing" id="view-application-btn" style="display: block; text-align: center; text-decoration: none; background-color: #2196F3;">View Application</a>
                <?php else: ?>
                    <a href="/listings/<?php echo $listing['id']; ?>/apply" class="listing" id="apply-listing-btn" style="display: block; text-align: center; text-decoration: none;">Apply for listing</a>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <button class="listing" onclick="window.location.href='/listings/<?php echo $listing['id']; ?>/edit'">Edit Listing</button>
            <?php if (AuthMiddleware::hasAnyRole(['admin', 'moderator']) && $listing['status'] === 'draft'): ?>
                <form method="POST" action="/listings/<?php echo $listing['id']; ?>/publish" style="display:inline; margin-left:10px;">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(Session::getCsrfToken()); ?>">
                    <button type="submit" class="listing" style="background: #4CAF50; color: #fff;">Publish Listing</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Reviews Section -->
<section class="review-section" id="listing-reviews">
    <div class="review-section-header">
        <h3>Reviews & Ratings</h3>
        <?php if ($averageRating !== null): ?>
            <div class="review-summary">
                <div class="review-score">
                    <?php echo htmlspecialchars($averageRating); ?>
                    <span>out of 5</span>
                </div>
                <div class="star-row" aria-label="Average rating <?php echo htmlspecialchars($averageRating); ?> out of 5">
                    <?php echo renderStarRating($averageRating); ?>
                    <span class="review-count"><?php echo $reviewCount; ?> review<?php echo $reviewCount === 1 ? '' : 's'; ?></span>
                </div>
            </div>
        <?php else: ?>
            <p class="review-hint">No reviews yet. Be the first guest to share feedback.</p>
        <?php endif; ?>
    </div>

    <?php if ($reviewCount > 0): ?>
        <div class="review-list">
            <?php foreach ($reviews as $review): ?>
                <article class="review-card">
                    <div class="review-card-header">
                        <div>
                            <p class="reviewer-name">
                                <?php if (!empty($review['reviewer_profile_id'])): ?>
                                    <a href="<?php echo BASE_URL; ?>/profile/<?php echo htmlspecialchars($review['reviewer_profile_id']); ?>">
                                        <?php echo htmlspecialchars($review['reviewer_name'] ?: 'Guest'); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($review['reviewer_name'] ?: 'Guest'); ?>
                                <?php endif; ?>
                            </p>
                            <div class="star-row" aria-label="Rated <?php echo (int) $review['rating']; ?> out of 5">
                                <?php echo renderStarRating((float) ($review['rating'] ?? 0)); ?>
                                <span class="review-date">
                                    <?php echo htmlspecialchars($review['reviewed_at'] ?? ''); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($review['review'])): ?>
                        <p class="review-text"><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
                    <?php else: ?>
                        <p class="review-text muted">No written comment.</p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="review-section-header">
        <h4>Share your experience</h4>
        <p class="review-hint"><?php echo htmlspecialchars($reviewForm['message']); ?></p>
    </div>

    <?php if (!empty($reviewForm['eligible']) && !empty($reviewForm['booking_id'])): ?>
        <form method="POST"
              action="<?php echo BASE_URL; ?>/bookings/<?php echo htmlspecialchars($reviewForm['booking_id']); ?>/reviews"
              class="review-form">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($reviewForm['csrf_token']); ?>">

            <div class="review-rating">
                <div class="review-label">Overall rating</div>
                <div class="star-input" role="radiogroup" aria-label="Select a star rating">
                    <?php for ($star = 5; $star >= 1; $star--): ?>
                        <input type="radio"
                               id="review-star-<?php echo $star; ?>"
                               name="rating"
                               value="<?php echo $star; ?>"
                               <?php echo $star === 5 ? 'required' : ''; ?>>
                        <label for="review-star-<?php echo $star; ?>" title="<?php echo $star; ?> star<?php echo $star > 1 ? 's' : ''; ?>">★</label>
                    <?php endfor; ?>
                </div>
            </div>

            <label class="review-field" for="review-text">
                <span class="review-label">Tell us about your stay (optional)</span>
                <textarea id="review-text"
                          name="review"
                          rows="4"
                          maxlength="2000"
                          placeholder="Highlights, host communication, anything future guests should know."></textarea>
            </label>

            <small class="review-note">Your review helps other students decide if this place is right for them.</small>

            <button type="submit" class="review-submit">
                Submit review
            </button>
        </form>
    <?php endif; ?>
</section>

<?php
$listingConfig = [
    'availability' => $listing['availability'] ?? [],
    'applyUrl' => $applyUrl,
    'map' => $hasMapCoordinates ? [
        'lat' => (float)$listing['latitude'],
        'lng' => (float)$listing['longitude'],
        'title' => $listing['title'] ?? 'Listing',
        'city' => $listing['city'] ?? '',
    ] : null,
];
?>
<script id="listing-config" type="application/json">
<?php echo json_encode($listingConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>
</script>
<script src="/js/listing.js?v=<?= time() ?>" defer></script>
<script src="/js/favorites.js?v=<?= time() ?>" defer></script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
