<?php
$pageTitle = 'Admin Dashboard';
$breadcrumbs = [
    'Home' => '/NestChange/public/home',
    'Admin' => '/NestChange/public/admin'
];

require __DIR__ . '/admin_layout.php';
?>

<div class="panel-box">
    <h1>Welcome back, Admin</h1>
    <p>Overview of platform activity and quick actions.</p>

    <div class="options">
        <div class="card" onclick="location.href='<?= $baseUrl ?>/admin/users'">
            <h3><i class="fas fa-users" style="color:#3498db"></i> Manage Users</h3>
            <p>Approve pending accounts, suspend users, or view details.</p>
        </div>

        <div class="card" onclick="location.href='<?= $baseUrl ?>/admin/listings'">
            <h3><i class="fas fa-home" style="color:#2ecc71"></i> Manage Listings</h3>
            <p>Review new listings, remove spam, or manage visibility.</p>
        </div>

        <div class="card" onclick="location.href='<?= $baseUrl ?>/admin/documents'">
            <h3><i class="fas fa-file-contract" style="color:#f1c40f"></i> Verify Documents</h3>
            <p>Review uploaded ID proofs and enrollment documents.</p>
        </div>
    </div>
</div>

</main>
</div> <!-- End admin-wrapper -->
</body>
</html>
