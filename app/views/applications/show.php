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
            background: white;
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
                    
                    $step1Class = 'completed';
                    $step2Class = '';
                    $step3Class = '';
                    $progressWidth = '33%';

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
                    
                    // CANCELLATION INFO
                    require_once __DIR__ . '/../../helpers/CancellationPolicyHelper.php';
                    $cancelPolicy = $application['cancellation_policy'] ?? 'flexible';
                    $startDate = $application['start_date'] ?? null;
                    $cancelEligibility = null;
                    if ($startDate && $status === 'accepted') {
                         $cancelEligibility = CancellationPolicyHelper::checkEligibility($cancelPolicy, $startDate);
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
                        
                        <a href="/applications/<?php echo htmlspecialchars($application['id']); ?>/negotiate" class="btn-outline" style="text-decoration:none; color:#333; display:flex; align-items:center; justify-content:center;">
                            Negotiate Terms
                        </a>

                        <?php if ($isHost): ?>
                            <button formaction="/applications/<?php echo htmlspecialchars($application['id']); ?>/accept" class="btn-submit" onclick="return confirm('Accept this application?')">Accept</button>
                            <button formaction="/applications/<?php echo htmlspecialchars($application['id']); ?>/reject" class="btn-outline btn-danger" onclick="return confirm('Reject this application?')">Reject</button>
                        <?php elseif ($isApplicant): ?>
                            <button formaction="/applications/<?php echo htmlspecialchars($application['id']); ?>/withdraw" class="btn-outline" onclick="return confirm('Withdraw application?')">Withdraw</button>
                        <?php endif; ?>
                    </form>
                <?php elseif ($status === 'accepted'): ?>
                    <div class="action-bar" style="justify-content: flex-end; gap: 15px; margin-bottom: 20px; border-top: none; padding-top: 0;">
                         <a href="/applications/<?php echo htmlspecialchars($application['id']); ?>/negotiate" class="btn-outline" style="text-decoration:none; color:#333; display:flex; align-items:center; justify-content:center;">
                            View Negotiation History
                        </a>
                    </div>
                    <?php if ($isApplicant): ?>
                        <!-- APPLICANT VIEW -->
                        <?php if($cancelEligibility): ?>
                            <div class="meta-group" style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px;">
                                <span class="meta-label">Cancellation Policy</span>
                                <div class="meta-value">
                                    <?php echo ucfirst($cancelPolicy); ?> 
                                    <span style="font-size: 14px; color: #666; font-weight: normal;">
                                        (<?php echo $cancelEligibility['message']; ?>)
                                    </span>
                                </div>
                            </div>
                            
                            <form id="cancelForm" method="post" class="action-bar" action="/applications/<?php echo $application['id']; ?>/cancel">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::getCsrfToken(); ?>">
                                <button type="button" class="btn-outline btn-danger" onclick="openCancelModal()">
                                    Cancel Booking
                                </button>
                            </form>
                        <?php else: ?>
                            <!-- Fallback -->
                             <form method="post" class="action-bar" action="/applications/<?php echo htmlspecialchars($application['id']); ?>/cancel">
                                <input type="hidden" name="csrf_token" value="<?php echo Session::getCsrfToken(); ?>">
                                <button type="submit" class="btn-outline btn-danger" onclick="return confirm('Are you sure you want to cancel?')">Cancel Booking</button>
                            </form>
                        <?php endif; ?>

                    <?php elseif ($isHost): ?>
                        <!-- HOST VIEW -->
                        <div class="meta-group" style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 20px;">
                            <span class="meta-label">Actions</span>
                            <div class="meta-value">
                                <form id="cancelFormHost" method="post" action="/applications/<?php echo htmlspecialchars($application['id']); ?>/cancel">
                                    <input type="hidden" name="csrf_token" value="<?php echo Session::getCsrfToken(); ?>">
                                    <button type="button" class="btn-outline btn-danger" onclick="openCancelModalHost()">
                                        Cancel Booking (Host)
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Cancellation Modal structure -->
    <?php if (isset($cancelEligibility) && $cancelEligibility): ?>
    <div id="cancelModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Cancel Application</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel your booking for <strong><?php echo htmlspecialchars($application['listing_title']); ?></strong>?</p>
                
                <div class="policy-highlight">
                    <p><strong>Cancellation Policy:</strong> <?php echo ucfirst($cancelPolicy); ?></p>
                    <p class="refund-text"><?php echo $cancelEligibility['message']; ?></p>
                </div>
                
                <p>This action cannot be undone.</p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeCancelModal()">Keep Application</button>
                <button type="button" class="btn-modal-confirm" onclick="confirmCancel()">Confirm Cancel</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Host Cancellation Modal -->
    <?php if ($isHost && $status === 'accepted'): ?>
    <div id="cancelModalHost" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Cancel Guest Booking</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this booking for <strong><?php echo htmlspecialchars($application['applicant_name'] ?? 'Guest'); ?></strong>?</p>
                
                <div class="policy-highlight">
                    <p><strong>Note:</strong> Cancelling a confirmed booking will trigger a <strong>Full Refund</strong> to the guest.</p>
                </div>
                
                <p>Please ensure you have communicated with the guest before proceeding.</p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeCancelModalHost()">Keep Booking</button>
                <button type="button" class="btn-modal-confirm" onclick="confirmCancelHost()">Confirm Cancel</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        function openCancelModal() {
            document.getElementById('cancelModal').classList.add('active');
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').classList.remove('active');
        }

        function confirmCancel() {
            document.getElementById('cancelForm').submit();
        }
        
        function openCancelModalHost() {
            document.getElementById('cancelModalHost').classList.add('active');
        }
        function closeCancelModalHost() {
            document.getElementById('cancelModalHost').classList.remove('active');
        }
        function confirmCancelHost() {
            document.getElementById('cancelFormHost').submit();
        }
        
        // Close modal if clicked outside
        document.getElementById('cancelModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCancelModal();
            }
        });
        
        const hostModal = document.getElementById('cancelModalHost');
        if (hostModal) {
            hostModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCancelModalHost();
                }
            });
        }
    </script>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
