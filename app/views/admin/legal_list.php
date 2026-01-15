<?php
$title = 'Legal Content Management';
ob_start();
?>


<style>
.legal-table-container {
    max-width: 900px;
    margin: 40px auto 0 auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    padding: 32px 32px 24px 32px;
}
.legal-table-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 18px;
    letter-spacing: -1px;
}
.legal-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(44,62,80,0.04);
}
.legal-table th, .legal-table td {
    padding: 16px 18px;
    text-align: left;
}
.legal-table th {
    background: #f7f7f7;
    color: #666;
    font-size: 1rem;
    font-weight: 700;
    border-bottom: 2px solid #eee;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
.legal-table td {
    font-size: 1.05rem;
    color: #222;
    border-bottom: 1px solid #f0f0f0;
}
.legal-table tr:last-child td {
    border-bottom: none;
}
.legal-table a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.15s;
}
.legal-table a:hover {
    color: #1e40af;
    text-decoration: underline;
}
@media (max-width: 700px) {
    .legal-table-container {
        padding: 12px 2vw;
    }
    .legal-table th, .legal-table td {
        padding: 10px 6px;
        font-size: 0.98rem;
    }
    .legal-table-title {
        font-size: 1.3rem;
    }
}
</style>

<div class="legal-table-container">
    <h1 class="legal-table-title">Legal Content</h1>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="mb-4 p-4 rounded-md" style="background:#f8fafc;color:#2563eb;font-weight:600;">
            <?php 
                echo $_SESSION['flash_message']; 
                unset($_SESSION['flash_message']);
                unset($_SESSION['flash_type']);
            ?>
        </div>
    <?php endif; ?>
    <table class="legal-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Last Updated</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($docs as $doc): ?>
                <tr>
                    <td><?php echo htmlspecialchars($doc['title']); ?></td>
                    <td><?php echo htmlspecialchars($doc['type']); ?></td>
                    <td><?php echo htmlspecialchars($doc['updated_at']); ?></td>
                    <td><a href="/admin/legal/edit/<?php echo $doc['type']; ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
require dirname(__DIR__) . '/layouts/main.php';
?>
