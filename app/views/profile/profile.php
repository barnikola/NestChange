<?php
$pageTitle = 'NestChange - My Profile';
$activeNav = '';
$bodyClass = 'dark-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Profile'],
];

$user = $data['user'] ?? [];
$documents = $data['documents'] ?? [];

// Helper to get initials
$initials = strtoupper(substr($user['first_name'] ?? '', 0, 1) . substr($user['last_name'] ?? '', 0, 1));
$avatar = $user['profile_picture'] ?? null;

ob_start();
?>
<section id="profile-dashboard">
    <div class="profile-sidebar">
        <div class="profile-avatar">
            <?php if ($avatar): ?>
                <img src="/<?= htmlspecialchars($avatar) ?>"
                    alt="<?= htmlspecialchars(($user['first_name'] ?? 'User') . ' ' . ($user['last_name'] ?? '')) ?>'s Avatar" />
            <?php else: ?>
                <div style="width: 100%; height: 100%; background: #333; color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; border-radius: 50%;"
                    aria-hidden="true">
                    <?= $initials ?>
                </div>
            <?php endif; ?>
        </div>
        <h2 class="profile-name"><?= htmlspecialchars(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?>
        </h2>
        <p class="profile-username"><?= htmlspecialchars($user['email'] ?? '') ?></p>

        <div class="profile-verification-status" style="margin-top: 10px; text-align: center;">
            <span class="badge badge-<?= ($user['status'] ?? 'pending') === 'approved' ? 'success' : 'warning' ?>">
                <?= ucfirst($user['status'] ?? 'pending') ?>
            </span>
        </div>

        <div class="profile-info-list" style="margin-top: 20px; text-align: left; padding: 0 20px;">
            <p><strong>Bio:</strong> <br><?= nl2br(htmlspecialchars($user['bio'] ?? 'No bio added yet.')) ?></p>
            <p><strong>Languages:</strong> <br><?= htmlspecialchars($user['languages'] ?? 'Not specified') ?></p>
            <p><strong>Accessibility:</strong>
                <br><?= htmlspecialchars($user['accessibility_needs'] ?? 'None specified') ?>
            </p>
        </div>

        <button class="profile-edit-btn" style="margin-top: 20px;"><a href="/profile/edit">Edit Profile</a></button>
    </div>

    <div class="profile-content">
        <h2 class="profile-section-title">Your Dashboard</h2>

        <div class="profile-cards">
            <div class="profile-card add-card">
                <h3>Add New Listing</h3>
                <p>Create a new property listing and start hosting.</p>
                <a href="/listings/add-listing" class="profile-card-btn">Add Listing</a>
            </div>

            <div class="profile-card">
                <h3>Your Listings</h3>
                <p>You have 3 active property listings.</p>
                <a href="/listings/my-exchanges" class="profile-card-btn">View Listings</a>
            </div>

            <div class="profile-card">
                <h3>My Exchanges</h3>
                <p>No upcoming stays.</p>
                <a href="/listings/exchange-details" class="profile-card-btn">View Exchanges</a>
            </div>

            <div class="profile-card">
                <h3>Messages</h3>
                <p>You have 2 unread messages.</p>
                <a href="/chat" class="profile-card-btn">Open Chat</a>
            </div>
        </div>

        <h2 class="profile-section-title" style="margin-top:40px;">Uploaded Documents</h2>
        <?php if (empty($documents)): ?>
            <p style="color: #aaa;">No documents uploaded yet.</p>
        <?php else: ?>
            <div class="document-list">
                <?php foreach ($documents as $doc): ?>
                    <div class="document-item"
                        style="background: #2a2a2a; padding: 15px; margin-bottom: 10px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                        <div class="doc-info">
                            <span class="doc-type-badge">
                                <?= $doc['document_type_id'] == 1 ? 'Passport/ID' : 'Student ID' ?>
                            </span>
                            <span class="doc-date" style="margin-left: 10px; color: #888; font-size: 0.9em;">
                                <?= date('M d, Y', strtotime($doc['uploaded_at'] ?? 'now')) ?>
                            </span>
                        </div>
                        <a href="<?= htmlspecialchars($doc['document_path']) ?>" target="_blank" class="view-doc-btn"
                            style="color: #4CAF50;">View</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h2 class="profile-section-title" style="margin-top:40px;">Account Settings</h2>

        <div class="profile-settings-list">
            <a href="#" class="profile-settings-item">Change password</a>
            <a href="#" class="profile-settings-item">Privacy &amp; security</a>
            <a href="#" class="profile-settings-item">Delete account</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
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
            <img src="/assets/logo.png" alt="Profile avatar" />
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

        <button class="profile-edit-btn"><a href="/profile/edit">Edit Profile</a></button>
    </div>

    <div class="profile-content">
        <h2 class="profile-section-title">Your Dashboard</h2>

        <div class="profile-cards">
            <div class="profile-card add-card">
                <h3>Add New Listing</h3>
                <p>Create a new property listing and start hosting.</p>
                <a href="/listings/add-listing" class="profile-card-btn">Add Listing</a>
            </div>

            <div class="profile-card">
                <h3>Your Listings</h3>
                <p>You have 3 active property listings.</p>
                <a href="/listings/my-exchanges" class="profile-card-btn">View Listings</a>
            </div>

            <div class="profile-card">
                <h3>My Exchanges</h3>
                <p>No upcoming stays.</p>
                <a href="/listings/exchange-details" class="profile-card-btn">View Exchanges</a>
            </div>

            <div class="profile-card">
                <h3>Messages</h3>
                <p>You have 2 unread messages.</p>
                <a href="/chat" class="profile-card-btn">Open Chat</a>
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
                    <img src="/assets/logo.png" class="comment-avatar" alt="Emily">
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
                    <img src="/assets/logo.png" class="comment-avatar" alt="David">
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
