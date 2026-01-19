<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moderator - Document Verification</title>
    <link rel="stylesheet" href="/css/theme.css">
    <style>
        table { width: 90%; margin: 40px auto; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        th, td { padding: 15px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; font-weight: 600; }
        .actions button { padding: 6px 14px; margin-right: 5px; cursor: pointer; border: none; border-radius: 4px; font-size: 0.9em; transition: all 0.3s ease; }
        .view-btn { background: #2196F3; color: white; }
        .approve { background: #4CAF50; color: white; }
        .reject { background: #f44336; color: white; }
        .actions button:hover { opacity: 0.9; transform: translateY(-1px); }
        .status { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; }
        .status.active { background: #d4edda; color: #155724; }
        .status.approved { background: #d4edda; color: #155724; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.rejected { background: #f8d7da; color: #721c24; }
        h1 { color: #333; margin-bottom: 30px; }
        .back-link { display: inline-block; margin: 20px 0 0 5%; text-decoration: none; color: #666; }
    </style>
</head>
<body>

<a href="/moderator/dashboard" class="back-link">← Back to Dashboard</a>

<h1 style="text-align:center;">Document Verification</h1>

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
            <th>User</th>
            <th>Email</th>
            <th>Document Type</th>
            <th>Uploaded Date</th>
            <th>Document Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($documents)): ?>
        <tr>
            <td colspan="6" style="text-align:center; padding: 30px;">No documents found.</td>
        </tr>
        <?php else: ?>
            <?php foreach ($documents as $doc): ?>
            <tr>
                <td><?= htmlspecialchars(($doc['first_name'] ?? '') . ' ' . ($doc['last_name'] ?? '')) ?></td>
                <td><?= htmlspecialchars($doc['email']) ?></td>
                <td>
                    <?php
                    echo match($doc['document_type_id']) {
                        1 => 'ID Proof',
                        2 => 'Student ID',
                        default => 'Document'
                    };
                    ?>
                </td>
                <td><?= date('d M Y', strtotime($doc['created_at'] ?? 'now')) ?></td>
                <td>
                    <?php 
                        $status = $doc['document_status'] ?? 'pending'; 
                        $statusClass = match($status) {
                            'approved' => 'approved',
                            'rejected' => 'rejected',
                            default => 'pending'
                        };
                    ?>
                    <span class="status <?= $statusClass ?>">
                        <?= ucfirst(htmlspecialchars($status)) ?>
                    </span>
                </td>
                <td class="actions" style="display:flex; gap:5px;">
                    <a href="/<?= ltrim($doc['document_path'] ?? '#', '/') ?>" target="_blank" style="text-decoration:none;">
                        <button type="button" class="view-btn">View</button>
                    </a>
                    
                    <?php if (($doc['document_status'] ?? 'pending') !== 'approved'): ?>
                    <form action="/moderator/documents/approve" method="POST" style="display:inline;" onsubmit="return confirm('Approve this document?');">
                        <input type="hidden" name="csrf_token" value="<?= Session::getCsrfToken() ?>">
                        <input type="hidden" name="document_id" value="<?= $doc['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $doc['account_id'] ?>">
                        <input type="hidden" name="action" value="approve">
                        <button type="submit" class="approve">Approve</button>
                    </form>
                    <?php endif; ?>
                    
                    <?php if (($doc['document_status'] ?? 'pending') !== 'rejected'): ?>
                    <form action="/moderator/documents/approve" method="POST" style="display:inline;" onsubmit="return confirm('Reject this document?');">
                        <input type="hidden" name="csrf_token" value="<?= Session::getCsrfToken() ?>">
                        <input type="hidden" name="document_id" value="<?= $doc['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $doc['account_id'] ?>">
                        <input type="hidden" name="action" value="reject">
                        <button type="submit" class="reject">Reject</button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
