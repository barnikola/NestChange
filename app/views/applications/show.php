<?php
$pageTitle = 'Application Details - NestChange';
ob_start();
?>
<style>
        .detail-section {
            padding: 60px 40px;
            background-color: #f5f5f5;
            min-height: calc(100vh - 200px);
        }
        
        .detail-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .detail-title h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .meta-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .meta-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .meta-label {
            font-size: 12px;
            text-transform: uppercase;
            color: #888;
            font-weight: 600;
        }

        .meta-value {
            font-size: 16px;
            font-weight: 500;
        }

        .message-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #eee;
            margin-top: 20px;
        }

        /* TIMELINE STYLES */
        .timeline-container {
            margin: 40px 0;
            padding: 20px 0;
        }

        .timeline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        /* The line behind the steps */
        .timeline::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
        }

        /* Progress line */
        .timeline-progress {
            position: absolute;
            top: 15px;
            left: 0;
            height: 2px;
            background: #000; /* Active color */
            z-index: 1;
            transition: width 0.3s ease;
        }

        .timeline-step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            background: white; /* Hide line behind circle */
            padding: 0 10px;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: #ccc;
            transition: all 0.3s ease;
        }

        .step-label {
            font-size: 13px;
            font-weight: 500;
            color: #999;
            text-transform: uppercase;
        }

        /* Active/Completed States */
        .timeline-step.active .step-circle {
            border-color: #000;
            color: #000;
        }
        .timeline-step.active .step-label {
            color: #000;
            font-weight: 700;
        }

        .timeline-step.completed .step-circle {
            background: #000;
            border-color: #000;
            color: #fff;
        }
        .timeline-step.completed .step-label {
            color: #000;
        }

        .timeline-step.rejected .step-circle {
            background: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        .timeline-step.rejected .step-label {
            color: #dc3545;
        }

        /* Action Buttons */
        .action-bar {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .btn-outline {
            padding: 12px 24px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-danger {
            background: #fff;
            border-color: #dc3545;
            color: #dc3545;
        }
        .btn-danger:hover {
            background: #dc3545;
            color: white;
        }
    </style>

    <div class="detail-section">
        <div class="detail-container">
            
            <a href="javascript:history.back()" style="display:inline-block; margin-bottom:20px; color:#666;">&larr; Back</a>

            <div class="detail-card">
                <!-- Visual Timeline -->
                <?php
                    $status = strtolower($application['status'] ?? 'pending');
                    
                    // Logic to determine active step
                    $step1Class = 'completed'; // Submitted is always done
                    $step2Class = '';
                    $step3Class = '';
                    $progressWidth = '33%'; // Default at step 1

                    if ($status === 'pending') {
                        $step2Class = 'active';
                        $progressWidth = '50%';
                    } elseif ($status === 'accepted') {
                        $step2Class = 'completed';
                        $step3Class = 'completed';
                        $progressWidth = '100%';
                    } elseif ($status === 'rejected') {
                        $step2Class = 'completed';
                        $step3Class = 'rejected';
                        $progressWidth = '100%';
                    } elseif ($status === 'withdrawn') {
                        $step2Class = 'completed';
                        $step3Class = 'active';
                        $progressWidth = '100%'; 
                    }
                ?>
                <div class="timeline-container">
                    <div class="timeline">
                        <div class="timeline-progress" style="width: <?php echo $progressWidth; ?>;"></div>
                        
                        <div class="timeline-step <?php echo $step1Class; ?>">
                            <div class="step-circle">1</div>
                            <div class="step-label">Submitted</div>
                        </div>
                        
                        <div class="timeline-step <?php echo $step2Class; ?>">
                            <div class="step-circle">2</div>
                            <div class="step-label">Under Review</div>
                        </div>
                        
                        <div class="timeline-step <?php echo $step3Class; ?>">
                            <?php if($status === 'rejected'): ?>
                                <div class="step-circle">✖</div>
                                <div class="step-label">Rejected</div>
                            <?php elseif($status === 'withdrawn'): ?>
                                <div class="step-circle">-</div>
                                <div class="step-label">Withdrawn</div>
                            <?php else: ?>
                                <div class="step-circle">3</div>
                                <div class="step-label">Decision</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="detail-header">
                    <div class="detail-title">
                        <h1>Application #<?php echo substr($application['id'], 0, 8); ?></h1>
                        <p style="color:#666;">Applied on <?php echo date('j F , Y', strtotime($application['created_at'])); ?></p>
                    </div>
                    <span class="status-badge status-<?php echo $status; ?>" style="font-size:16px; padding:10px 20px; background:#f0f0f0;">
                        <?php echo ucfirst($status); ?>
                    </span>
                </div>

                <div class="meta-info">
                    <div class="detail-row">
                        <span class="detail-label">Requested Dates</span>
                        <span class="detail-value">
                            <?php 
                                $start = !empty($application['start_date']) && $application['start_date'] !== '0000-00-00' ? date('d M, Y', strtotime($application['start_date'])) : 'TBD';
                                $end = !empty($application['end_date']) && $application['end_date'] !== '0000-00-00' ? date('d M, Y', strtotime($application['end_date'])) : 'Indefinite';
                                echo $start . ' — ' . $end;
                            ?>
                        </span>
                    </div>
                </div>

                <div class="meta-group">
                    <span class="meta-label">Message</span>
                    <div class="message-box">
                        <?php echo nl2br(htmlspecialchars($application['message'] ?? 'No message provided.')); ?>
                    </div>
                </div>

                <!-- Actions -->
                <?php if ($status === 'pending'): ?>
                    <form method="post" class="action-bar">
                        <input type="hidden" name="csrf_token" value="<?php echo Session::getCsrfToken(); ?>">
                        
                        <?php if ($isHost): ?>
                            <button formaction="/applications/<?php echo $application['id']; ?>/accept" class="btn-submit" onclick="return confirm('Accept this application?')">Accept</button>
                            <button formaction="/applications/<?php echo $application['id']; ?>/reject" class="btn-outline btn-danger" onclick="return confirm('Reject this application?')">Reject</button>
                        <?php elseif ($isApplicant): ?>
                            <button formaction="/applications/<?php echo $application['id']; ?>/withdraw" class="btn-outline" onclick="return confirm('Withdraw application?')">Withdraw</button>
                        <?php endif; ?>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
