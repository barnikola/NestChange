<?php
$pageTitle = 'NestChange - User Profile';
$activeNav = '';
$bodyClass = 'dark-page';

$profile = $data['profile'] ?? [];
$listings = $data['listings'] ?? [];
$stats = $data['stats'] ?? ['total_listings' => 0, 'published_listings' => 0];

$fullName = trim(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? ''));
$initials = strtoupper(substr($profile['first_name'] ?? '', 0, 1) . substr($profile['last_name'] ?? '', 0, 1));
$avatar = $profile['profile_picture'] ?? null;
$locationParts = array_filter([$profile['city'] ?? '', $profile['country'] ?? '']);
$location = implode(', ', $locationParts);

$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'User Profile'],
];

ob_start();
?>
<div class="public-banner"></div>

<section class="public-profile-container">
    <div class="public-avatar">
        <?php if ($avatar): ?>
            <img src="/<?php echo ltrim($avatar, '/'); ?>"
                alt="<?php echo htmlspecialchars($fullName ?: 'Host'); ?>">
        <?php else: ?>
            <div class="host-avatar-placeholder">
                <?php echo $initials ?: 'NC'; ?>
            </div>
        <?php endif; ?>
    </div>

    <h1 class="public-name"><?php echo htmlspecialchars($fullName ?: 'Host'); ?></h1>

    <?php if (!empty($profile['email'])): ?>
        <p class="public-username"><?php echo htmlspecialchars($profile['email']); ?></p>
    <?php endif; ?>

    <?php if ($location): ?>
        <p class="public-location"><?php echo htmlspecialchars($location); ?></p>
    <?php endif; ?>

    <div class="public-stats">
        <div>
            <h3><?php echo (int)($stats['total_listings'] ?? 0); ?></h3>
            <p>Listings</p>
        </div>
        <div>
            <h3><?php echo (int)($stats['published_listings'] ?? 0); ?></h3>
            <p>Published</p>
        </div>
    </div>

    <p class="public-bio">
        <?php echo nl2br(htmlspecialchars($profile['bio'] ?? 'This host has not added a bio yet.')); ?>
    </p>

    <h2 class="public-section-title">Listings by <?php echo htmlspecialchars($fullName ?: 'this host'); ?></h2>

    <?php if (!empty($listings)): ?>
        <div class="public-listings">
            <?php foreach ($listings as $listing):
                $image = $listing['primary_image'] ?? null;
                $locationText = trim(($listing['city'] ?? '') . (isset($listing['country']) && $listing['country'] ? ', ' . $listing['country'] : ''));
            ?>
                <div class="public-listing-card">
                    <a href="<?php echo BASE_URL; ?>/listings/<?php echo htmlspecialchars($listing['id']); ?>">
                        <img src="<?php echo $image ? '/' . ltrim($image, '/') : '/assets/listing.jpg'; ?>"
                            alt="<?php echo htmlspecialchars($listing['title'] ?? 'Listing'); ?>">
                        <h4><?php echo htmlspecialchars($listing['title'] ?? 'Listing'); ?></h4>
                    </a>
                    <?php if ($locationText): ?>
                        <p><?php echo htmlspecialchars($locationText); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="public-empty">No listings published by this host yet.</p>
    <?php endif; ?>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
