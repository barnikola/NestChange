<?php
$pageTitle = 'NestChange - Reset Password';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Reset Password'],
];

ob_start();
?>
<section class="form-section">
    <div class="form-container">
        <h1 class="form-title">
            <span class="form-title-main">Reset Password</span>
        </h1>
        
        <div class="form-box">
            <?php if (isset($_SESSION['_flash']['error'])): ?>
                <div class="alert alert-error">
                    <p><?= htmlspecialchars($_SESSION['_flash']['error']) ?></p>
                </div>
                <?php unset($_SESSION['_flash']['error']); ?>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="/auth/reset-password">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
                
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="At least 8 characters" 
                        required
                    >
                    <small>Must be at least 8 characters with uppercase, lowercase, and a number</small>
                </div>
                
                <div class="form-group">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirm" 
                        name="password_confirm" 
                        class="form-input" 
                        placeholder="Re-enter password" 
                        required
                    >
                </div>
                
                <button type="submit" class="btn-submit">Reset Password</button>
                
                <div class="form-links">
                    <a href="/auth/signin" class="form-link">Back to sign in</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
