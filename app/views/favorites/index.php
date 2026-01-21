<?php
$pageTitle = 'My Favorites - NestChange';
$activeNav = 'favorites';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Favorites'],
];
$extraHead = '<link rel="stylesheet" href="' . rtrim(BASE_URL, '/') . '/css/listings.css">';

ob_start();
?>
<section class="favorites-section" style="padding: 40px 20px; max-width: 1200px; margin: 0 auto;">
    <div class="favorites-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 28px; font-weight: 600; color: #222; margin-bottom: 8px;">
            ❤️ My Favorites
        </h1>
        <p id="favorites-count" style="color: #666; font-size: 15px;">
            <?php if (!empty($favorites)): ?>
                You have <?= count($favorites) ?> saved listing<?= count($favorites) !== 1 ? 's' : '' ?>
            <?php else: ?>
                Save listings you love to find them easily later
            <?php endif; ?>
        </p>
    </div>

    <div id="empty-favorites" class="empty-favorites" style="text-align: center; padding: 80px 20px; background: #f9f9f9; border-radius: 16px; <?= empty($favorites) ? '' : 'display: none;' ?>">
            <div style="font-size: 64px; margin-bottom: 20px;">💔</div>
            <h2 style="font-size: 22px; color: #333; margin-bottom: 12px;">No favorites yet</h2>
            <p style="color: #666; font-size: 15px; max-width: 400px; margin: 0 auto 24px;">
                Start exploring listings and click the heart icon to save your favorites for later.
            </p>
            <a href="<?= BASE_URL ?>/listings" 
               style="display: inline-block; background: #222; color: #fff; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background 0.2s;">
                Browse Listings
            </a>
        </div>
    <div id="favorites-grid" class="favorites-grid" style="display: <?= !empty($favorites) ? 'grid' : 'none' ?>; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <?php if (!empty($favorites)): ?>
            <?php foreach ($favorites as $listing): ?>
                <article class="favorite-card" style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s;">
                    <div class="favorite-image" style="position: relative; height: 200px; overflow: hidden;">
                        <?php if (!empty($listing['primary_image'])): ?>
                            <img src="/<?= ltrim($listing['primary_image'], '/') ?>" 
                                 alt="<?= htmlspecialchars($listing['title']) ?>"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <img src="/assets/listing.jpg" 
                                 alt="<?= htmlspecialchars($listing['title']) ?>"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        <?php endif; ?>
                        
                        <button class="btn-favorite favorited" 
                                onclick="event.preventDefault(); toggleFavorite(this, '<?= $listing['id'] ?>')"
                                data-listing-id="<?= $listing['id'] ?>"
                                style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.95); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; font-size: 20px; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
                            ❤️
                        </button>
                    </div>
                    
                    <a href="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>" style="text-decoration: none; color: inherit;">
                        <div class="favorite-content" style="padding: 20px;">
                            <p class="favorite-type" style="font-size: 13px; color: #666; margin-bottom: 4px;">
                                <?= $listing['room_type'] === 'whole_apartment' ? 'Entire home' : 'Private room' ?> 
                                in <?= htmlspecialchars($listing['city']) ?>
                            </p>
                            <h3 class="favorite-title" style="font-size: 18px; font-weight: 600; color: #222; margin-bottom: 8px; line-height: 1.3;">
                                <?= htmlspecialchars($listing['title']) ?>
                            </h3>
                            <?php if (!empty($listing['address_line'])): ?>
                                <p class="favorite-address" style="font-size: 14px; color: #888; margin-bottom: 12px;">
                                    📍 <?= htmlspecialchars($listing['address_line']) ?>, <?= htmlspecialchars($listing['city']) ?>
                                </p>
                            <?php endif; ?>
                            <div class="favorite-meta" style="display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid #f0f0f0;">
                                <span style="font-size: 13px; color: #666;">
                                    <?php if (!empty($listing['max_guests'])): ?>
                                        👤 <?= $listing['max_guests'] ?> guest<?= $listing['max_guests'] !== 1 ? 's' : '' ?>
                                    <?php endif; ?>
                                </span>
                                <span style="font-size: 13px; color: #1f8a4c; font-weight: 500;">
                                    View Details →
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
</section>

<style>
    .favorite-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    
    .btn-favorite:hover {
        transform: scale(1.1);
    }
    
    @media (max-width: 600px) {
        .favorites-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script id="favorites-config" type="application/json">
<?php
echo json_encode([
    'baseUrl' => rtrim(BASE_URL, '/')
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
?>
</script>
<script src="<?= rtrim(BASE_URL, '/') ?>/js/favorites.js?v=<?= time() ?>"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
