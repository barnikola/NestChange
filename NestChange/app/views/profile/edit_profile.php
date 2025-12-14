<?php
$pageTitle = 'NestChange - Edit Profile';
$activeNav = '';
$bodyClass = 'dark-page';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Profile', 'url' => '/profile'],
    ['label' => 'Edit Profile'],
];

ob_start();
?>
<section class="edit-profile-section">
    <div class="edit-profile-card">
        <h1 class="edit-title">Edit Profile</h1>

        <form class="edit-form">
            <label class="edit-label">Profile Photo</label>
            <div class="edit-photo-row">
                <div class="edit-photo-preview">
                    <img src="/assets/logo.png" id="previewImg" alt="Preview">
                </div>
                <input type="file" class="edit-input" accept="image/*" id="photoUpload">
            </div>

            <label class="edit-label">Full Name</label>
            <input type="text" class="edit-input" value="Muhammed Arif EREN">

            <label class="edit-label">Username</label>
            <input type="text" class="edit-input" value="mariferen52">

            <label class="edit-label">Location</label>
            <input type="text" class="edit-input" placeholder="Ankara, Turkey">

            <label class="edit-label">Bio</label>
            <textarea class="edit-textarea" placeholder="Tell us about yourself..."></textarea>

            <button class="edit-save-btn">Save Changes</button>
        </form>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
