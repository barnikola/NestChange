<?php
$pageTitle = 'NestChange - My Applications';
$activeNav = 'my-applications';
ob_start();
?>
<style>
    .applications-section {
        padding: 60px 40px;
        background-color: #f5f5f5;
        min-height: calc(100vh - 200px);
    }
    
    .applications-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-header {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-title {
        font-size: 32px;
        font-weight: 700;
    }

    .empty-state {
        text-align: center;
        padding: 60px;
        background: white;
        border-radius: 12px;
        color: #666;
    }

    /* Applications Table */
    .applications-table-wrapper {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .applications-table {
        width: 100%;
        border-collapse: collapse;
    }

    .applications-table th {
        text-align: left;
        padding: 20px;
        border-bottom: 2px solid #f0f0f0;
        font-weight: 600;
        color: #333;
    }

    .applications-table td {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .applications-table tr:last-child td {
        border-bottom: none;
    }

    .applications-table tr:hover {
        background-color: #fafafa;
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-accepted { background: #d4edda; color: #155724; }
    .status-rejected { background: #f8d7da; color: #721c24; }
    .status-withdrawn { background: #e2e3e5; color: #383d41; }
    
    .btn-sm {
        padding: 8px 16px;
        font-size: 13px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        background: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
        transition: all 0.2s;
    }

    .btn-sm:hover {
        background: #e2e6ea;
        text-decoration: none;
    }
</style>

    <div class="applications-section">
        <div class="applications-container">
            <div class="section-header">
                <h1 class="section-title">My Sent Applications</h1>
                <a href="/listings" class="btn-submit">Browse Listings</a>
            </div>

            <?php if (empty($applications)): ?>
                <div class="empty-state">
                    <h3>No applications yet</h3>
                    <p>You haven't sent any applications. Find a place you like and apply!</p>
                </div>
            <?php else: ?>
                <div class="applications-table-wrapper">
                    <table class="applications-table">
                        <thead>
                            <tr>
                                <th>Listing</th>
                                <th>Date Applied</th>
                                <th>Dates Requested</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applications as $app): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($app['listing_title'] ?? 'Unknown Listing'); ?></strong>
                                    </td>
                                    <td><?php echo date('d M, Y', strtotime($app['created_at'])); ?></td>
                                    <td>
                                        <?php 
                                            $start = !empty($app['start_date']) && $app['start_date'] !== '0000-00-00' ? date('d M, Y', strtotime($app['start_date'])) : 'TBD';
                                            $end = !empty($app['end_date']) && $app['end_date'] !== '0000-00-00' ? date('d M, Y', strtotime($app['end_date'])) : 'Indefinite';
                                            echo $start . ' - ' . $end;
                                        ?>
                                    </td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower($app['status']); ?>">
                                            <?php echo ucfirst($app['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/applications/<?php echo htmlspecialchars($app['id']); ?>" class="btn-sm">View Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
