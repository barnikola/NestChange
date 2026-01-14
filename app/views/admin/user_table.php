<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="/css/theme.css">
    <style>
        table { width: 90%; margin: 40px auto; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        th, td { padding: 15px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; font-weight: 600; }
        .actions button { padding: 6px 14px; margin-right: 5px; cursor: pointer; border: none; border-radius: 4px; font-size: 0.9em; transition: all 0.3s ease; }
        .edit { background: #FFC107; color: #333; }
        .delete { background: #F44336; color: white; }
        .status { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; }
        .status.active { background: #d4edda; color: #155724; }
        .status.approved { background: #d4edda; color: #155724; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.suspended { background: #f8d7da; color: #721c24; }
        h1 { color: #333; margin-bottom: 30px; }
        .back-link { display: inline-block; margin: 20px 0 0 5%; text-decoration: none; color: #666; }
        .search-container { width: 90%; margin: 20px auto; display: flex; justify-content: flex-end; }
        .search-form { display: flex; gap: 10px; align-items: center; }
        .search-input { padding: 8px; width: 200px; border: 1px solid #ddd; border-radius: 4px; height: 36px; box-sizing: border-box; }
        .search-btn { padding: 0 20px; background: #333; color: #fff; border: none; border-radius: 4px; cursor: pointer; height: 36px; box-sizing: border-box; font-size: 0.9em; }

        .mobile-label { display: none; }
        @media screen and (max-width: 768px) {
            table, tbody, th, td, tr {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
            thead {
                display: none;
            }

            tr {
                border: 1px solid #cccccc;
                margin-bottom: 15px;
                border-radius: 8px;
            }

            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: none;
                border-bottom: 1px solid #eee;
                padding: 12px 15px;
                text-align: right;
            }

            td:before {
                content: none; 
                display: none;
            }
            .mobile-label {
                display: inline-block;
                font-weight: 600;
                color: #555;
                margin-right: auto;
            }

            .search-container { justify-content: center; }
            .search-input { width: 100%; }
            
        }
    </style>
</head>
<body>

<a href="/admin/dashboard" class="back-link">← Back to Dashboard</a>

<div class="search-container">
    <form action="/admin/users" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search users..." class="search-input" value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit" class="search-btn">Search</button>
    </form>
</div>

<h1 style="text-align:center;">User Management</h1>

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
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($users)): ?>
        <tr>
            <td colspan="6" style="text-align:center; padding: 30px;">No users found.</td>
        </tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><span class="mobile-label">ID:</span> <?= htmlspecialchars($user['id']) ?></td>
                <td><span class="mobile-label">Name:</span> <?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?></td>
                <td><span class="mobile-label">Email:</span> <?= htmlspecialchars($user['email']) ?></td>
                <td><span class="mobile-label">Role:</span> <?= ucfirst(htmlspecialchars($user['role'])) ?></td>
                <td>
                    <span class="mobile-label">Status:</span>
                    <span class="status <?= htmlspecialchars($user['status']) ?>">
                        <?= ucfirst(htmlspecialchars($user['status'])) ?>
                    </span>
                </td>
                <td class="actions">
                    <span class="mobile-label">Actions:</span>
                    <?php if ($user['status'] !== 'approved'): ?>
                    <form action="/admin/users/approve" method="POST" style="display:inline;" onsubmit="return confirm('Approve this user?');">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit" style="background:#4CAF50; color:white;">Approve</button>
                    </form>
                    <?php endif; ?>

                    <?php if ($user['status'] !== 'suspended'): ?>
                    <form action="/admin/users/suspend" method="POST" style="display:inline;" onsubmit="return confirm('Suspend this user?');">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit" style="background:#FF9800; color:white;">Suspend</button>
                    </form>
                    <?php endif; ?>

                    <form action="/admin/users/delete" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user? This cannot be undone.');">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit" class="delete">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<script src="/js/admin-users.js">
</script>

</body>
</html>
