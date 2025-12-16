<?php
require_once __DIR__ . '/../../models/user.php';

// Determine if running through router or direct
$isRouted = defined('APP_ROOT');
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = rtrim(str_replace('\\', '/', $scriptDir), '/');

if ($isRouted) {
    // Via Router
    $cssPath = $scriptDir . '/css/panel.css';
    $baseUrl = $scriptDir;
} else {
    // Direct
    $cssPath = '../../../public/css/panel.css';
    $baseUrl = '../../../public';
}

// DEBUG: Remove after fixing
// echo "<!-- Debug Info: \n";
// echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
// echo "Script Dir: " . dirname($_SERVER['SCRIPT_NAME']) . "\n";
// echo "Calculated BaseUrl: " . $baseUrl . "\n";
// echo "-->";

// Instantiate Model with Error Handling
try {
    $userModel = new User();
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['user_id'])) {
    $action = $_POST['action'];
    $userId = $_POST['user_id'];
    
    if ($action === 'approve') {
        $userModel->updateStatus($userId, 'approved');
    } elseif ($action === 'reject') {
        $userModel->updateStatus($userId, 'rejected');
    }
    
    // Refresh to show updated status
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

$documents = $userModel->getAllDocuments();

// Helper to map document types
function getDocType($typeId) {
    return match($typeId) {
        1 => 'ID Proof',
        2 => 'Student ID',
        default => 'Has Document'
    };
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Documents</title>
    <link rel="stylesheet" href="<?= $cssPath ?>">
    <style>
        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #f5f5f5;
            font-weight: 600;
        }
        .actions button {
            padding: 6px 14px;
            margin-right: 5px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }
        .view-btn { background: #2196F3; color: white; }
        .approve { background: #4CAF50; color: white; }
        .reject { background: #f44336; color: white; }
        
        .actions button:hover { opacity: 0.9; transform: translateY(-1px); }
        
        .status { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.approved { background: #d4edda; color: #155724; }
        .status.rejected { background: #f8d7da; color: #721c24; }
        
        h1 { color: #333; margin-bottom: 30px; }
        .back-link { display: inline-block; margin: 20px 0 0 5%; text-decoration: none; color: #666; }
    </style>
</head>
<body>

<?php 
    $dashboardLink = defined('APP_ROOT') ? 'dashboard' : 'dashboard.php';
?>
<a href="<?= $dashboardLink ?>" class="back-link">← Back to Dashboard</a>
<h1 style="text-align:center;">Document Verification</h1>

<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Document Type</th>
            <th>Uploaded Date</th> <!-- Currently using Account Created Date as proxy -->
            <th>User Status</th>
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
                <td><?= getDocType($doc['document_type_id']) ?></td>
                <td><?= date('d M Y', strtotime($doc['created_at'] ?? 'now')) ?></td> <!-- Fallback if no timestamp on doc -->
                <td>
                    <span class="status <?= htmlspecialchars($doc['user_status']) ?>">
                        <?= ucfirst(htmlspecialchars($doc['user_status'])) ?>
                    </span>
                </td>
                <td class="actions" style="display:flex; gap:5px;">
// DEBUG: commented out
                    // echo "<!-- BaseUrl: $baseUrl -->";
                    ?>
                    <a href="../../<?= ltrim($doc['document_path'], '/') ?>" target="_blank" style="text-decoration:none;">
                        <button type="button" class="view-btn">View</button>
                    </a>
                    
                    <?php if ($doc['user_status'] !== 'approved'): ?>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Approve this user?');">
                            <input type="hidden" name="user_id" value="<?= $doc['account_id'] ?>">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="approve">Approve</button>
                        </form>
                    <?php endif; ?>
                    
                    <?php if ($doc['user_status'] !== 'rejected'): ?>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Reject this user?');">
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
