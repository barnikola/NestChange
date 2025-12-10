<?php
$pageTitle = 'NestChange - Public Profile';
$activeNav = '';
$bodyClass = 'dark-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'User Profile'],
];

ob_start();
?>
<div class="public-banner"></div>

<section class="public-profile-container">
    <div class="public-avatar">
        <img src="assets/logo.png" alt="Profile avatar">
    </div>

    <h1 class="public-name">Muhammed Arif EREN</h1>
    <p class="public-username">@mariferen52</p>

    <div class="public-stats">
        <div>
            <h3>5</h3>
            <p>Exchanges</p>
        </div>
        <div>
            <h3>4.8</h3>
            <p>Rating</p>
        </div>
    </div>
    <p class="public-bio">
        A traveler who loves discovering new cultures, exploring new cities,  
        and meeting amazing people through home exchange.
    </p>

    <h2 class="public-section-title">Listings by Muhammed Arif</h2>

    <div class="public-listings">
        <div class="public-listing-card">
            <img src="assets/listing.jpg" alt="Ankara apartment">
            <h4>Ankara - Cozy Apartment</h4>
            <p>2 bedrooms · City center · Balcony</p>
        </div>

        <div class="public-listing-card">
            <img src="assets/listing.jpg" alt="Ordu home">
            <h4>Ordu - Sea View Home</h4>
            <p>3 bedrooms · Sea view · Pool</p>
        </div>
    </div>

    <h2 class="public-section-title">Reviews</h2>

    <div class="profile-comments-box">
        <div class="profile-comment">
            <div class="comment-header">
                <img class="comment-avatar" src="assets/logo.png" alt="Emily">
                <div>
                    <h4>Emily Rose</h4>
                    <p>2 weeks ago</p>
                </div>
            </div>
            <p class="comment-text">
                “Amazing host! Everything was perfect, and communication was fast.”
            </p>
        </div>

        <div class="profile-comment">
            <div class="comment-header">
                <img class="comment-avatar" src="assets/logo.png" alt="David">
                <div>
                    <h4>David Keller</h4>
                    <p>1 month ago</p>
                </div>
            </div>
            <p class="comment-text">
                “Super smooth experience. Highly recommended.”
            </p>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
