<?php
require_once dirname(__DIR__, 2) . '/helpers/CancellationPolicyHelper.php';
$pageTitle = 'NestChange - Add Listing';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'New Listing'],
];
$extraHead = '<link rel="stylesheet" href="/css/listings.css">';

function old($key, $default = '', $data = []) {
    return isset($data['old'][$key]) ? htmlspecialchars($data['old'][$key]) : $default;
}

// Helper to check which radio button was checked
function isChecked($key, $value, $data = []) {
    if (!isset($data['old'][$key])) return '';
    $oldVal = $data['old'][$key];
    if (is_array($oldVal)) {
        return in_array($value, $oldVal) ? 'checked' : '';
    }
    return $oldVal == $value ? 'checked' : '';
}

function hasError($key, $errors = []) {
    return isset($errors[$key]) ? 'has-error' : '';
}

function getError($key, $errors = []) {
    if (!isset($errors[$key])) return '';
    $error = $errors[$key];
    if (is_array($error)) {
        $error = $error[0] ?? '';
    }
    return '<span class="error-msg" style="color:red; font-size:0.8em; display:block;">' . htmlspecialchars($error) . '</span>';
}

ob_start();
?>
<section class="form-section">  
    <div class="form-container">
        <h1 class="form-title">
            <span class="form-title-main">New Listing</span>
        </h1>

        <div class="form-box">
            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-error" style="background:#ffe6e6; color:#d00; padding:10px; margin-bottom:20px;">
                    <?= htmlspecialchars($_SESSION['flash_error']) ?>
                    <?php unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <form class="listing-form" action="<?= BASE_URL ?>/listings/create" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <h3 class="step-header">Step 1</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('title', $errors ?? []) ?>">
                    <label>Name of Listing</label>
                    <input type="text" name="title" placeholder="Value" value="<?= old('title', '', $old ?? []) ?>" required>
                    <?= getError('title', $errors ?? []) ?>
                </div>

                <div class="new-form-group <?= hasError('host_role', $errors ?? []) ?>">
                    <label>Do you own or rent?</label>
                    <div class="radio-row">
                        <label><input type="radio" name="host_role" value="renter" <?= isChecked('host_role', 'renter', $old ?? []) ?: (empty($old) ? 'checked' : '') ?>> Rent</label>
                        <label><input type="radio" name="host_role" value="owner" <?= isChecked('host_role', 'owner', $old ?? []) ?>> Own</label>
                    </div>
                    <?= getError('host_role', $errors ?? []) ?>
                </div>

                <div class="new-form-group <?= hasError('verification_document', $errors ?? []) ?>">
                    <label>Upload home ownership documentation (PDF, JPG, PNG)</label>
                    <input type="file" name="verification_document" accept=".pdf,.jpg,.jpeg,.png">
                    <?= getError('verification_document', $errors ?? []) ?>
                </div>

                <h3 class="step-header">Step 2</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('room_type', $errors ?? []) ?>">
                    <label>Room Type</label>
                    <div class="radio-row">
                        <label><input type="radio" name="room_type" value="whole_apartment" <?= isChecked('room_type', 'whole_apartment', $old ?? []) ?>> Whole apartment</label>
                        <label><input type="radio" name="room_type" value="room" <?= isChecked('room_type', 'room', $old ?? []) ?: (empty($old) ? 'checked' : '') ?>> Single room</label>
                    </div>
                     <?= getError('room_type', $errors ?? []) ?>
                </div>
                
                <div class="new-form-group">
                     <label>Max Guests</label>
                     <input type="number" name="max_guests" min="1" value="<?= old('max_guests', '1', $old ?? []) ?>">
                </div>

                <div class="new-form-group address-group">
                    <label>Address</label>
                    <div class="address-grid">
                        <div class="<?= hasError('country', $errors ?? []) ?>">
                            <select name="country" required style="margin-bottom: 5px;">
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $code => $name): ?>
                                    <option value="<?= $code ?>" <?= old('country', '', $old ?? []) === $code ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= getError('country', $errors ?? []) ?>
                        </div>
                        <div class="<?= hasError('address_line', $errors ?? []) ?>">
                             <input type="text" name="address_line" placeholder="Address" value="<?= old('address_line', '', $old ?? []) ?>" style="margin-bottom: 5px;">
                             <?= getError('address_line', $errors ?? []) ?>
                        </div>
                        <div class="<?= hasError('city', $errors ?? []) ?>">
                             <input type="text" name="city" placeholder="City" value="<?= old('city', '', $old ?? []) ?>" required style="margin-bottom: 5px;">
                             <?= getError('city', $errors ?? []) ?>
                        </div>
                    </div>
                    <!-- Coordinates optional -->
                    <!-- Coordinates automatically fetched -->
                </div>

                <div class="new-form-group <?= hasError('images', $errors ?? []) ?>">
                    <label>Upload images</label>
                    <input type="file" name="images[]" multiple accept="image/*">
                    <?= getError('images', $errors ?? []) ?>
                </div>

                <div class="date-row" style="display: flex; gap: 15px;">
                    <div class="new-form-group" style="flex: 1;">
                        <label>Date Available From</label>
                        <input type="date" name="available_from" value="<?= old('available_from', '', $old ?? []) ?>">
                    </div>
                    <div class="new-form-group" style="flex: 1;">
                        <label>Date Available Until (Optional)</label>
                        <input type="date" name="available_until" value="<?= old('available_until', '', $old ?? []) ?>">
                    </div>
                </div>

                <h3 class="step-header">Step 3</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('description', $errors ?? []) ?>">
                    <label>Description</label>
                    <textarea id="description" name="description" placeholder="Value" required><?= old('description', '', $old ?? []) ?></textarea>
                    <?= getError('description', $errors ?? []) ?>
                    <label id="char-error" style="color: red"></label>
                </div>

                <div class="new-form-group <?= hasError('cancellation_policy', $errors ?? []) ?>">
                    <label>Cancellation Policy</label>
                    <div class="radio-row" style="flex-wrap: wrap; gap: 15px;">
                        <?php foreach (CancellationPolicyHelper::getAll() as $policy): ?>
                        <label title="<?= htmlspecialchars(CancellationPolicyHelper::getDescription($policy)) ?>">
                            <input type="radio" name="cancellation_policy" value="<?= $policy ?>" <?= isChecked('cancellation_policy', $policy, $old ?? []) ?: ($policy === 'flexible' ? 'checked' : '') ?>>
                            <?= htmlspecialchars(CancellationPolicyHelper::getLabel($policy)) ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                     <small style="color:#666; display:block; margin-top:5px;">Select a policy to view its terms on your listing.</small>
                    <?= getError('cancellation_policy', $errors ?? []) ?>
                </div>

                <?php if (!empty($attributes)): ?>
                <div class="new-form-group">
                    <label>Amenities & Preferences</label>
                    <div class="tag-box">
                        <?php foreach ($attributes as $category => $attrs): ?>
                            <?php foreach ($attrs as $attr): ?>
                                <label>
                                    <input type="checkbox" name="attributes[]" value="<?= $attr['id'] ?>" <?= isChecked('attributes', $attr['id'], $old ?? []) ?>>
                                    <?= htmlspecialchars($attr['name']) ?>
                                </label>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($services)): ?>
                <div class="new-form-group">
                    <label>Guest Requirements</label>
                    <p style="font-size: 0.85em; color: #666; margin-bottom: 8px;">Select mandatory responsibilities and requirements for guests</p>
                    <div class="tag-box">
                         <?php foreach ($services as $service): ?>
                            <label>
                                <input type="checkbox" name="services[]" value="<?= $service['id'] ?>" <?= isChecked('services', $service['id'], $old ?? []) ?>>
                                <?= htmlspecialchars($service['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <button type="submit" class="new-submit-btn">
                    Validate &amp; Publish
                </button>
            </form>
        </div>
    </div>
</section><script src="/js/listing-creation.js" defer></script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
