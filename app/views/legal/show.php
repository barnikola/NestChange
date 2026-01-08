<?php
$pageTitle = $document['title'] ?? 'Legal Document';
ob_start();
?>

<div class="legal-container" style="max-width: 800px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <h1 style="margin-bottom: 20px; color: #333; text-align: center;"><?= htmlspecialchars($document['title']) ?></h1>
    <div class="legal-content" style="line-height: 1.6; color: #555;">
        <?= nl2br(htmlspecialchars($document['content'])) ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
