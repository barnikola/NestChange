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
            <form class="auth-form">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email" required>
                </div>
                
                <button type="submit" class="btn-submit">Send Reset Link</button>
                
                <div class="form-links">
                    <a href="/auth/signin" class="form-link">Back to Sign in</a>
                    <a href="/auth/register" class="form-link">Register</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
