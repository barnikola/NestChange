<?php
// Determine if running through router
$isRouted = defined('APP_ROOT');

$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = rtrim(str_replace('\\', '/', $scriptDir), '/');

if ($isRouted) {
    // We are in router. scriptDir is root/public
    $listingsLink = $scriptDir . '/moderator/listings';
    $documentsLink = $scriptDir . '/moderator/documents';
    $cssPath = $scriptDir . '/css/panel.css';
} else {
    // Direct access to file. scriptDir is root/app/views/moderator
    $listingsLink = 'listing_table.php';
    $documentsLink = 'document_table.php';
    // CSS logic: we are in app/views/moderator, css is in public/css
    $cssPath = '../../../public/css/panel.css';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moderator Interface - NestChange</title>
    <link rel="stylesheet" href="<?= $cssPath ?>">
</head>

<body>

    <header class="header">
        <h2>🛠 NestChange — Moderator Interface</h2>
    </header>

    <section class="container">
        <div class="panel-box">
            <h1>Moderator Dashboard</h1>
            <p>Moderators help maintain a safe and clean platform.</p>

            <div class="options">
                <div class="card">
                    <a href="<?= $listingsLink ?>" style="text-decoration:none; color:inherit;">
                    <h3>🏘 Review Listings</h3>
                    <p>Approve or remove inappropriate listings.</p>
                    </a>
                </div>

                <div class="card">
                    <a href="<?= $documentsLink ?>" style="text-decoration:none; color:inherit;">
                    <h3>📄 Check Documents</h3>
                    <p>Review user verification documents.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
