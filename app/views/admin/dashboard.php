<?php
$pageTitle = 'NestChange - Admin Dashboard';
$activeNav = '';
// Add breadcrumbs if the layout supports them
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Admin Dashboard'],
];

ob_start();
?>

<style>
    .container {
        display: flex;
        justify-content: center;
        margin-top: 40px;
        width: 100%;
        font-family: var(--font-family);
    }

    .panel-box {
        background: white;
        padding: 30px;
        width: 70%;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .options {
        display: flex;
        gap: 25px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        min-width: 250px;
        padding: 25px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #e1e4e8;
        font-family: var(--font-family);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        background: #fff;
        cursor: pointer;
    }

    .card h3 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 1.1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        font-family: var(--font-family-heading, var(--font-family));
    }

    .card p {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin: 0;
    }
</style>


<section class="listings-section" style="background-color: #f7f7f7; min-height: 80vh;">
    <div class="listings-container">
        <h2 class="listings-title" style="text-align: center; margin-bottom: 10px;">Admin Dashboard</h2>
        <p class="listings-subtitle" style="text-align: center; margin-bottom: 40px;">Manage usage, users and content.</p>
        
        <div class="options">
            <!-- Manage Users -->
            <div class="card">
                <a href="/admin/users" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">
                        👥 Manage Users 
                        <span style="font-size: 0.8em; background: <?php echo ($pendingUsers ?? 0) > 0 ? '#ffcccc' : '#eee'; ?>; color: <?php echo ($pendingUsers ?? 0) > 0 ? '#cc0000' : '#666'; ?>; padding: 2px 6px; border-radius: 10px;">
                            <?php echo ($pendingUsers ?? 0) > 0 ? ($pendingUsers . ' Pending') : ($totalUsers . ' Users'); ?>
                        </span>
                    </h3>
                    <p>Approve new accounts, block users, or delete spam.</p>
                </a>
            </div>

            <!-- Manage Listings -->
            <div class="card">
                <a href="/admin/listings" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">
                        🏘 Manage Listings
                        <span style="font-size: 0.8em; background: <?php echo $pendingListings > 0 ? '#ffcccc' : '#eee'; ?>; color: <?php echo $pendingListings > 0 ? '#cc0000' : '#666'; ?>; padding: 2px 6px; border-radius: 10px;">
                            <?php echo $pendingListings ?? 0; ?> Pending
                        </span>
                    </h3>
                    <p>Review new listings, pause ads, or remove content.</p>
                </a>
            </div>

            <!-- Verify Documents -->
            <div class="card">
                <a href="/admin/documents" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">
                        📄 Verify Documents
                        <span style="font-size: 0.8em; background: <?php echo ($pendingDocuments ?? 0) > 0 ? '#ffcccc' : '#eee'; ?>; color: <?php echo ($pendingDocuments ?? 0) > 0 ? '#cc0000' : '#666'; ?>; padding: 2px 6px; border-radius: 10px;">
                            <?php echo $pendingDocuments ?? 0; ?> Pending
                        </span>
                    </h3>
                    <p>Check uploaded IDs and documents for verification.</p>
                </a>
            </div>
            
            <!-- Legal Content -->
            <div class="card">
                <a href="/admin/legal" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">⚖️ Legal Content</h3>
                    <p>Edit Terms of Service, Privacy Policy, etc.</p>
                </a>
            </div>

            <!-- Reports -->
            <div class="card">
                <a href="/admin/reports" style="text-decoration:none; color:inherit; display:block; height:100%;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;">
                        🚩 Reports
                    </h3>
                    <p>View and manage abuse, dispute, and inappropriate content reports.</p>
                </a>
            </div>
        </div>
        
    </div>
</section>

<?php
$content = ob_get_clean();
// Include the main layout so navigation remains
include __DIR__ . '/../layouts/main.php';
?>
