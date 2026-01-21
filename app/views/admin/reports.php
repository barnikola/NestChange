<?php
// Admin Reports Page
require_once dirname(__DIR__, 2) . '/core/session.php';
$status = $status ?? null;
$reports = $reports ?? [];
?>
<div class="admin-reports-card" style="max-width:1400px;margin:40px auto;padding:32px 28px;background:#fff;border-radius:20px;box-shadow:0 8px 32px rgba(44,62,80,0.10);">
    <?php 
    $flashError = Session::getFlash('error');
    $flashSuccess = Session::getFlash('success');
    if ($flashError): ?>
        <div class="admin-flash-error" id="admin-flash-error">
            <?= htmlspecialchars($flashError) ?>
        </div>
    <?php endif; ?>
    <?php if ($flashSuccess): ?>
        <div class="admin-flash-success" id="admin-flash-success">
            <?= htmlspecialchars($flashSuccess) ?>
        </div>
    <?php endif; ?>
    <h1 style="font-size:2.2rem;font-weight:700;color:#222;margin-bottom:18px;letter-spacing:-1px;">🚩 Reports</h1>
    <p style="color:#666;font-size:1.1rem;margin-bottom:28px;">View and manage abuse, dispute, and inappropriate content reports submitted by users.</p>
    <form method="GET" action="" style="margin-bottom:18px;">
            <div class="status-row-filter">
                <input type="hidden" name="status" id="status-input" value="<?= htmlspecialchars($status ?? '') ?>">
                <button type="button" class="status-btn<?= ($status ?? '') === '' ? ' active' : '' ?>" onclick="setStatus('')">All</button>
                <button type="button" class="status-btn status-pending<?= ($status ?? '') === 'pending' ? ' active' : '' ?>" onclick="setStatus('pending')">Pending</button>
                <button type="button" class="status-btn status-reviewed<?= ($status ?? '') === 'reviewed' ? ' active' : '' ?>" onclick="setStatus('reviewed')">Reviewed</button>
                <button type="button" class="status-btn status-resolved<?= ($status ?? '') === 'resolved' ? ' active' : '' ?>" onclick="setStatus('resolved')">Resolved</button>
            </div>
            <script>
            function setStatus(val) {
                document.getElementById('status-input').value = val;
                document.forms[0].submit();
            }
            </script>
            <style>
                    .admin-flash-error {
                        background: #ffeaea;
                        color: #c0392b;
                        border: 1px solid #e74c3c;
                        padding: 12px 18px;
                        border-radius: 8px;
                        font-size: 16px;
                        font-weight: 600;
                        margin-bottom: 18px;
                        text-align: center;
                        box-shadow: 0 2px 8px rgba(231,76,60,0.08);
                        animation: fadeIn 0.3s;
                    }
                    .admin-flash-success {
                        background: #d4edda;
                        color: #155724;
                        border: 1px solid #c3e6cb;
                        padding: 12px 18px;
                        border-radius: 8px;
                        font-size: 16px;
                        font-weight: 600;
                        margin-bottom: 18px;
                        text-align: center;
                        box-shadow: 0 2px 8px rgba(40,167,69,0.08);
                        animation: fadeIn 0.3s;
                    }
                    @keyframes fadeIn {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }
                .status-row-filter {
                    display: flex;
                    gap: 10px;
                    margin-bottom: 8px;
                }
                .status-btn {
                    border: none;
                    background: #f7f7f7;
                    color: #222;
                    padding: 7px 22px;
                    border-radius: 6px;
                    font-size: 15px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
                    box-shadow: 0 1px 4px rgba(44,62,80,0.04);
                }
                .status-btn.active {
                    background: linear-gradient(90deg,#0984e3 60%,#74b9ff 100%);
                    color: #fff;
                    box-shadow: 0 2px 8px rgba(9,132,227,0.10);
                }
                .status-btn.status-pending.active {
                    background: linear-gradient(90deg,#e74c3c 60%,#ff7675 100%);
                }
                .status-btn.status-reviewed.active {
                    background: linear-gradient(90deg,#f1c40f 60%,#ffeaa7 100%);
                    color: #222;
                }
                .status-btn.status-resolved.active {
                    background: linear-gradient(90deg,#27ae60 60%,#55efc4 100%);
                }
                .status-btn:hover {
                    background: #dfe6e9;
                    color: #0984e3;
                }
            </style>
                <script>
                // Hide flash error after 2.5 seconds
                window.addEventListener('DOMContentLoaded', function(){
                    var err = document.getElementById('admin-flash-error');
                    if(err){
                        setTimeout(function(){err.style.display='none';},2500);
                    }
                });
                </script>
    </form>
    <table class="reports-table" style="width:100%;margin-top:0;border-collapse:separate;border-spacing:0;background:#fff;">
        <thead style="background:#f7f7f7;">
            <tr>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">ID</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Reporter</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Type</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Reported Item</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Reason</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Description</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Status</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Date</th>
                <th style="padding:12px 8px;border-bottom:1px solid #eee;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($reports)): ?>
            <tr>
                <td colspan="9" style="padding:30px;text-align:center;color:#999;">No reports found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($reports as $report): ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px 8px;font-size:0.9em;"><?= htmlspecialchars(substr($report['id'], 0, 8)) ?>...</td>
                    <td style="padding:10px 8px;">
                        <?php 
                        $reporterName = trim($report['reporter_name'] ?? '');
                        if (empty($reporterName)) {
                            $reporterName = $report['reporter_first_name'] . ' ' . $report['reporter_last_name'];
                            $reporterName = trim($reporterName);
                        }
                        if (empty($reporterName)) {
                            $reporterName = 'Unknown User';
                        }
                        echo htmlspecialchars($reporterName);
                        if (!empty($report['reporter_email'])) {
                            echo '<br><small style="color:#666;">' . htmlspecialchars($report['reporter_email']) . '</small>';
                        }
                        ?>
                    </td>
                    <td style="padding:10px 8px;text-transform:capitalize;"><?= htmlspecialchars($report['reported_type']) ?></td>
                    <td style="padding:10px 8px;">
                        <?php if ($report['reported_type'] === 'listing'): ?>
                            <a href="<?= rtrim(BASE_URL, '/') ?>/listings/<?= htmlspecialchars($report['reported_id']) ?>" target="_blank" style="color:#0984e3;text-decoration:underline;">View Listing</a>
                        <?php elseif ($report['reported_type'] === 'user'): ?>
                            <a href="<?= rtrim(BASE_URL, '/') ?>/profile/<?= htmlspecialchars($report['reported_id']) ?>" target="_blank" style="color:#0984e3;text-decoration:underline;">View Profile</a>
                        <?php elseif ($report['reported_type'] === 'message'): ?>
                            <span style="color:#666;">Message #<?= htmlspecialchars($report['reported_id']) ?></span>
                        <?php else: ?>
                            <?php echo htmlspecialchars($report['reported_id']); ?>
                        <?php endif; ?>
                    </td>
                    <td style="padding:10px 8px;"><?= htmlspecialchars($report['reason']) ?></td>
                    <td style="padding:10px 8px;max-width:250px;word-break:break-word;font-size:0.9em;">
                        <?php 
                            // Display plain text description (now standard for all types including contact)
                            // Use nl2br to preserve line breaks
                            echo nl2br(htmlspecialchars(substr($report['description'] ?? '', 0, 150) . (strlen($report['description'] ?? '') > 150 ? '...' : '')));
                        ?>
                    </td>
                    <td style="padding:10px 8px;">
                        <span class="badge badge-<?= htmlspecialchars($report['status']) ?>">
                            <?= htmlspecialchars(ucfirst($report['status'])) ?>
                        </span>
                    </td>
                    <td style="padding:10px 8px;white-space:nowrap;font-size:0.9em;">
                        <?php 
                        $date = $report['created_at'] ?? '';
                        if ($date) {
                            $timestamp = strtotime($date);
                            echo date('M d, Y', $timestamp) . '<br><small style="color:#666;">' . date('H:i', $timestamp) . '</small>';
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                    <td style="padding:10px 8px;">
                        <div class="report-actions">
                            <?php if ($report['status'] !== 'reviewed'): ?>
                                <button type="button" class="action-btn action-reviewed" onclick="updateReportStatus('<?= htmlspecialchars($report['id']) ?>','reviewed', this)">Mark Reviewed</button>
                            <?php endif; ?>
                            <?php if ($report['status'] !== 'resolved'): ?>
                                <button type="button" class="action-btn action-resolved" onclick="updateReportStatus('<?= htmlspecialchars($report['id']) ?>','resolved', this)">Mark Resolved</button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <style>
            .report-actions {
                display: flex;
                gap: 6px;
            }
        .reports-table {
            font-family: var(--font-family);
            font-size: 15px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(44,62,80,0.06);
        }
        .reports-table th {
            font-weight: 700;
            background: #f7f7f7;
            color: #222;
            padding: 16px 10px;
            border-bottom: 2px solid #f0f0f0;
            letter-spacing: 0.5px;
        }
        .reports-table td {
            background: #fff;
            transition: background 0.2s;
        }
        .reports-table tr {
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .reports-table tr:hover {
            background: #f9f9f9;
            box-shadow: 0 2px 12px rgba(44,62,80,0.08);
            transform: scale(1.01);
        }
        .badge-pending {
            background: linear-gradient(90deg,#e74c3c 60%,#ff7675 100%);
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(231,76,60,0.08);
        }
        .badge-reviewed {
            background: linear-gradient(90deg,#f1c40f 60%,#ffeaa7 100%);
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(241,196,15,0.08);
        }
        .badge-resolved {
            background: linear-gradient(90deg,#27ae60 60%,#55efc4 100%);
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(39,174,96,0.08);
        }
        .action-btn {
            border: none;
            background: #f7f7f7;
            color: #222;
            padding: 6px 14px;
            border-radius: 6px;
            margin: 2px 4px 2px 0;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 1px 4px rgba(44,62,80,0.04);
        }
        .action-btn:hover {
            background: #dfe6e9;
            color: #0984e3;
            box-shadow: 0 2px 8px rgba(44,62,80,0.10);
            transform: translateY(-1px);
        }
        .action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        .action-reviewed {
            background: linear-gradient(90deg,#f1c40f 60%,#ffeaa7 100%);
            color: #222;
        }
        .action-reviewed:hover {
            background: linear-gradient(90deg,#f39c12 60%,#f1c40f 100%);
            color: #fff;
        }
        .action-resolved {
            background: linear-gradient(90deg,#27ae60 60%,#55efc4 100%);
            color: #fff;
        }
        .action-resolved:hover {
            background: linear-gradient(90deg,#229954 60%,#27ae60 100%);
        }
    </style>
        <div id="report-status-message" style="display:none;margin:18px 0 0 0;font-size:16px;font-weight:500;"></div>
        <script>
        function updateReportStatus(id, status, btn) {
            if (!confirm('Are you sure you want to mark this report as "' + status + '"? An email will be sent to the reporter.')) {
                return;
            }
            
            // Get CSRF token
            const csrfToken = '<?= Session::getCsrfToken() ?>';
            
            btn.disabled = true;
            btn.textContent = 'Updating...';
            
            fetch('<?= rtrim(BASE_URL, '/') ?>/admin/reports/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'id=' + encodeURIComponent(id) + '&status=' + encodeURIComponent(status) + '&csrf_token=' + encodeURIComponent(csrfToken)
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                var msg = document.getElementById('report-status-message');
                msg.style.display = 'block';
                if(res.success){
                    msg.style.background = '#d4edda';
                    msg.style.color = '#155724';
                    msg.style.border = '1px solid #c3e6cb';
                    msg.style.padding = '12px 18px';
                    msg.style.borderRadius = '8px';
                    msg.style.marginTop = '18px';
                    msg.textContent = res.message || 'Status updated successfully.';
                    
                    // Update status badge in table
                    var row = btn.closest('tr');
                    if(row){
                        var statusCell = row.querySelector('td:nth-child(7) .badge');
                        if(statusCell){
                            statusCell.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                            statusCell.className = 'badge badge-' + status;
                        }
                        // Remove the button just clicked
                        btn.remove();
                        
                        // If no more action buttons, show message
                        var actionsDiv = row.querySelector('.report-actions');
                        if (actionsDiv && actionsDiv.children.length === 0) {
                            actionsDiv.innerHTML = '<span style="color:#999;font-size:0.9em;">No actions available</span>';
                        }
                    }
                    
                    // Reload page after 1.5 seconds to refresh filters
                    setTimeout(function(){
                        window.location.reload();
                    }, 1500);
                }else{
                    msg.style.background = '#ffeaea';
                    msg.style.color = '#c0392b';
                    msg.style.border = '1px solid #e74c3c';
                    msg.style.padding = '12px 18px';
                    msg.style.borderRadius = '8px';
                    msg.style.marginTop = '18px';
                    msg.textContent = res.error || 'Error updating status.';
                    btn.textContent = status === 'reviewed' ? 'Mark Reviewed' : 'Mark Resolved';
                }
                setTimeout(function(){msg.style.display='none';},3000);
            })
            .catch(function(err){
                btn.disabled = false;
                btn.textContent = status === 'reviewed' ? 'Mark Reviewed' : 'Mark Resolved';
                var msg = document.getElementById('report-status-message');
                msg.style.display = 'block';
                msg.style.background = '#ffeaea';
                msg.style.color = '#c0392b';
                msg.style.border = '1px solid #e74c3c';
                msg.style.padding = '12px 18px';
                msg.style.borderRadius = '8px';
                msg.style.marginTop = '18px';
                msg.textContent = 'Network error. Please try again.';
                setTimeout(function(){msg.style.display='none';},3000);
            });
        }
        </script>
</div>
