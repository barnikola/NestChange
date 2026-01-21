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
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/theme.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/dropdown.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/star-rating.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_URL, '/'); ?>/css/star-rating.css?v=<?= time() ?>">
    <script>
        const APP_BASE_URL = '<?php echo rtrim(BASE_URL, '/'); ?>';
    </script>
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
                    <a href="<?php echo rtrim(BASE_URL, '/'); ?>/contact" class="nav-link<?php echo $activeNav === 'contact' ? ' nav-link-active' : ''; ?>">Contact</a>
                </nav>
                <div class="header-right">
                    <?php if ($navContext['is_logged_in']): ?>
                        <?php if (in_array($navContext['role'] ?? '', ['admin', 'moderator'])): ?>
                            <a href="<?php echo rtrim(BASE_URL, '/'); ?>/<?= htmlspecialchars($navContext['role']) ?>/dashboard" 
                               style="padding: 8px 16px; background-color: #2c3e50; color: #fff; border-radius: 20px; font-size: 13px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: opacity 0.2s;"
                               onmouseover="this.style.opacity='0.9'"
                               onmouseout="this.style.opacity='1'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                <?= ucfirst($navContext['role']) ?> Dashboard
                            </a>
                        <?php endif; ?>
                        
                        <div class="notification-wrapper" style="position: relative;">
                            <a href="<?php echo rtrim(BASE_URL, '/'); ?>/notifications" class="notification-bell-wrapper" id="notification-bell-wrapper">
                                <svg class="notification-bell-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span class="notification-bell-badge" id="notification-badge" <?php echo $navContext['notification_count'] > 0 ? '' : 'style="display: none;"'; ?>>
                                    <?php echo $navContext['notification_count']; ?>
                                </span>
                            </a>
                            <div class="notification-dropdown" id="notification-dropdown">
                                <div class="notification-dropdown-header">
                                    <span>Notifications</span>
                                    <a href="<?php echo rtrim(BASE_URL, '/'); ?>/notifications">View All</a>
                                </div>
                                <div class="notification-dropdown-list" id="notification-dropdown-list">
                                    <div class="notification-empty">Loading...</div>
                                </div>
                            </div>
                        </div>

                        <div class="user-dropdown" tabindex="0">
                            <div class="user-avatar-btn">
                                <?php if ($navContext['avatar']): ?>
                                    <?php 
                                        $avatarUrl = $navContext['avatar'];
                                        if (!preg_match('/^http/', $avatarUrl) && !preg_match('/^\//', $avatarUrl)) {
                                            $avatarUrl = rtrim(BASE_URL, '/') . '/' . $avatarUrl;
                                        }
                                    ?>
                                    <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar" class="user-avatar-img">
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
    <?php include dirname(__DIR__) . '/partials/report_modal.php'; ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="<?php echo rtrim(BASE_URL, '/'); ?>" class="footer-logo-link">
                    <img src="<?php echo rtrim(BASE_URL, '/'); ?>/assets/logo.png" alt="NestChange Logo" class="footer-logo">
                </a>
                <p class="footer-tagline">Exchange homes with students worldwide. Live like a local, save money, and make unforgettable connections.</p>
                <div class="footer-social">
                    <a href="#" class="footer-social-link" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="#" class="footer-social-link" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                    </a>
                </div>
            </div>
            
            <div class="footer-links">
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Product</h4>
                    <ul class="footer-nav-links">
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/listings">Browse Listings</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/listings/create">List Your Place</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>#how-it-works">How It Works</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/faq">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Company</h4>
                    <ul class="footer-nav-links">
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/about">About Us</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/contact">Contact</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/blog">Blog</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/careers">Careers</a></li>
                    </ul>
                </div>
                
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Legal</h4>
                    <ul class="footer-nav-links">
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/legal/terms">Terms of Service</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/legal/privacy">Privacy Policy</a></li>
                        <li><a href="<?php echo rtrim(BASE_URL, '/'); ?>/legal/cookie_policy">Cookie Policy</a></li>

                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p class="footer-copyright">&copy; <?php echo date('Y'); ?> NestChange. All rights reserved.</p>
                <p class="footer-made-with">Made with <span style="color: #FFD700;">❤</span> for students</p>
            </div>
        </div>
    </footer>
    <script src="<?php echo rtrim(BASE_URL, '/'); ?>/js/ui.js?v=<?= time() ?>" defer></script>
    <script src="<?php echo rtrim(BASE_URL, '/'); ?>/js/navigation.js?v=<?= time() ?>" defer></script>
    <script src="<?php echo rtrim(BASE_URL, '/'); ?>/js/stars.js?v=<?= time() ?>" defer></script>
    <script src="<?php echo rtrim(BASE_URL, '/'); ?>/js/notifications.js?v=<?= time() ?>" defer></script>
    </body>

</html>
