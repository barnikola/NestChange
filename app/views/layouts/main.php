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
    <link rel="stylesheet" href="/css/theme.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/css/dropdown.css?v=<?= time() ?>">
    <?php echo $extraHead; ?>
</head>
<body<?php echo $bodyAttr; ?>>
    <?php require_once dirname(__DIR__, 2) . '/helpers/ProfileHelper.php'; ?>
    <?php $navContext = ProfileHelper::navContext(); ?>

    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="/">
                    <img src="/assets/logo.png" alt="NestChange Logo" class="logo-icon">
                </a>
                <nav class="nav-links">
                    <a href="/" class="nav-link<?php echo $activeNav === 'home' ? ' nav-link-active' : ''; ?>">Home</a>
                    <a href="/listings"
                        class="nav-link<?php echo $activeNav === 'listings' ? ' nav-link-active' : ''; ?>">Listings</a>
                    <!-- Chat link visible only if logged in or allow access to login via it -->
                    <a href="/chat"
                        class="nav-link<?php echo $activeNav === 'chat' ? ' nav-link-active' : ''; ?>">Chat</a>
                    <a href="/favorites" class="nav-link">Favorites</a>
                    <a href="#" class="nav-link">Contact</a>
                </nav>
            </div>
            <div class="header-right">
                <?php if ($navContext['is_logged_in']): ?>
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
                            <a href="/profile" class="dropdown-item">My Profile</a>
                            <a href="/profile/edit" class="dropdown-item">Settings</a>
                            <a href="/notifications" class="dropdown-item">
                                Notifications
                                <?php if ($navContext['notification_count'] > 0): ?>
                                    <span class="notification-badge"><?= $navContext['notification_count'] ?></span>
                                <?php endif; ?>
                            </a>
                            <a href="/auth/logout" class="dropdown-item">Sign Out</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/auth/signin" class="btn-signin">Sign in</a>
                    <a href="/auth/register" class="btn-register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

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
                <a href="/">
                    <img src="/assets/logo.png" alt="NestChange Logo" class="footer-logo">
                </a>
            </div>
            <div class="footer-nav">
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Use cases</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#">UI design</a></li>
                        <li><a href="#">UX design</a></li>
                        <li><a href="#">Wireframing</a></li>
                        <li><a href="#">Diagramming</a></li>
                        <li><a href="#">Brainstorming</a></li>
                        <li><a href="#">Online whiteboard</a></li>
                        <li><a href="#">Team collaboration</a></li>
                    </ul>
                </div>
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Explore</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Prototyping</a></li>
                        <li><a href="#">Development features</a></li>
                        <li><a href="#">Design systems</a></li>
                        <li><a href="#">Collaboration features</a></li>
                        <li><a href="#">Design process</a></li>
                        <li><a href="#">FigJam</a></li>
                    </ul>
                </div>
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Resources</h4>
                    <ul class="footer-nav-links">
                        <li><a href="/legal/terms">Terms of Service</a></li>
                        <li><a href="/legal/privacy">Privacy Policy</a></li>
                        <li><a href="/legal/cookie_policy">Cookie Policy</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    </body>

</html>