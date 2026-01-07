<?php
require_once __DIR__ . '/../../models/user.php';

$pageTitle = 'Manage Users';
$breadcrumbs = [
    'Home' => '/NestChange/public/home',
    'Admin' => '/NestChange/public/admin',
    'Users' => '/NestChange/public/admin/users'
];

require __DIR__ . '/admin_layout.php';
?>

<div class="panel-box" style="background:#fff; padding:20px; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h1 style="margin:0; font-size:1.5rem; color:#2c3e50;">User Management</h1>
        <!-- Search or Filter could go here -->
    </div>

    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; font-weight: 600; color: #555; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; }
        .badge-approved { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-suspended { background: #f8d7da; color: #721c24; }
        
        .btn-action { padding: 5px 10px; border-radius: 4px; border:none; cursor: pointer; font-size: 0.85rem; color: white; transition: opacity 0.2s; }
        .btn-action:hover { opacity: 0.9; }
        .btn-approve { background: #27ae60; }
        .btn-suspend { background: #f39c12; }
        .btn-delete { background: #e74c3c; }
    </style>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userModel = new User();
            $users = $userModel->search('', 100); 
            ?>
            
            <?php if (empty($users)): ?>
                <tr><td colspan="5" style="text-align:center; padding:30px; color:#777;">No users found.</td></tr>
            <?php else: ?>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td>#<?= $u['id'] ?></td>
                    <td>
                        <div style="font-weight:bold"><?= htmlspecialchars(($u['first_name'] ?? 'Unknown') . " " . ($u['last_name'] ?? '')) ?></div>
                        <div style="font-size:0.85rem; color:#888;"><?= htmlspecialchars($u['email']) ?></div>
                    </td>
                    <td style="text-transform: capitalize;"><?= htmlspecialchars($u['role']) ?></td>
                    <td>
                        <span class="badge badge-<?= $u['status'] ?>">
                            <?= ucfirst($u['status']) ?>
                        </span>
                    </td>
                    <td style="white-space:nowrap;">
                        <?php if($u['status'] !== 'approved'): ?>
                            <button class="btn-action btn-approve" onclick="updateStatus(<?= $u['id'] ?>, 'approved')">Approve</button>
                        <?php endif; ?>
                        
                        <?php if($u['status'] !== 'suspended'): ?>
                            <button class="btn-action btn-suspend" onclick="updateStatus(<?= $u['id'] ?>, 'suspended')">Suspend</button>
                        <?php endif; ?>
                        
                        <button class="btn-action btn-delete" onclick="deleteUser(<?= $u['id'] ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    const baseUrl = '/NestChange/public/admin/users';

    function updateStatus(userId, status) {
        let action = status === 'approved' ? 'approve' : 'suspend';
        if(confirm(`Are you sure you want to ${action} this user?`)) {
            fetch(`${baseUrl}/${action}`, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `id=${userId}&status=${status}`
            })
            .then(res => {
                // For demo/simplified usage without backend API implemented completely:
                alert('Action simulated. Reloading...'); 
                location.reload(); 
            });
        }
    }

    function deleteUser(userId) {
        if(confirm('Are you sure you want to PERMANENTLY delete this user? This cannot be undone.')) {
            fetch(`${baseUrl}/delete`, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `id=${userId}`
            })
            .then(res => {
                alert('Action simulated. Reloading...'); 
                location.reload();
            });
        }
    }
</script>

</main>
</div>
</body>
</html>
