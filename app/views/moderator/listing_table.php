<?php
// Ensure this file is accessed via the router or with correct paths
if (defined('APP_ROOT')) {
    // We are in routed environment, paths are absolute from root
    require_once APP_ROOT . '/app/models/listing.php';
    $baseUrl = ''; // relative to root
} else {
    // Direct access
    require_once __DIR__ . '/../../models/listing.php';
    $baseUrl = '../../../public';
}

// Instantiate Model with Error Handling
try {
    $listingModel = new Listing();
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Handle Actions
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
    
    // Refresh to show updated status
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

// Fetch Listings
$listings = $listingModel->getAllListings();

// Helper for Status ID/Class
function getStatusClass($status) {
    return match($status) {
        'published' => 'approved',
        'draft', 'paused' => 'pending',
        'archived' => 'rejected',
        default => 'pending'
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moderator - Manage Listings</title>
    <!-- CSS is handled by dashboard inclusion usually, but if standalone: -->
    <?php if (!defined('APP_ROOT')): ?>
    <link rel="stylesheet" href="../../../public/css/panel.css">
    <?php endif; ?>
    <style>
        /* Inline styles for quick consistency if css missing */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; font-weight: 600; }
        .approved { background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 4px; font-size: 0.85em; }
        .pending { background-color: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 4px; font-size: 0.85em; }
        .rejected { background-color: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 4px; font-size: 0.85em; }
        .view-btn { background-color: #3498db; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
        .approve-btn { background-color: #2ecc71; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
        .pause-btn { background-color: #f39c12; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
        .delete-btn { background-color: #e74c3c; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
    </style>
</head>
<body>

    <div class="header-nav" style="margin: 20px;">
        <?php 
            $dashboardLink = defined('APP_ROOT') ? 'dashboard' : 'dashboard.php';
        ?>
        <a href="<?= $dashboardLink ?>" style="text-decoration: none; color: #333;">&larr; Back to Dashboard</a>
    </div>

    <div style="padding: 20px;">
        <h2 style="text-align: center; color: #333;">Moderator Review - Listings</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Host</th>
                    <th>Price/Room</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listings)): ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No listings found.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listings as $list): ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($list['title']) ?></strong><br>
                            <small><?= htmlspecialchars($list['city'] . ', ' . $list['country']) ?></small>
                        </td>
                        <td>
                            <?= htmlspecialchars(($list['first_name'] ?? 'Unknown') . ' ' . ($list['last_name'] ?? '')) ?><br>
                            <small><?= htmlspecialchars($list['host_email'] ?? '') ?></small>
                        </td>
                        <td>
                            $<?= htmlspecialchars($list['price'] ?? 'N/A') ?> <br>
                            <small><?= htmlspecialchars($list['room_type']) ?></small>
                        </td>
                        <td><?= date('d M Y', strtotime($list['created_at'])) ?></td>
                        <td>
                            <span class="<?= getStatusClass($list['status']) ?>">
                                <?= ucfirst(htmlspecialchars($list['status'])) ?>
                            </span>
                        </td>
                        <td class="actions" style="display:flex; gap:5px;">
                            <!-- View Public Listing -->
                            <a href="<?= $baseUrl ?>/listings/<?= $list['id'] ?>" target="_blank" style="text-decoration:none;">
                                <button type="button" class="view-btn">View</button>
                            </a>
                            
                            <!-- Approve (if not published) -->
                            <?php if ($list['status'] !== 'published'): ?>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Publish this listing?');">
                                    <input type="hidden" name="listing_id" value="<?= $list['id'] ?>">
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="approve-btn">Publish</button>
                                </form>
                            <?php endif; ?>
                            
                            <!-- Pause (if published) -->
                            <?php if ($list['status'] === 'published'): ?>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Pause this listing?');">
                                    <input type="hidden" name="listing_id" value="<?= $list['id'] ?>">
                                    <input type="hidden" name="action" value="pause">
                                    <button type="submit" class="pause-btn">Pause</button>
                                </form>
                            <?php endif; ?>

                            <!-- Delete -->
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Permanently delete this listing?');">
                                <input type="hidden" name="listing_id" value="<?= $list['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
