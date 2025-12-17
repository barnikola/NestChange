<?php
$pageTitle = 'NestChange - Moderator Dashboard';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Moderator Dashboard'],
];

ob_start();
?>

<section class="listings-section" style="background-color: #f7f7f7; min-height: 80vh;">
    <div class="listings-container">
        <h2 class="listings-title" style="text-align: center; margin-bottom: 10px;">Moderator Dashboard</h2>
        <p class="listings-subtitle" style="text-align: center; margin-bottom: 40px;">Review content and verifications.</p>
        
        <div class="options">
            <!-- Review Listings -->
            <div class="card">
                <a href="/moderator/listings" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">🏘 Review Listings</h3>
                    <p>Approve new ads or remove inappropriate content.</p>
                </a>
            </div>

            <!-- Check Documents -->
            <div class="card">
                <a href="/moderator/documents" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">📄 Check Documents</h3>
                    <p>Verify user uploaded ID proofs.</p>
                </a>
            </div>
        </div>
        
    </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>