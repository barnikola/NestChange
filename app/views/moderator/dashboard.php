<?php
$pageTitle = 'NestChange - Moderator Dashboard';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Moderator Dashboard'],
];

ob_start();
?>
<section class="listings-section">
    <div class="listings-container">
        <h2 class="listings-title">Moderator Dashboard</h2>
        <p class="listings-subtitle">Moderation actions and insights.</p>
        <div class="profile-settings-list">
            <a href="#" class="profile-settings-item">Pending approvals</a>
            <a href="#" class="profile-settings-item">Flagged conversations</a>
            <a href="#" class="profile-settings-item">User reports</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
