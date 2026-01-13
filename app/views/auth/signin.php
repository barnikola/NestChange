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
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($errors as $fieldErrors): ?>
                        <?php foreach ($fieldErrors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php 
            if (isset($_SESSION['_flash']['error'])): 
            ?>
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

            <form class="auth-form" method="POST" action="/login">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="your@email.com" 
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="••••••••" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>

                <div class="captcha-box">
                    <label class="form-label"> Verify you are a human: </label>
                    <div style="gap: 10px ; margin: 10px 0 0 10px; align-items:center; display: flex; flex-direction: row">
                        <label style="text-wrap: nowrap" class="form-label"><?= $_SESSION['captcha_x']?> + <?= $_SESSION['captcha_y']?> =</label>
                        <input type="number" class="form-input" style="width: 6vw; " name="captcha">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>
                
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
