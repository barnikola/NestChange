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
            <form action="/listings" method="GET" class="search-container">
                <label for="home-search" class="sr-only">Search for listings</label>
                <div class="search-field-wrapper">
                    <input type="text" id="home-search" name="location" class="search-input" placeholder="Search for listing">
                    <button type="button" class="search-clear" aria-label="Clear search" onclick="this.form.reset()">×</button>
                </div>
                <button type="submit" class="search-submit">Search</button>
            </form>
        </div>
    </section>

    <!-- Action Cards Section -->
    <section class="action-cards">
        <div class="action-card">
            <div class="action-card-image">
                <img src="/assets/listing.jpg" alt="Property listing" class="action-card-image">
                <div class="action-overlay">
                 <a href="/listings/create">
                    <button class="action-btn">
                        <span class="action-icon">+</span>
                        <span >Add listing</span>
                    </button>
                </a>
                </div>
            </div>
        </div>
        <div class="action-card">
            <div class="action-card-image">
                <img src="/assets/listing.jpg" alt="Property listing" class="action-card-image">

                <div class="action-overlay">
                <a href="/listings">

                    <button class="action-btn">
                        <span class="action-icon">🔍</span>
                        <span>Find listing</span>
                    </button>
                </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Listings Section -->
    <section class="listings-section">
        <div class="listings-container">
            <h2 class="listings-title">Recent Listings</h2>
            <p class="listings-subtitle">Available stays</p>
            <div class="listings-grid">
                <?php if (!empty($listings)): ?>
                    <?php foreach ($listings as $listing): ?>
                        <div class="listing-card">
                            <?php if (!empty($listing['primary_image'])): ?>
                                <img src="/assets/listing.jpg" alt="Property listing" class="listing-image">
                            <?php endif; ?>
                            <h3 class="listing-title">
                                <a href="/listings/<?php echo $listing['id']; ?>" style="text-decoration: none; color: inherit;">
                                    <?php echo htmlspecialchars($listing['title']); ?>
                                </a>
                            </h3>
                            <p class="listing-description">
                                <?php echo htmlspecialchars(substr($listing['description'] ?? '', 0, 100)); ?>...
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No listings available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
