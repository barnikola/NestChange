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
                    <input type="email" id="email" name="email" class="form-input" placeholder="your@email.com"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="••••••••"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>

                <div style="margin-top: 15px; text-align: center; position: relative;">
                    <span
                        style="background: #fff; padding: 0 10px; color: #666; font-size: 0.9em; position: relative; z-index: 1;">or</span>
                    <div
                        style="border-top: 1px solid #ddd; position: absolute; top: 50%; left: 0; right: 0; z-index: 0;">
                    </div>
                </div>

                <a href="/auth/google/redirect" class="btn-google"
                    style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 10px; margin-top: 15px; background: #fff; color: #333; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; font-weight: 500; transition: background 0.2s;">
                    <svg style="width: 18px; height: 18px; margin-right: 10px;" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.84z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    Sign in with Google
                </a>


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
