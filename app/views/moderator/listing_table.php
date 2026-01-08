<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moderator - Listing Management</title>
    <link rel="stylesheet" href="/css/theme.css">
    <style>
        table { width: 90%; margin: 40px auto; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        th, td { padding: 15px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; font-weight: 600; }
        .actions button { padding: 6px 14px; margin-right: 5px; cursor: pointer; border: none; border-radius: 4px; font-size: 0.9em; transition: all 0.3s ease; }
        .publish { background: #4CAF50; color: white; }
        .pause { background: #FF9800; color: white; }
        .delete { background: #F44336; color: white; }
        .status { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; }
        .status.published { background: #d4edda; color: #155724; }
        .status.paused { background: #fff3cd; color: #856404; }
        h1 { color: #333; margin-bottom: 30px; }
        .back-link { display: inline-block; margin: 20px 0 0 5%; text-decoration: none; color: #666; }
    </style>
</head>
<body>

<a href="/moderator/dashboard" class="back-link">← Back to Dashboard</a>

<h1 style="text-align:center;">Listing Management</h1>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div style="width: 90%; margin: 20px auto; padding: 15px; border-radius: 4px; 
        background: <?= $_SESSION['flash_type'] === 'success' ? '#d4edda' : ($_SESSION['flash_type'] === 'warning' ? '#fff3cd' : '#f8d7da') ?>; 
        color: <?= $_SESSION['flash_type'] === 'success' ? '#155724' : ($_SESSION['flash_type'] === 'warning' ? '#856404' : '#721c24') ?>; 
        border: 1px solid <?= $_SESSION['flash_type'] === 'success' ? '#c3e6cb' : ($_SESSION['flash_type'] === 'warning' ? '#ffeeba' : '#f5c6cb') ?>;">
        <?= htmlspecialchars($_SESSION['flash_message']) ?>
        <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
    </div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Documents</th>
            <th>Photos</th>
            <th>Host</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($listings)): ?>
        <tr>
            <td colspan="6" style="text-align:center; padding: 30px;">No listings found.</td>
        </tr>
        <?php else: ?>
            <?php foreach ($listings as $listing): ?>
            <tr>
                <td><?= htmlspecialchars($listing['title']) ?></td>
                <td><?= htmlspecialchars($listing['room_type'] ?? 'N/A') ?></td>
                <td>
                    <?php 
                    if (!empty($listing['verification_docs'])) {
                        $docs = explode(',', $listing['verification_docs']);
                        foreach ($docs as $i => $doc) {
                            $num = $i + 1;
                            echo '<a href="/' . ltrim($doc, '/') . '" target="_blank" style="color:#007bff; margin-right:5px;">Doc ' . $num . '</a>';
                        }
                    } else {
                        echo '<span style="color:#999;">None</span>';
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    if (!empty($listing['listing_photos'])) {
                        $photos = explode(',', $listing['listing_photos']);
                        foreach ($photos as $i => $photo) {
                            $num = $i + 1;
                            echo '<a href="/' . ltrim($photo, '/') . '" target="_blank" style="color:#28a745; margin-right:5px;">Img ' . $num . '</a>';
                        }
                    } else {
                        echo '<span style="color:#999;">None</span>';
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars(($listing['first_name'] ?? '') . ' ' . ($listing['last_name'] ?? '')) ?></td>
                <td>
                    <span class="status <?= htmlspecialchars($listing['status']) ?>">
                        <?= ucfirst(htmlspecialchars($listing['status'])) ?>
                    </span>
                </td>
                <td class="actions">
                    <a href="/listings/<?= $listing['id'] ?>/edit" style="text-decoration:none; display:inline-block; padding: 7px 15px; margin-right: 5px; background: #2196F3; color: white; border-radius: 4px; font-size: 0.9em; vertical-align: middle;">Edit</a>

                    <?php if ($listing['status'] !== 'published'): ?>
                    <form action="/moderator/listings/publish" method="POST" style="display:inline;" onsubmit="return confirm('Publish this listing?');">
                        <input type="hidden" name="listing_id" value="<?= $listing['id'] ?>">
                        <button type="submit" class="publish">Publish</button>
                    </form>
                    <?php endif; ?>

                    <?php if ($listing['status'] === 'published'): ?>
                    <form action="/moderator/listings/pause" method="POST" style="display:inline;" onsubmit="return confirm('Pause this listing?');">
                        <input type="hidden" name="listing_id" value="<?= $listing['id'] ?>">
                        <button type="submit" class="pause">Pause</button>
                    </form>
                    <?php endif; ?>
                    
                    <form action="/moderator/listings/delete" method="POST" style="display:inline;" onsubmit="return confirm('Delete this listing?');">
                        <input type="hidden" name="listing_id" value="<?= $listing['id'] ?>">
                        <button type="submit" class="delete">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>