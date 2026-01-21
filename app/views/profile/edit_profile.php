<?php
$pageTitle = 'NestChange - Edit Profile';
$activeNav = '';
$bodyClass = 'dark-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Profile', 'url' => '/profile'],
    ['label' => 'Edit Profile'],
];

$user = $data['user'] ?? [];
$csrf_token = $data['csrf_token'] ?? '';

ob_start();
?>
<section class="edit-profile-section">
    <div class="edit-profile-card">
        <h1 class="edit-title">Edit Profile</h1>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-error"><?= $_SESSION['flash_error'];
            unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>

        <form class="edit-form" action="/profile/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <label class="edit-label">Profile Photo</label>
            <div class="edit-photo-row">
                <div class="edit-photo-preview">
                    <?php if (!empty($user['profile_picture'])): ?>
                        <img src="<?= htmlspecialchars($user['profile_picture']) ?>" id="previewImg" alt="Preview">
                    <?php else: ?>
                        <img src="/assets/logo.png" id="previewImg" alt="Preview">
                    <?php endif; ?>
                </div>
                <input type="file" class="edit-input" name="profile_picture" accept=".jpg, .jpeg, image/jpg, image/jpeg" id="photoUpload">
            </div>

            <div class="edit-form-grid">
                <div>
                    <label class="edit-label">First Name</label>
                    <input type="text" class="edit-input" name="first_name"
                        value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
                </div>
                <div>
                    <label class="edit-label">Last Name</label>
                    <input type="text" class="edit-input" name="last_name"
                        value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required>
                </div>
            </div>

            <label class="edit-label">City</label>
            <input type="text" class="edit-input" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>"
                placeholder="e.g. Paris">

            <label class="edit-label">Country</label>
            <input type="text" class="edit-input" name="country" value="<?= htmlspecialchars($user['country'] ?? '') ?>"
                placeholder="e.g. France">

            <label class="edit-label">Bio</label>
            <textarea class="edit-textarea" name="bio"
                placeholder="Tell us about yourself..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>

            <label class="edit-label">Languages Spoken</label>
            <input type="text" class="edit-input" name="languages"
                value="<?= htmlspecialchars($user['languages'] ?? '') ?>" placeholder="e.g. English, French, Spanish">

            <label class="edit-label">Accessibility Needs</label>
            <textarea class="edit-textarea" name="accessibility_needs"
                placeholder="Any accessibility requirements?"><?= htmlspecialchars($user['accessibility_needs'] ?? '') ?></textarea>

            <label class="edit-label" style="margin-top: 20px;">Upload ID / Proof Document (Temporary)</label>
            <input type="file" class="edit-input" name="id_document" accept=".pdf,.jpg,.jpeg,.png">
            <p style="font-size: 0.8rem; color: #888; margin-bottom: 20px;">Uploaded documents will be stored
                temporarily.</p>

            <button type="submit" class="edit-save-btn">Save Changes</button>
        </form>
    </div>
</section>

<script src="/js/profile-edit.js" defer></script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
