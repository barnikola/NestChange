<?php
$pageTitle = 'My Notifications - NestChange';
ob_start();
?>

<div class="notifications-page" style="padding: 60px 40px; background: #f7f7f7; min-height: 80vh;">
    <div class="notifications-container" style="max-width: 800px; margin: 0 auto; background: white; border-radius: 12px; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h1 style="margin-bottom: 30px; font-size: 28px;">Notifications</h1>
        
        <?php if (empty($notifications)): ?>
            <div class="empty-state" style="text-align: center; color: #666; padding: 40px;">
                <p>You have no notifications yet.</p>
            </div>
        <?php else: ?>
            <div class="notification-list" style="display: flex; flex-direction: column; gap: 15px;">
                <?php foreach ($notifications as $notif): ?>
                    <div class="notification-item" style="
                        padding: 20px; 
                        border-left: 4px solid #333; 
                        background: #fff;
                        border: 1px solid #eee;
                        border-left-width: 4px;
                        border-left-color: <?= $notif['type'] === 'success' ? '#4CAF50' : ($notif['type'] === 'error' ? '#f44336' : '#2196F3') ?>;
                        border-radius: 4px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    ">
                        <div class="notif-content">
                            <p style="margin: 0; font-size: 16px; color: #333;"><?= htmlspecialchars($notif['message']) ?></p>
                            <small style="color: #999; margin-top: 5px; display: block;"><?= date('M j, Y g:i A', strtotime($notif['created_at'])) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
