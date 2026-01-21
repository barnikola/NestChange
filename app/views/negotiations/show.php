<?php
$pageTitle = 'Negotiate Application - NestChange';
ob_start();

// Identify roles - Use loose comparison and check keys
$currentUserProfileId = $currentUserProfileId ?? null;
$isHost = (isset($listing['profile_id']) && $listing['profile_id'] == $currentUserProfileId);
$roleLabel = $isHost ? 'Host' : 'Guest';
?>

<div class="negotiation-page" style="padding: 40px 20px; background: whitesmoke; min-height: 80vh;">
    <div class="container" style="max-width: 1000px; margin: 0 auto; display: flex; gap: 30px; flex-wrap: wrap;">
        
        <!-- Application Details Sidebar -->
        <div class="app-details" style="flex: 1; min-width: 300px; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); height: fit-content;">
            <h3 style="margin-top: 0; color: #333;">Application Details</h3>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #777; font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Listing</label>
                <a href="<?= BASE_URL ?>/listings/<?= $listing['id'] ?>" style="font-weight: 600; color: var(--color-primary); text-decoration: none;">
                    <?= htmlspecialchars($listing['title']) ?>
                </a>
                <p style="margin: 5px 0 0; color: #666; font-size: 14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:text-bottom;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> <?= htmlspecialchars($listing['city'] ?? '') ?>, <?= htmlspecialchars($listing['country'] ?? '') ?>
                </p>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #777; font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Original Dates</label>
                <div style="font-weight: 500;">
                    <?= date('M d, Y', strtotime($application['start_date'])) ?> &mdash; 
                    <?= date('M d, Y', strtotime($application['end_date'])) ?>
                </div>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #777; font-size: 12px; text-transform: uppercase; margin-bottom: 5px;">Status</label>
                <span class="status-badge status-<?= $application['status'] ?>" style="
                    display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize;
                    background: <?= $application['status'] === 'accepted' ? '#e8f5e9' : ($application['status'] === 'rejected' ? '#ffebee' : '#e3f2fd') ?>;
                    color: <?= $application['status'] === 'accepted' ? '#2e7d32' : ($application['status'] === 'rejected' ? '#c62828' : '#1565c0') ?>;
                ">
                    <?= $application['status'] ?>
                </span>
            </div>

            <div style="margin-top: 25px;">
                <a href="<?= BASE_URL ?>/chat?chat=<?= $chatId ?>" class="btn btn-primary" style="width: 100%; text-align: center; display: block; margin-bottom: 10px; background-color: var(--color-primary); border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> Discuss in Chat
                </a>
                
                <a href="<?= BASE_URL ?>/applications/<?= $application['id'] ?>" class="btn btn-secondary" style="width: 100%; text-align: center; display: block;">Back to Application</a>
            </div>
        </div>

        <!-- Negotiation Timeline -->
        <div class="negotiation-timeline" style="flex: 2; min-width: 300px;">
            <h2 style="margin-top: 0; margin-bottom: 20px;">Negotiation History</h2>

            <?php if (empty($history)): ?>
                <div class="empty-negotiation" style="text-align: center; color: #666; padding: 40px 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:15px;"><path d="M9.1 9a3 3 0 0 1 5.82 1c0 2-3 3-3 3"></path><path d="M12 17h.01"></path><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"></path></svg>
                    <p>No proposals yet. Start negotiation to suggest new dates or terms.</p>
                </div>
            <?php else: ?>
                <div class="timeline" style="position: relative; margin-bottom: 30px;">
                    <?php foreach ($history as $index => $item): ?>
                        <?php 
                            $isMe = ($item['proposer_profile_id'] === $currentUserProfileId);
                            $itemName = $isMe ? 'You' : htmlspecialchars($item['first_name'] . ' ' . $item['last_name']);
                        ?>
                        <div class="timeline-item" style="
                            background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-left: 4px solid <?= $isMe ? 'var(--color-primary)' : '#999' ?>;
                        ">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span style="font-weight: 600; color: #333;"><?= $itemName ?> proposed:</span>
                                <span style="font-size: 12px; color: #999;"><?= date('M d, Y H:i', strtotime($item['created_at'])) ?></span>
                            </div>
                            
                            <div style="display: flex; gap: 20px; font-size: 14px; color: #555; margin-bottom: 10px;">
                                <?php if ($item['proposed_start_date']): ?>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:text-bottom;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> 
                                        <?= date('M d, Y', strtotime($item['proposed_start_date'])) ?> - <?= date('M d, Y', strtotime($item['proposed_end_date'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($item['terms']): ?>
                                <div style="font-size: 14px; background: #f9f9f9; padding: 10px; border-radius: 6px; color: #444; word-wrap: break-word; overflow-wrap: break-word;">
                                    <?= nl2br(htmlspecialchars($item['terms'])) ?>
                                </div>
                            <?php endif; ?>

                            <div style="margin-top: 15px; font-size: 13px;">
                                Status: 
                                <span style="font-weight: 600; color: <?= $item['status'] === 'accepted' ? 'green' : ($item['status'] === 'rejected' ? 'red' : 'orange') ?>">
                                    <?= ucfirst($item['status']) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Action Area -->
            <div class="action-area" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                
                <?php if ($application['status'] === 'accepted'): ?>
                    <div style="text-align: center; padding: 40px 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <h3 style="color: #2e7d32; margin-top: 0;">Negotiation Completed</h3>
                        <p style="color: #666;">The terms have been accepted. You can now proceed with the exchange.</p>
                        <a href="<?= BASE_URL ?>/applications/<?= $application['id'] ?>" class="btn btn-submit" style="margin-top: 20px;">View Application</a>
                    </div>
                <?php else: ?>
                    <?php if ($activeProposal): ?>
                        <?php if ($activeProposal['proposer_profile_id'] !== $currentUserProfileId): ?>
                            <h3 style="margin-top: 0;">Respond to Proposal</h3>
                            <p style="color: #666; margin-bottom: 20px;">The other party has proposed new terms. You can accept, reject, or make a counter-proposal.</p>
                            
                            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                                <form action="<?= BASE_URL ?>/negotiations/<?= $activeProposal['id'] ?>/respond" method="POST">
                                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-primary" style="background: #4CAF50; border-color: #4CAF50;">Accept Proposal</button>
                                </form>
                                
                                <form action="<?= BASE_URL ?>/negotiations/<?= $activeProposal['id'] ?>/respond" method="POST">
                                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger" style="background: #f44336; border-color: #f44336;">Reject</button>
                                </form>
                            </div>
                            
                            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                            <h4>Or Counter-Propose</h4>
                        <?php else: ?>
                            <div style="text-align: center; padding: 20px; background: #fff8e1; border-radius: 8px; color: #f57f17;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:5px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> You have a pending proposal. Waiting for the other party to respond.
                            </div>
                            <h4 style="margin-top: 20px;">Update Proposal / Counter Again</h4>
                        <?php endif; ?>
                    <?php else: ?>
                        <h3 style="margin-top: 0;"><?= empty($history) ? 'Initiate Negotiation' : 'Make a New Proposal' ?></h3>
                        <p style="color: #666; margin-bottom: 20px;">Propose new dates or terms for this request.</p>
                    <?php endif; ?>

                    <?php if (!$activeProposal || $activeProposal['proposer_profile_id'] !== $currentUserProfileId || true): ?>
                        <form action="<?= BASE_URL ?>/applications/<?= $application['id'] ?>/negotiate" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            
                            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" 
                                        value="<?= $activeProposal['proposed_start_date'] ?? $application['start_date'] ?>" required>
                                </div>
                                <div style="flex: 1;">
                                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">End Date</label>
                                    <input type="date" name="end_date" class="form-control" 
                                        value="<?= $activeProposal['proposed_end_date'] ?? $application['end_date'] ?>" required>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Terms & Special Requests</label>
                                <textarea name="terms" class="form-control" rows="4" placeholder="Propose new terms, conditions, or any special requests..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-submit">Submit Proposal</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/main.php';
?>
