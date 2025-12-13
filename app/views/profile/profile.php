<?php
$pageTitle = 'NestChange - My Profile';
$activeNav = '';
$bodyClass = 'dark-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Profile'],
];

ob_start();
?>
<section id="profile-dashboard">
    <div class="profile-sidebar">
        <div class="profile-avatar">
            <img src="assets/logo.png" alt="Profile avatar"/>
        </div>
        <h2 class="profile-name">Muhammed Arif EREN</h2>
        <p class="profile-username">@mariferen52</p>

        <div class="profile-stats">
            <div>
                <h3>5</h3>
                <p>Exchanges</p>
            </div>
            <div>
                <h3>4.8</h3>
                <p>Rating</p>
            </div>
        </div>

        <button class="profile-edit-btn"><a href="profile/edit">Edit Profile</a></button>
    </div>

    <div class="profile-content">
        <h2 class="profile-section-title">Your Dashboard</h2>

        <div class="profile-cards">
            <div class="profile-card add-card">
                <h3>Add New Listing</h3>
                <p>Create a new property listing and start hosting.</p>
                <a href="listings/add-listing" class="profile-card-btn">Add Listing</a>
            </div>

            <div class="profile-card">
                <h3>Your Listings</h3>
                <p>You have 3 active property listings.</p>
                <a href="listings/my-exchanges" class="profile-card-btn">View Listings</a>
            </div>

            <div class="profile-card">
                <h3>My Exchanges</h3>
                <p>No upcoming stays.</p>
                <a href="listings/exchange-details" class="profile-card-btn">View Exchanges</a>
            </div>

            <div class="profile-card">
                <h3>Messages</h3>
                <p>You have 2 unread messages.</p>
                <a href="chat" class="profile-card-btn">Open Chat</a>
            </div>
        </div>

        <h2 class="profile-section-title" style="margin-top:40px;">Account Settings</h2>

        <div class="profile-settings-list">
            <a href="#" class="profile-settings-item">Change password</a>
            <a href="#" class="profile-settings-item">Privacy &amp; security</a>
            <a href="#" class="profile-settings-item">Delete account</a>
        </div>

        <h2 class="profile-section-title" style="margin-top:40px;">Comments</h2>
        
        <div class="profile-comments-box">
            <div class="profile-comment">
                <div class="comment-header">
                    <img src="assets/logo.png" class="comment-avatar" alt="Emily">
                    <div>
                        <h4 class="comment-name">Emily Rose</h4>
                        <p class="comment-date">2 weeks ago</p>
                    </div>
                </div>
                <p class="comment-text">
                    “Great host! The place was clean and communication was fast. Definitely recommended.”
                </p>
            </div>

            <div class="profile-comment">
                <div class="comment-header">
                    <img src="assets/logo.png" class="comment-avatar" alt="David">
                    <div>
                        <h4 class="comment-name">David Keller</h4>
                        <p class="comment-date">1 month ago</p>
                    </div>
                </div>
                <p class="comment-text">
                    “Everything was smooth. Check-in was easy and the apartment looked exactly like the photos.”
                </p>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
