<?php
/**
 * Chat Action Card Partial
 * 
 * This partial displays action cards in the chat panel based on the exchange status.
 * It is conditionally included when an application exists and requires user action.
 * 
 * Required variables:
 * @var array  $actionCard - Contains action card configuration:
 *   - 'type'           : string - Type of action ('exchange_response', 'host_pending', 'guest_pending', 'get_started')
 *   - 'eyebrow'        : string - Small text above title
 *   - 'title'          : string - Main title
 *   - 'text'           : string - Description text
 *   - 'other_name'     : string - Name of the other participant
 *   - 'application_id' : string - Application ID for action URLs
 *   - 'primary_action' : array  - Primary button config ['label' => '', 'url' => '', 'action' => '']
 *   - 'secondary_action': array - Secondary button config ['label' => '', 'url' => '', 'action' => '']
 * 
 * TODO: Implement the following conditions in ChatController before including this partial:
 * 
 * 1. Host receives application -> Host can Accept/Decline
 *    Condition: application_status === 'pending' && current_user_role === 'host'
 * 
 * 2. Host accepts -> Guest can Confirm/Decline the exchange
 *    Condition: application_status === 'accepted' && current_user_role === 'applicant' && !guest_confirmed
 * 
 * 3. Guest accepts -> Show confirmation message
 *    Condition: application_status === 'accepted' && guest_confirmed && host_confirmed
 * 
 * 4. Either party declines -> Show declined message
 *    Condition: application_status === 'rejected' || application_status === 'cancelled'
 * 
 * Implementation by: [Team member implementing application flow]
 */

// Default empty state if no action card data provided
if (!isset($actionCard) || empty($actionCard)) {
    return; // Don't render anything if no action card is needed
}
?>

<div class="chat-action-card" data-action-type="<?= htmlspecialchars($actionCard['type'] ?? 'default') ?>">
    <div class="chat-action-content">
        <p class="chat-action-eyebrow"><?= htmlspecialchars($actionCard['eyebrow'] ?? 'Action required') ?></p>
        <h4 class="chat-action-title"><?= htmlspecialchars($actionCard['title'] ?? 'Respond to request') ?></h4>
        <p class="chat-action-text">
            <?= htmlspecialchars($actionCard['text'] ?? 'Please respond to this request.') ?>
        </p>
    </div>
    <div class="chat-action-buttons">
        <?php if (!empty($actionCard['primary_action'])): ?>
            <?php 
                $primaryAction = $actionCard['primary_action'];
                $primaryUrl = $primaryAction['url'] ?? '#';
                $primaryLabel = $primaryAction['label'] ?? 'Confirm';
            ?>
            <form method="POST" action="<?= htmlspecialchars($primaryUrl) ?>" style="display: inline;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                <button type="submit" class="chat-action-btn primary">
                    <?= htmlspecialchars($primaryLabel) ?>
                </button>
            </form>
        <?php endif; ?>
        
        <?php if (!empty($actionCard['secondary_action'])): ?>
            <?php 
                $secondaryAction = $actionCard['secondary_action'];
                $secondaryUrl = $secondaryAction['url'] ?? '#';
                $secondaryLabel = $secondaryAction['label'] ?? 'Decline';
            ?>
            <form method="POST" action="<?= htmlspecialchars($secondaryUrl) ?>" style="display: inline;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::getCsrfToken()) ?>">
                <button type="submit" class="chat-action-btn ghost" onclick="return confirm('<?= $secondaryLabel === 'Decline' ? 'Reject this application?' : 'Are you sure?' ?>')">
                    <?= htmlspecialchars($secondaryLabel) ?>
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
