<?php
$pageTitle = 'NestChange - Admin Dashboard';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Admin Dashboard'],
];

ob_start();
?>
<section class="listings-section">
    <div class="listings-container">
        <h2 class="listings-title">Admin Dashboard</h2>
        <p class="listings-subtitle">Administrative tools will appear here.</p>
        <div class="profile-settings-list">
            <a href="#" class="profile-settings-item">Manage listings</a>
            <a href="#" class="profile-settings-item">Review verifications</a>
            <a href="#" class="profile-settings-item">View analytics</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
