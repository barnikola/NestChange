<?php
// Ensure this file is accessed via the router or with correct paths
if (defined('APP_ROOT')) {
    require_once APP_ROOT . '/app/models/listing.php';
} else {
    require_once __DIR__ . '/../../models/listing.php';
    // Fallback for direct access if needed (not recommended with layout)
}

$pageTitle = 'Manage Listings';
$breadcrumbs = [
    'Home' => '/NestChange/public/home',
    'Admin' => '/NestChange/public/admin',
    'Listings' => '/NestChange/public/admin/listings'
];

require __DIR__ . '/admin_layout.php';

// Instantiate Model
try {
    $listingModel = new Listing();
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Handle Actions (approve, pause, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['listing_id'])) {
    $action = $_POST['action'];
    $listingId = $_POST['listing_id'];
    
    if ($action === 'approve') {
        $listingModel->publish($listingId);
    } elseif ($action === 'pause') {
        $listingModel->pause($listingId);
    } elseif ($action === 'delete') {
        $listingModel->delete($listingId);
    }
    // Refresh
    echo "<script>location.replace(location.href);</script>";
    exit;
}

$listings = $listingModel->getAllListings();

function getStatusClass($status) {
    return match($status) {
        'published' => 'approved',
        'draft', 'paused' => 'pending',
        'archived' => 'rejected',
        default => 'pending'
    };
}
?>

<div class="panel-box" style="background:#fff; padding:20px; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h1 style="margin:0; font-size:1.5rem; color:#2c3e50;">Manage Listings</h1>
    </div>

    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; font-weight: 600; color: #555; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; }
        .badge-approved { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-rejected { background: #f8d7da; color: #721c24; }
        
        .btn-action { padding: 5px 10px; border-radius: 4px; border:none; cursor: pointer; font-size: 0.85rem; color: white; transition: opacity 0.2s; margin-right: 4px; }
        .btn-view { background: #3498db; }
        .btn-approve { background: #27ae60; }
        .btn-pause { background: #f39c12; }
        .btn-delete { background: #e74c3c; }
    </style>

    <table>
        <thead>
            <tr>
                <th>Title & Location</th>
                <th>Host</th>
                <th>Price / Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($listings)): ?>
                <tr><td colspan="5" style="text-align:center; padding:30px; color:#777;">No listings found.</td></tr>
            <?php else: ?>
                <?php foreach ($listings as $list): ?>
                <tr>
                    <td>
                        <div style="font-weight:bold"><?= htmlspecialchars($list['title']) ?></div>
                        <div style="font-size:0.85rem; color:#888;">
                            <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($list['city'] . ', ' . $list['country']) ?>
                            <div style="color:#aaa; font-size:0.8em;"><?= date('M d, Y', strtotime($list['created_at'])) ?></div>
                        </div>
                    </td>
                    <td>
                        <?= htmlspecialchars(($list['first_name'] ?? 'Unknown') . ' ' . ($list['last_name'] ?? '')) ?><br>
                        <small style="color:#888;"><?= htmlspecialchars($list['host_email'] ?? '') ?></small>
                    </td>
                    <td>
                        <?= isset($list['price']) ? '$' . htmlspecialchars($list['price']) : 'N/A' ?> <br>
                        <small style="color:#666;"><?= htmlspecialchars($list['room_type']) ?></small>
                    </td>
                    <td>
                        <span class="badge badge-<?= getStatusClass($list['status']) ?>">
                            <?= ucfirst(htmlspecialchars($list['status'])) ?>
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                         <a href="<?= $baseUrl ?>/listings/<?= $list['id'] ?>" target="_blank" style="text-decoration:none;">
                            <button type="button" class="btn-action btn-view" title="View Listing"><i class="fas fa-eye"></i></button>
                        </a>
                        
                        <?php if ($list['status'] !== 'published'): ?>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Publish this listing?');">
                                <input type="hidden" name="listing_id" value="<?= $list['id'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn-action btn-approve" title="Publish"><i class="fas fa-check"></i></button>
                            </form>
                        <?php endif; ?>
                        
                        <?php if ($list['status'] === 'published'): ?>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Pause this listing?');">
                                <input type="hidden" name="listing_id" value="<?= $list['id'] ?>">
                                <input type="hidden" name="action" value="pause">
                                <button type="submit" class="btn-action btn-pause" title="Pause"><i class="fas fa-pause"></i></button>
                            </form>
                        <?php endif; ?>

                        <form method="POST" style="display:inline;" onsubmit="return confirm('Permanently delete this listing?');">
                            <input type="hidden" name="listing_id" value="<?= $list['id'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn-action btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</main>
</div>
</body>
</html>
