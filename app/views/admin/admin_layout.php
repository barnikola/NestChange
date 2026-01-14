<?php
// Function to generate breadcrumbs
if (!function_exists('render_breadcrumbs')) {
    function render_breadcrumbs($crumbs) {
        $html = '<div class="breadcrumb">';
        $last_key = array_key_last($crumbs);
        foreach ($crumbs as $label => $url) {
            if ($label === $last_key) {
                $html .= htmlspecialchars($label);
            } else {
                $html .= '<a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($label) . '</a> <span>/</span> ';
            }
        }
        $html .= '</div>';
        return $html;
    }
}

// Determine active page
$activePage = basename($_SERVER['SCRIPT_NAME'], '.php');
if (isset($_SERVER['REQUEST_URI'])) {
    if (strpos($_SERVER['REQUEST_URI'], '/admin/users') !== false) $activePage = 'users';
    elseif (strpos($_SERVER['REQUEST_URI'], '/admin/listings') !== false) $activePage = 'listings';
    elseif (strpos($_SERVER['REQUEST_URI'], '/admin/documents') !== false) $activePage = 'documents';
    elseif (strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false) $activePage = 'dashboard';
    elseif (strpos($_SERVER['REQUEST_URI'], '/admin') !== false) $activePage = 'dashboard';
}

$baseUrl = '/NestChange/public'; // Adjust if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin Panel' ?> - NestChange</title>
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/variables.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/panel.css">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header class="header">
    <h2>NestChange Admin</h2>
    <div>
        <a href="<?= $baseUrl ?>/home">Go to Site &rarr;</a>
        <a href="<?= $baseUrl ?>/logout" style="color: #e74c3c;">Logout</a>
    </div>
</header>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">Main Menu</div>
        <nav class="sidebar-nav">
            <a href="<?= $baseUrl ?>/admin/dashboard" class="<?= $activePage == 'dashboard' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="<?= $baseUrl ?>/admin/users" class="<?= $activePage == 'users' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="<?= $baseUrl ?>/admin/listings" class="<?= $activePage == 'listings' ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Listings
            </a>
            <a href="<?= $baseUrl ?>/admin/documents" class="<?= $activePage == 'documents' ? 'active' : '' ?>">
                <i class="fas fa-file-contract"></i> Documents
            </a>
        </nav>
        
        <div class="sidebar-header" style="margin-top:auto">System</div>
        <nav class="sidebar-nav">
             <a href="<?= $baseUrl ?>/admin/settings">
                <i class="fas fa-cog"></i> Settings
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <?php if (isset($breadcrumbs)): ?>
            <?= render_breadcrumbs($breadcrumbs) ?>
        <?php endif; ?>
        
        <!-- Page Content Injected Below -->
