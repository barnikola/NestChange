<?php
$pageTitle = 'NestChange - Forgot Password';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Forgot Password'],
];

ob_start();
?>
<section class="form-section">
    <div class="form-container">
        <h1 class="form-title">
            <span class="form-title-main">Forgot Password</span>
        </h1>
        
        <div class="form-box">
            <?php if (isset($_SESSION['_flash']['error'])): ?>
                <div class="alert alert-error">
                    <p><?= htmlspecialchars($_SESSION['_flash']['error']) ?></p>
                </div>
                <?php unset($_SESSION['_flash']['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['_flash']['success'])): ?>
                <div class="alert alert-success">
                    <p><?= htmlspecialchars($_SESSION['_flash']['success']) ?></p>
                </div>
                <?php unset($_SESSION['_flash']['success']); ?>
            <?php endif; ?>

            <p>Enter your email address and we'll send you a link to reset your password.</p>

            <form class="auth-form" method="POST" action="/auth/forgot-password">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="your@email.com" 
                        required
                    >
                </div>
                
                <button type="submit" class="btn-submit">Send Reset Link</button>
                
                <div class="form-links">
                    <a href="auth/signin" class="form-link">Back to Sign in</a>
                    <a href="auth/register" class="form-link">Register</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
