<?php
$pageTitle = 'NestChange - Admin Dashboard';
$activeNav = '';
// Add breadcrumbs if the layout supports them
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Admin Dashboard'],
];

ob_start();
?>

<section class="listings-section" style="background-color: #f7f7f7; min-height: 80vh;">
    <div class="listings-container">
        <h2 class="listings-title" style="text-align: center; margin-bottom: 10px;">Admin Dashboard</h2>
        <p class="listings-subtitle" style="text-align: center; margin-bottom: 40px;">Manage usage, users and content.</p>
        
        <div class="options">
            <!-- Manage Users -->
            <div class="card">
                <a href="/admin/users" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">👥 Manage Users</h3>
                    <p>Approve new accounts, block users, or delete spam.</p>
                </a>
            </div>

            <!-- Manage Listings -->
            <div class="card">
                <a href="/admin/listings" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">🏘 Manage Listings</h3>
                    <p>Review new listings, pause ads, or remove content.</p>
                </a>
            </div>

            <!-- Verify Documents -->
            <div class="card">
                <a href="/admin/documents" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">📄 Verify Documents</h3>
                    <p>Check uploaded IDs and documents for verification.</p>
                </a>
            </div>
        </div>
        
    </div>
</section>

<?php
$content = ob_get_clean();
// Include the main layout so navigation remains
include __DIR__ . '/../layouts/main.php';
?>