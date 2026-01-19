<?php
$pageTitle = $pageTitle ?? 'NestChange';
$activeNav = $activeNav ?? '';
$bodyClass = trim($bodyClass ?? '');
$breadcrumbs = $breadcrumbs ?? [];
$extraHead = $extraHead ?? '';
$bodyAttr = $bodyClass !== '' ? ' class="' . htmlspecialchars($bodyClass, ENT_QUOTES, 'UTF-8') . '"' : '';
$lastBreadcrumbIndex = count($breadcrumbs) - 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/theme.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/dropdown.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/star-rating.css?v=<?= time() ?>">
    <?php echo $extraHead; ?>
</head>
<body<?php echo $bodyAttr; ?>>
    <?php require_once dirname(__DIR__, 2) . '/helpers/ProfileHelper.php'; ?>
    <?php $navContext = ProfileHelper::navContext(); ?>

    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="<?php echo rtrim(BASE_URL, '/'); ?>">
                    <img src="<?php echo rtrim(BASE_URL, '/'); ?>/assets/logo.png" alt="NestChange Logo" class="logo-icon">
                </a>
            </div>
            <button class="nav-toggle" type="button" aria-controls="primary-navigation" aria-expanded="false" data-nav-toggle>
                <span class="sr-only">Toggle navigation</span>
                <span class="nav-toggle-bar"></span>
                <span class="nav-toggle-bar"></span>
                <span class="nav-toggle-bar"></span>
            </button>
            <div class="header-nav" id="primary-navigation" data-nav-drawer>
                <nav class="nav-links">
                    <a href="<?php echo rtrim(BASE_URL, '/'); ?>" class="nav-link<?php echo $activeNav === 'home' ? ' nav-link-active' : ''; ?>">Home</a>
                    <a href="<?php echo rtrim(BASE_URL, '/'); ?>/listings" class="nav-link<?php echo $activeNav === 'listings' ? ' nav-link-active' : ''; ?>">Listings</a>
                    <!-- Chat link visible only if logged in or allow access to login via it -->
                    <a href="<?php echo rtrim(BASE_URL, '/'); ?>/chat" class="nav-link<?php echo $activeNav === 'chat' ? ' nav-link-active' : ''; ?>">Chat</a>
                    <a href="<?php echo rtrim(BASE_URL, '/'); ?>/favorites" class="nav-link">Favorites</a>
                    <a href="#" class="nav-link">Contact</a>
                </nav>
                <div class="header-right">
                    <?php if ($navContext['is_logged_in']): ?>
                        <a href="<?php echo rtrim(BASE_URL, '/'); ?>/notifications" class="notification-bell-wrapper" title="Notifications">
                            <svg class="notification-bell-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php if ($navContext['notification_count'] > 0): ?>
                                <span class="notification-bell-badge"><?= $navContext['notification_count'] ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="user-dropdown" tabindex="0">
                            <div class="user-avatar-btn">
                                <?php if ($navContext['avatar']): ?>
                                    <img src="<?= htmlspecialchars($navContext['avatar']) ?>" alt="Avatar" class="user-avatar-img">
                                <?php else: ?>
                                    <?= htmlspecialchars($navContext['initials']) ?>
                                <?php endif; ?>
                            </div>
                            <div class="user-info">
                                <span class="user-name-display"><?= htmlspecialchars($navContext['user_name']) ?></span>
                            </div>

                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <p>Signed in as</p>
                                    <span><?= htmlspecialchars($navContext['user_name']) ?></span>
                                </div>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/profile" class="dropdown-item">My Profile</a>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/my-applications" class="dropdown-item">My Applications</a>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/received-applications" class="dropdown-item">Received Applications</a>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/profile/edit" class="dropdown-item">Settings</a>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/notifications" class="dropdown-item">
                                    Notifications
                                    <?php if ($navContext['notification_count'] > 0): ?>
                                        <span class="notification-badge"><?= $navContext['notification_count'] ?></span>
                                    <?php endif; ?>
                                </a>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/auth/logout" class="dropdown-item">Sign Out</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo rtrim(BASE_URL, '/'); ?>/auth/signin" class="btn-signin">Sign in</a>
                        <a href="<?php echo rtrim(BASE_URL, '/'); ?>/auth/register" class="btn-register">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="nav-overlay" data-nav-overlay aria-hidden="true"></div>

    <?php if (!empty($breadcrumbs)): ?>
        <nav class="breadcrumbs">
            <div class="breadcrumbs-container">
                <?php foreach ($breadcrumbs as $index => $crumb): ?>
                    <?php if ($index > 0): ?>
                        <span class="breadcrumb-separator">/</span>
                    <?php endif; ?>
                    <?php if ($index !== $lastBreadcrumbIndex && !empty($crumb['url'])): ?>
                        <a href="<?php echo htmlspecialchars($crumb['url'], ENT_QUOTES, 'UTF-8'); ?>" class="breadcrumb-link">
                            <?php echo htmlspecialchars($crumb['label'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    <?php else: ?>
                        <span class="breadcrumb-current">
                            <?php echo htmlspecialchars($crumb['label'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </nav>
    <?php endif; ?>

    <?php echo $content ?? ''; ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <a href="<?php echo rtrim(BASE_URL, '/'); ?>">
                    <img src="<?php echo rtrim(BASE_URL, '/'); ?>/assets/logo.png" alt="NestChange Logo" class="footer-logo">
                </a>
            </div>
            <div class="footer-nav">
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Resources</h4>
                    <ul class="footer-nav-links">
                        <li><a href="/legal/terms">Terms of Service</a></li>
                        <li><a href="/legal/privacy">Privacy Policy</a></li>
                        <li><a href="/legal/cookie_policy">Cookie Policy</a></li>
                        <li><a href="/support">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?php echo rtrim(BASE_URL, '/'); ?>/js/navigation.js?v=<?= time() ?>" defer></script>
    <script src="<?php echo rtrim(BASE_URL, '/'); ?>/js/stars.js?v=<?= time() ?>" defer></script>
    </body>

</html>
