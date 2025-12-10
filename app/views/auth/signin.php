<?php
$pageTitle = 'NestChange - Sign In';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Sign in'],
];

ob_start();
?>
<section class="form-section">
    <div class="form-container">
        <h1 class="form-title">
            <span class="form-title-main">Sign in</span>
        </h1>
        
        <div class="form-box">
            <form class="auth-form">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Value" required>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Value" required>
                </div>
                
                <button type="submit" class="btn-submit">Sign In</button>
                
                <button type="button" class="btn-social">
                    Login with microsoft
                </button>
                
                <button type="button" class="btn-social">
                    Login with google
                </button>
                
                <div class="form-links">
                    <a href="/auth/forgot-password" class="form-link">Forgot password?</a>
                    <a href="/auth/register" class="form-link">New user</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
