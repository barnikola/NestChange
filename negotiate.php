<?php
require_once dirname(__DIR__, 2) . '/core/session.php';
Session::start();

$status = $application['status'] ?? 'pending';
$currentStartDate = $application['start_date'] ?? '';
$currentEndDate = $application['end_date'] ?? '';

ob_start();
?>
<div class="container">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h1>Negotiate Application Terms</h1>
                <p class="subtitle">Listing:
                    <?php echo htmlspecialchars($application['listing_title'] ?? 'N/A'); ?>
                </p>
            </div>

            <div class="card-body">
                <!-- Current Terms -->
                <div class="section">
                    <h2>Current Application Terms</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Start Date:</span>
                            <span class="value">
                                <?php echo $currentStartDate ? date('M d, Y', strtotime($currentStartDate)) : 'Not set'; ?>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">End Date:</span>
                            <span class="value">
                                <?php echo $currentEndDate ? date('M d, Y', strtotime($currentEndDate)) : 'Not set'; ?>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">Status:</span>
                            <span class="value status-<?php echo $status; ?>">
                                <?php echo ucfirst($status); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Negotiation History -->
                <?php if (!empty($history)): ?>
                    <div class="section">
                        <h2>Negotiation History</h2>
                        <div class="negotiation-history">
                            <?php foreach ($history as $entry): ?>
                                <div class="negotiation-entry">
                                    <div class="entry-header">
                                        <strong>
                                            <?php echo htmlspecialchars($entry['first_name'] . ' ' . $entry['last_name']); ?>
                                        </strong>
                                        <span class="entry-date">
                                            <?php echo date('M d, Y H:i', strtotime($entry['created_at'])); ?>
                                        </span>
                                    </div>
                                    <div class="entry-body">
                                        <div class="entry-dates">
                                            <span>Start:
                                                <?php echo date('M d, Y', strtotime($entry['start_date'])); ?>
                                            </span>
                                            <span>End:
                                                <?php echo date('M d, Y', strtotime($entry['end_date'])); ?>
                                            </span>
                                        </div>
                                        <?php if ($entry['message']): ?>
                                            <p class="entry-message">
                                                <?php echo nl2br(htmlspecialchars($entry['message'])); ?>
                                            </p>
                                        <?php endif; ?>
                                        <span class="entry-status status-<?php echo $entry['status']; ?>">
                                            <?php echo ucfirst($entry['status']); ?>
                                        </span>

                                        <?php if ($entry['status'] === 'pending' && $entry['sender_profile_id'] !== ($user['profile_id'] ?? null)): ?>
                                            <form method="post" action="/negotiations/<?php echo $entry['id']; ?>/accept"
                                                style="margin-top: 10px;">
                                                <input type="hidden" name="csrf_token"
                                                    value="<?php echo Session::getCsrfToken(); ?>">
                                                <button type="submit" class="btn-submit btn-small"
                                                    onclick="return confirm('Accept this offer?')">Accept Offer</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Propose New Terms -->
                <div class="section">
                    <h2>Propose New Terms</h2>
                    <form method="post" action="/applications/<?php echo $application['id']; ?>/negotiate"
                        class="negotiation-form">
                        <input type="hidden" name="csrf_token" value="<?php echo Session::getCsrfToken(); ?>">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date"
                                    value="<?php echo $currentStartDate; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" value="<?php echo $currentEndDate; ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message (Optional)</label>
                            <textarea id="message" name="message" rows="4"
                                placeholder="Add a message to explain your proposal..."></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Send Proposal</button>
                            <a href="/applications/<?php echo $application['id']; ?>" class="btn-outline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .section:last-child {
        border-bottom: none;
    }

    .section h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #1f2937;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-item .label {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
    }

    .info-item .value {
        font-size: 1rem;
        color: #111827;
        font-weight: 600;
    }

    .negotiation-history {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .negotiation-entry {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 1rem;
    }

    .entry-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .entry-date {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .entry-body {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .entry-dates {
        display: flex;
        gap: 1.5rem;
        font-size: 0.875rem;
        color: #374151;
    }

    .entry-message {
        margin: 0.5rem 0;
        padding: 0.75rem;
        background: white;
        border-radius: 4px;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .entry-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-accepted {
        background: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .negotiation-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
    }

    .form-group input,
    .form-group textarea {
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 1rem;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .btn-small {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
</style>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>