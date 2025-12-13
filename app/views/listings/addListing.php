<?php
$pageTitle = 'NestChange - Add Listing';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'New Listing'],
];

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

        <?php if (isset($alert) && $alert): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #f5c6cb;">
                <?= $alert ?>
            </div>
        <?php endif; ?>

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
                        <label><input type="radio" name="host_role" value="renter" <?= isChecked('host_role', 'renter', $old ?? []) ?>> Rent</label>
                        <label><input type="radio" name="host_role" value="owner" <?= isChecked('host_role', 'owner', $old ?? []) ?>> Own</label>
                    </div>
                    <?= getError('host_role', $errors ?? []) ?>
                </div>

                <div class="new-form-group">
                    <label>Upload home ownership documentation</label>
                    <input type="file" name="verification_doc" id="doc-upload" accept=".pdf, image/*" required>
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
                        <label><input type="radio" name="room_type" value="room" <?= isChecked('room_type', 'room', $old ?? []) ?>> Single room</label>
                    </div>
                     <?= getError('room_type', $errors ?? []) ?>
                </div>
                
                <div class="new-form-group">
                     <label>Max Guests</label>
                     <input type="number" name="max_guests" min="1" value="<?= old('max_guests', '1', $old ?? []) ?>">
                </div>

                <div class="new-form-group">
                    <label>Max Guests</label>
                    <input type="number" name="max_guests" value="1" min="1" style="width: 100px;">
                </div>
                
                <div class="new-form-group">
                    <label>Address</label>
                    <select name="country" required>
                        <option value="">Select Country</option>
                        <option value="France">France</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Croatia">Croatia</option>
                        <option value="India">India</option>
                    </select>
                    <input type="text" name="address_line" placeholder="Address" required>
                    <input type="text" placeholder="City" name="city" required>
                    <div class="<?= hasError('country', $errors ?? []) ?>">
                        <input type="text" name="country" placeholder="Country" value="<?= old('country', '', $old ?? []) ?>" required style="margin-bottom: 5px;">
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

                <div class="new-form-group <?= hasError('images', $errors ?? []) ?>">
                    <label>Upload images</label>
                    <input type="file" name="images[]" multiple accept="image/*">
                    <?= getError('images', $errors ?? []) ?>
                </div>

                <div class="new-form-group">
                    <label>Date Available From</label>
                    <input type="date" name="available_from" value="<?= old('available_from', '', $old ?? []) ?>">
                </div>
                <div class="new-form-group">
                    <label>Date Available Until</label>
                    <input type="date" name="available_until" value="<?= old('available_until', '', $old ?? []) ?>">
                </div>

                <h3 class="step-header">Step 3</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('description', $errors ?? []) ?>">
                    <label>Description</label>
                    <textarea name="description" placeholder="Value" required><?= old('description', '', $old ?? []) ?></textarea>
                    <?= getError('description', $errors ?? []) ?>
                </div>

                <?php if (!empty($attributes)): ?>
                <div class="new-form-group">
                    <label>Amenities & Preferences</label>
                    <div class="tag-box" style="display: flex; flex-wrap: wrap; gap: 5px;">
                        <?php foreach ($attributes as $category => $attrs): ?>
                            <?php foreach ($attrs as $attr): ?>
                                <label style="background: #f0f0f0; padding: 5px 10px; border-radius: 15px; font-size: 0.9em; cursor: pointer;">
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
                    <label>Services</label>
                    <div class="tag-box" style="display: flex; flex-wrap: wrap; gap: 5px;">
                         <?php foreach ($services as $service): ?>
                            <label style="background: #f0f0f0; padding: 5px 10px; border-radius: 15px; font-size: 0.9em; cursor: pointer;">
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
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
