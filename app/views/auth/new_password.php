<?php
$pageTitle = 'NestChange - Set New Password';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Set New Password'],
];

ob_start();
?>
<section class="form-section">
    <div class="form-container">
        <h1 class="form-title">
            <span class="form-title-main">Set New Password</span>
        </h1>
        
        <div class="form-box">
            <form class="auth-form" action="/update-password" method="POST">
                <div class="form-group">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" id="new-password" name="new-password" class="form-input" placeholder="Enter new password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="Confirm new password" required>
                </div>
                
                <button type="submit" class="btn-submit">Set Password</button>
                
                <div class="form-links">
                    <a href="/auth/signin" class="form-link">Back to Sign in</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
