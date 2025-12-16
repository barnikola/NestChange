<?php
require_once __DIR__ . '/../../models/user.php';

// Determine if running through router or direct
$isRouted = defined('APP_ROOT');
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = rtrim(str_replace('\\', '/', $scriptDir), '/');

if ($isRouted) {
    // Via Router (e.g. /NestChange/public/admin/users) -> script is index.php in public
    $cssPath = $scriptDir . '/css/panel.css';
} else {
    // Direct -> script is user_table.php in views/admin
    $cssPath = '../../../public/css/panel.css';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="<?= $cssPath ?>">
    <style>
        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f5f5f5;
        }
        .actions button {
            padding: 5px 12px;
            margin-right: 5px;
            cursor: pointer;
        }
        .approve { background: #4CAF50; color: white; }
        .block { background: #ff9800; color: white; }
        .delete { background: #f44336; color: white; }
    </style>
</head>
<body>

<h1 style="text-align:center; margin-top:30px;">User Management</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

<?php
$userModel = new User();
$users = $userModel->search('', 100); // Fetch up to 100 users with profile info
?>

    <?php if (empty($users)): ?>
    <tr>
        <td colspan="5" style="text-align:center;">No users found.</td>
    </tr>
    <?php else: ?>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars(($u['first_name'] ?? '') . " " . ($u['last_name'] ?? '')) ?></td>
            <td><?= htmlspecialchars($u['status']) ?></td>

            <td class="actions">
                <button class="approve" onclick="updateStatus(<?= $u['id'] ?>, 'approved')">Approve</button>
                <button class="block" onclick="updateStatus(<?= $u['id'] ?>, 'suspended')">Block</button>
                <button class="delete" onclick="deleteUser(<?= $u['id'] ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>


<script>
    function updateStatus(userId, status) {
        if(confirm('Are you sure you want to change the status to ' + status + '?')) {
            // TODO: Implement AJAX call to update status
            // Example:
            // fetch('/admin/users/status', {
            //     method: 'POST',
            //     headers: {'Content-Type': 'application/json'},
            //     body: JSON.stringify({id: userId, status: status})
            // }).then(...)
            alert('Update status feature not implemented yet.');
        }
    }

    function deleteUser(userId) {
        if(confirm('Are you sure you want to delete this user?')) {
            // TODO: Implement AJAX call to delete user
            alert('Delete user feature not implemented yet.');
        }
    }
</script>
</body>
</html>
