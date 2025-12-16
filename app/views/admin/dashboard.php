<?php
// Determine if running through router (defined in config which index requires)
$isRouted = defined('APP_ROOT');

$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = rtrim(str_replace('\\', '/', $scriptDir), '/');

if ($isRouted) {
    // We are in router. scriptDir is root/public
    $usersLink = $scriptDir . '/admin/users';
    $listingsLink = $scriptDir . '/admin/listings';
    $cssPath = $scriptDir . '/css/panel.css';
} else {
    // Direct access to file. scriptDir is root/app/views/admin
    $usersLink = 'user_table.php';
    $listingsLink = 'listing_table.php';
    // CSS logic: we are in app/views/admin, css is in public/css
    $cssPath = '../../../public/css/panel.css';
    $documentsLink = 'document_table.php';
}

if ($isRouted) {
    // Router path (hypothetical, adjusting if needed)
    $documentsLink = $scriptDir . '/admin/documents'; 
} else {
     $documentsLink = 'document_table.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= $cssPath ?>">
</head>

<body>

    <header class="header">
        <h2>NestChange — Admin Interface</h2>
    </header>

    <section class="container">
        <div class="panel-box">
            <h1>Admin Dashboard</h1>
            <p>This interface allows the admin to manage the entire platform.</p>

            <div class="options">
                <div class="card">
                    <a href="<?= $usersLink ?>" style="text-decoration:none; color:inherit;">
                    <h3>👥 Manage Users</h3>
                    <p>Approve, block or delete user accounts.</p>
                    </a>
                </div>

                <div class="card">
                    <a href="<?= $listingsLink ?>" style="text-decoration:none; color:inherit;">
                    <h3>🏘 Manage Listings</h3>
                    <p>View or remove property listings.</p>
                    </a>
                </div>

                <div class="card">
                    <a href="<?= $documentsLink ?>" style="text-decoration:none; color:inherit;">
                    <h3>📄 Verify Documents</h3>
                    <p>Review ID proofs and uploaded documents.</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
