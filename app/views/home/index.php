<?php
$pageTitle = 'NestChange - Home Page';
$activeNav = 'home';

ob_start();
?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background">
            <div class="hero-graphic"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="nest">Nest</span><span class="change">Change</span>
            </h1>
            <p class="hero-tagline">Explore the world for free!</p>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search for listing">
                <button class="search-clear">×</button>
            </div>
        </div>
    </section>

    <!-- Action Cards Section -->
    <section class="action-cards">
        <div class="action-card">
            <div class="action-card-image">
                <img src="assets/listing.jpg" alt="Property listing" class="action-card-image">
                <div class="action-overlay">
                 <a href="listings/add-listing" class="action-btn">
                        <span class="action-icon">+</span>
                        <span >Add listing</span>
                </a>
                </div>
            </div>
        </div>
        <div class="action-card">
            <div class="action-card-image">
                <img src="assets/listing.jpg" alt="Property listing" class="action-card-image">

                <div class="action-overlay">
                <a href="listings/search" class="action-btn">
                        <span class="action-icon">🔍</span>
                        <span>Find listing</span>
                </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Listings Section -->
    <section class="listings-section">
        <div class="listings-container">
            <h2 class="listings-title">Listings</h2>
            <p class="listings-subtitle">Available stays</p>
            <div class="listings-grid">
                <div class="listing-card">
                    <img src="assets/listing.jpg" alt="Property listing" class="listing-image">
                    <h3 class="listing-title">Listing</h3>
                    <p class="listing-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="listing-card">
                    <img src="assets/listing.jpg" alt="Property listing" class="listing-image">
                    <h3 class="listing-title">Listing</h3>
                    <p class="listing-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="listing-card">
                    <img src="assets/listing.jpg" alt="Property listing" class="listing-image">
                    <h3 class="listing-title">Listing</h3>
                    <p class="listing-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="listing-card">
                    <img src="assets/listing.jpg" alt="Property listing" class="listing-image">
                    <h3 class="listing-title">Listing</h3>
                    <p class="listing-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="listing-card">
                    <img src="assets/listing.jpg" alt="Property listing" class="listing-image">
                    <h3 class="listing-title">Listing</h3>
                    <p class="listing-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="listing-card">
                    <img src="assets/listing.jpg" alt="Property listing" class="listing-image">
                    <h3 class="listing-title">Listing</h3>
                    <p class="listing-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
