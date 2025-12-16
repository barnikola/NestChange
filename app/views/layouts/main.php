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
    <link rel="stylesheet" href="/css/theme.css">
    <?php echo $extraHead; ?>
</head>
<body<?php echo $bodyAttr; ?>>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="/">
                    <img src="/assets/logo.png" alt="NestChange Logo" class="logo-icon">
                </a>
                <nav class="nav-links">
                    <a href="/" class="nav-link<?php echo $activeNav === 'home' ? ' nav-link-active' : ''; ?>">Home</a>
                    <a href="/listings" class="nav-link<?php echo $activeNav === 'listings' ? ' nav-link-active' : ''; ?>">Listings</a>
                    <a href="/chat" class="nav-link<?php echo $activeNav === 'chat' ? ' nav-link-active' : ''; ?>">Chat</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/notifications" class="nav-link">Notifications</a>
                    <?php endif; ?>
                    <a href="#" class="nav-link">Pricing</a>
                    <a href="#" class="nav-link">Contact</a>
                </nav>
            </div>
            <div class="header-right">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/auth/logout" class="btn-signin">Sign Out</a>
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
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Best practices</a></li>
                        <li><a href="#">Colors</a></li>
                        <li><a href="#">Color wheel</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Developers</a></li>
                        <li><a href="#">Resource library</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
