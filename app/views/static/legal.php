<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Legal' ?> - NestChange</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background: #fff; color: #333; }
        .container { max-width: 900px; margin: 0 auto; }
        
        /* Navigation Tabs */
        .legal-nav { border-bottom: 2px solid #eee; margin-bottom: 30px; display: flex; gap: 30px; }
        .legal-nav a {
            text-decoration: none;
            color: #666;
            padding: 15px 0;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: color 0.3s;
        }
        .legal-nav a:hover { color: #007bff; }
        .legal-nav a.active { color: #007bff; border-bottom-color: #007bff; }

        .content { font-size: 16px; }
        .content h1 { font-size: 2.5em; margin-bottom: 10px; }
        .last-updated { color: #888; margin-bottom: 40px; font-style: italic; }
        
        .empty-state { text-align: center; color: #999; padding: 50px; }
    </style>
</head>
<body>

<div class="container">
    <nav class="legal-nav">
        <a href="?type=terms" class="<?= ($currentType === 'terms') ? 'active' : '' ?>">Terms of Service</a>
        <a href="?type=privacy" class="<?= ($currentType === 'privacy') ? 'active' : '' ?>">Privacy Policy</a>
        <a href="?type=cookies" class="<?= ($currentType === 'cookies') ? 'active' : '' ?>">Cookie Policy</a>
        <a href="/NestChange/public/" style="margin-left: auto; font-weight: normal; color: #888;">&times; Close</a>
    </nav>

    <div class="content">
        <?php if ($content): ?>
            <h1><?= htmlspecialchars($content['title'] ?? 'Legal Document') ?></h1>
            <?php if (!empty($content['updated_at'])): ?>
                <p class="last-updated">Last Updated: <?= date('F j, Y', strtotime($content['updated_at'])) ?></p>
            <?php endif; ?>
            
            <div class="document-body">
                <!-- Using raw output for HTML content from DB. Ensure DB has sanitized HTML -->
                <?= $content['content'] ?? '' ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h2>Content Not Found</h2>
                <p>The requested legal document could not be found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
