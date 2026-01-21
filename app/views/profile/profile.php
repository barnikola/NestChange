<?php
$pageTitle = 'NestChange - My Profile';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Profile'],
];

$user = $user ?? [];
$documents = $documents ?? [];
$listingStats = array_merge([
    'total' => 0,
    'published' => 0,
    'draft' => 0,
], $listingStats ?? []);
$exchangeStats = array_merge([
    'active' => 0,
    'upcoming' => 0,
    'completed' => 0,
], $exchangeStats ?? []);
$recentExchanges = $recentExchanges ?? [];

$initials = strtoupper(substr($user['first_name'] ?? '', 0, 1) . substr($user['last_name'] ?? '', 0, 1)) ?: 'NC';
$avatar = $user['profile_picture'] ?? null;
$fullName = trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) ?: 'NestChange member';
$email = $user['email'] ?? '';
$status = strtolower($user['status'] ?? 'pending');
$memberSince = !empty($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : 'Not specified';

$locationParts = array_filter([
    $user['city'] ?? null,
    $user['country'] ?? null,
]);
$location = !empty($locationParts) ? implode(', ', $locationParts) : 'Location not provided';
$languages = $user['languages'] ?? 'Not specified';
$accessibility = $user['accessibility_needs'] ?? 'None listed';

$documentCount = count($documents);

ob_start();
?>
<section id="profile-dashboard" class="profile-dashboard">
    <aside class="profile-sidebar">
        <div class="profile-avatar">
            <?php if (!empty($avatar)): ?>
                <img src="<?= htmlspecialchars($avatar) ?>" alt="<?= htmlspecialchars($fullName) ?> avatar">
            <?php else: ?>
                <div class="profile-avatar-fallback" aria-hidden="true"><?= htmlspecialchars($initials) ?></div>
            <?php endif; ?>
        </div>

        <div class="profile-sidebar-header">
            <h1 class="profile-name"><?= htmlspecialchars($fullName) ?></h1>
            <p class="profile-username"><?= htmlspecialchars($email) ?></p>
            <span class="profile-status-badge <?= $status === 'approved' ? 'profile-status-approved' : 'profile-status-pending' ?>">
                <?= htmlspecialchars(ucfirst($status)) ?>
            </span>
        </div>

        <dl class="profile-sidebar-details">
            <div>
                <dt>Member since</dt>
                <dd><?= htmlspecialchars($memberSince) ?></dd>
            </div>
            <div>
                <dt>Location</dt>
                <dd><?= htmlspecialchars($location) ?></dd>
            </div>
            <div>
                <dt>Languages</dt>
                <dd><?= htmlspecialchars($languages) ?></dd>
            </div>
            <div>
                <dt>Accessibility</dt>
                <dd><?= htmlspecialchars($accessibility) ?></dd>
            </div>
        </dl>

        <div class="profile-sidebar-stats">
            <div>
                <p>Total Listings</p>
                <strong><?= (int)$listingStats['total'] ?></strong>
            </div>
            <div>
                <p>Active Exchanges</p>
                <strong><?= (int)$exchangeStats['active'] ?></strong>
            </div>
            <div>
                <p>Documents</p>
                <strong><?= $documentCount ?></strong>
            </div>
        </div>

        <a class="profile-edit-btn" href="/profile/edit">Edit Profile</a>
    </aside>

    <div class="profile-content">
        <section class="profile-highlight-grid" aria-label="Profile stats">
            <article class="profile-highlight-card">
                <p class="profile-highlight-label">Published listings</p>
                <strong><?= (int)$listingStats['published'] ?></strong>
                <span><?= (int)$listingStats['draft'] ?> awaiting approval</span>
            </article>
            <article class="profile-highlight-card">
                <p class="profile-highlight-label">Upcoming exchanges</p>
                <strong><?= (int)$exchangeStats['upcoming'] ?></strong>
                <span><?= (int)$exchangeStats['completed'] ?> completed</span>
            </article>
            <article class="profile-highlight-card">
                <p class="profile-highlight-label">Verification docs</p>
                <strong><?= $documentCount ?></strong>
                <span><?= $documentCount ? 'Uploaded and ready' : 'No documents yet' ?></span>
            </article>
        </section>

        <section class="profile-actions-grid" aria-label="Quick actions">
            <article class="profile-card add-card">
                <h3>Add new listing</h3>
                <p>Publish a space for other students to discover.</p>
                <a href="/listings/create" class="profile-card-btn">Create listing</a>
            </article>
            <article class="profile-card">
                <h3>Manage listings</h3>
                <p>Review availability, pricing, and requests.</p>
                <a href="/listings/my-listings" class="profile-card-btn">Go to dashboard</a>
            </article>
            <article class="profile-card">
                <h3>Favorite stays</h3>
                <p>Jump back into homes you have saved.</p>
                <a href="<?= rtrim(BASE_URL, '/') ?>/favorites" class="profile-card-btn">View favorites</a>
            </article>
            <article class="profile-card">
                <h3>Messages</h3>
                <p>Continue conversations with other students.</p>
                <a href="<?= rtrim(BASE_URL, '/') ?>/chat" class="profile-card-btn">Open chat</a>
            </article>
        </section>

        <section class="profile-panel" aria-label="Uploaded documents">
            <div class="profile-panel-header">
                <h2>Uploaded documents</h2>
                <a href="/profile/edit" class="profile-panel-link">Upload new</a>
            </div>
            <?php if ($documentCount === 0): ?>
                <p class="profile-empty-state">No documents uploaded yet. Add an ID or student card to speed up verification.</p>
            <?php else: ?>
                <ul class="profile-document-list">
                    <?php foreach ($documents as $doc): ?>
                        <?php
                        $label = match ((int)($doc['document_type_id'] ?? 0)) {
                            1 => 'Passport / ID',
                            2 => 'Student ID',
                            default => 'Document',
                        };
                        $uploadedAt = !empty($doc['created_at'])
                            ? date('M d, Y', strtotime($doc['created_at']))
                            : 'Pending';
                        ?>
                        <li class="profile-document-item">
                            <div>
                                <p class="profile-doc-label">
                                    <?= htmlspecialchars($label) ?>
                                    <span class="status-badge status-<?= htmlspecialchars($doc['status'] ?? 'pending') ?>">
                                        <?= htmlspecialchars(ucfirst($doc['status'] ?? 'pending')) ?>
                                    </span>
                                </p>
                                <span class="profile-doc-date"><?= htmlspecialchars($uploadedAt) ?></span>
                            </div>
                            <a href="<?= htmlspecialchars($doc['document_path'] ?? '#') ?>" target="_blank" rel="noopener" class="profile-panel-link">
                                View
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section class="profile-panel" aria-label="Recent exchanges">
            <div class="profile-panel-header">
                <h2>Recent exchanges</h2>
                <a href="/listings/my-exchanges" class="profile-panel-link">See all</a>
            </div>
            <?php if (empty($recentExchanges)): ?>
                <p class="profile-empty-state">You have no exchanges yet. Once you host or travel, the timeline will appear here.</p>
            <?php else: ?>
                <ul class="profile-activity-list">
                    <?php foreach ($recentExchanges as $exchange): ?>
                        <li class="profile-activity-item">
                            <div>
                                <p class="profile-activity-title">
                                    <?= htmlspecialchars($exchange['listing_title'] ?? 'Listing') ?>
                                </p>
                                <p class="profile-activity-meta">
                                    <?= htmlspecialchars($exchange['date_range'] ?? '') ?> ·
                                    <?= htmlspecialchars(ucfirst($exchange['role'] ?? '')) ?> with
                                    <?= htmlspecialchars($exchange['other_name'] ?? 'Unknown') ?>
                                </p>
                            </div>
                            <span class="profile-activity-status status-<?= htmlspecialchars($exchange['status'] ?? 'upcoming') ?>">
                                <?= htmlspecialchars(ucfirst($exchange['status'] ?? 'upcoming')) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section class="profile-panel" aria-label="Account settings">
            <div class="profile-panel-header">
                <h2>Account settings</h2>
            </div>
            <ul class="profile-settings-list">
                <li>
                    <a href="/profile/edit" class="profile-settings-item">
                        <span>Edit profile information</span>
                        <span class="profile-settings-chevron">›</span>
                    </a>
                </li>
                <li>
                    <a href="/auth/change-password" class="profile-settings-item">
                        <span>Change password</span>
                        <span class="profile-settings-chevron">›</span>
                    </a>
                </li>
                <li>
                    <a href="/notifications" class="profile-settings-item">
                        <span>Notification preferences</span>
                        <span class="profile-settings-chevron">›</span>
                    </a>
                </li>
                <li>
                    <a href="/legal/privacy" class="profile-settings-item">
                        <span>Privacy &amp; security</span>
                        <span class="profile-settings-chevron">›</span>
                    </a>
                </li>
            </ul>
        </section>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
