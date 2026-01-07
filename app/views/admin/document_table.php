<?php
require_once __DIR__ . '/../../models/user.php';

$pageTitle = 'Verify Documents';
$breadcrumbs = [
    'Home' => '/NestChange/public/home',
    'Admin' => '/NestChange/public/admin',
    'Documents' => '/NestChange/public/admin/documents'
];

require __DIR__ . '/admin_layout.php';

try {
    $userModel = new User();
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['user_id'])) {
    $action = $_POST['action'];
    $userId = $_POST['user_id'];
    
    if ($action === 'approve') {
        $userModel->updateStatus($userId, 'approved');
    } elseif ($action === 'reject') {
        $userModel->updateStatus($userId, 'rejected');
    }
    echo "<script>location.replace(location.href);</script>";
    exit;
}

$documents = $userModel->getAllDocuments();

function getDocType($typeId) {
    return match($typeId) {
        1 => 'ID Proof',
        2 => 'Student ID',
        default => 'Document'
    };
}
?>

<div class="panel-box" style="background:#fff; padding:20px; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
     <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h1 style="margin:0; font-size:1.5rem; color:#2c3e50;">Document Verification</h1>
    </div>

    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; font-weight: 600; color: #555; }
        
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-approved { background: #d4edda; color: #155724; }
        .badge-rejected { background: #f8d7da; color: #721c24; }
        
        .btn-action { padding: 5px 10px; border-radius: 4px; border:none; cursor: pointer; font-size: 0.85rem; color: white; transition: opacity 0.2s; margin-right: 4px; }
        .btn-view { background: #2196F3; }
        .btn-approve { background: #27ae60; }
        .btn-reject { background: #e74c3c; }
    </style>

    <table>
        <thead>
            <tr>
                <th>User Info</th>
                <th>Document Type</th>
                <th>Uploaded</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($documents)): ?>
            <tr><td colspan="5" style="text-align:center; padding:30px; color:#777;">No documents pending verification.</td></tr>
            <?php else: ?>
                <?php foreach ($documents as $doc): ?>
                <tr>
                    <td>
                        <div style="font-weight:bold"><?= htmlspecialchars(($doc['first_name'] ?? '') . ' ' . ($doc['last_name'] ?? '')) ?></div>
                        <div style="font-size:0.85rem; color:#888;"><?= htmlspecialchars($doc['email']) ?></div>
                    </td>
                    <td><?= getDocType($doc['document_type_id']) ?></td>
                    <td><?= date('M d, Y', strtotime($doc['created_at'] ?? 'now')) ?></td>
                    <td>
                        <span class="badge badge-<?= htmlspecialchars($doc['user_status']) ?>">
                            <?= ucfirst(htmlspecialchars($doc['user_status'])) ?>
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <a href="<?= $baseUrl . '/' . ltrim($doc['document_path'], '/') ?>" target="_blank" style="text-decoration:none;">
                            <button type="button" class="btn-action btn-view" title="View Document"><i class="fas fa-eye"></i></button>
                        </a>
                        
                        <?php if ($doc['user_status'] !== 'approved'): ?>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Approve this user?');">
                                <input type="hidden" name="user_id" value="<?= $doc['account_id'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn-action btn-approve" title="Approve"><i class="fas fa-check"></i></button>
                            </form>
                        <?php endif; ?>
                        
                        <?php if ($doc['user_status'] !== 'rejected'): ?>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Reject this user?');">
                                <input type="hidden" name="user_id" value="<?= $doc['account_id'] ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="btn-action btn-reject" title="Reject"><i class="fas fa-times"></i></button>
                            </form>
                        <?php endif; ?>
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
