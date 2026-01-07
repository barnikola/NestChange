<?php
$pageTitle = 'NestChange - Edit Listing';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Listings', 'url' => '/my-listings'],
    ['label' => 'Edit Listing'],
];
$extraHead = '<link rel="stylesheet" href="/css/listings.css">';

function old($key, $default = '', $listing = []) {
    return isset($listing[$key]) ? htmlspecialchars($listing[$key]) : $default;
}

function isChecked($key, $value, $listing = []) {
    if (!isset($listing[$key])) return '';
    $oldVal = $listing[$key];
    if (is_array($oldVal)) {
        return in_array($value, $oldVal) ? 'checked' : '';
    }
    return $oldVal == $value ? 'checked' : '';
}

function hasAttr($attrId, $listingAttrs = []) {
    foreach ($listingAttrs as $attr) {
        if ($attr['id'] == $attrId) return 'checked';
    }
    return '';
}

function hasService($serviceId, $listingServices = []) {
    foreach ($listingServices as $service) {
        if ($service['id'] == $serviceId) return 'checked';
    }
    return '';
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
    <div class="form-container" style="max-width: 800px;">
        <h1 class="form-title">
            <span class="form-title-main">Edit Listing</span>
        </h1>

        <div class="form-box">
            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-error" style="background:#ffe6e6; color:#d00; padding:10px; margin-bottom:20px; border-radius: 8px;">
                    <?= htmlspecialchars($_SESSION['flash_error']) ?>
                    <?php unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['flash_success'])): ?>
                <div class="alert alert-success" style="background:#e6ffe6; color:#090; padding:10px; margin-bottom:20px; border-radius: 8px;">
                    <?= htmlspecialchars($_SESSION['flash_success']) ?>
                    <?php unset($_SESSION['flash_success']); ?>
                </div>
            <?php endif; ?>

            <!-- Current Status Badge -->
            <div style="margin-bottom: 20px;">
                <span class="details-badge" style="
                    background: <?= $listing['status'] === 'published' ? '#e5f7ec' : ($listing['status'] === 'paused' ? '#fff3cd' : '#f0f0f0') ?>;
                    color: <?= $listing['status'] === 'published' ? '#1f8a4c' : ($listing['status'] === 'paused' ? '#856404' : '#666') ?>;
                ">
                    Status: <?= ucfirst(htmlspecialchars($listing['status'])) ?>
                </span>
            </div>

            <form class="listing-form" action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <h3 class="step-header">Basic Information</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('title', $errors ?? []) ?>">
                    <label>Name of Listing</label>
                    <input type="text" name="title" placeholder="Enter listing title" value="<?= old('title', '', $listing) ?>" required>
                    <?= getError('title', $errors ?? []) ?>
                </div>

                <div class="new-form-group <?= hasError('host_role', $errors ?? []) ?>">
                    <label>Do you own or rent?</label>
                    <div class="radio-row">
                        <label><input type="radio" name="host_role" value="renter" <?= isChecked('host_role', 'renter', $listing) ?>> Rent</label>
                        <label><input type="radio" name="host_role" value="owner" <?= isChecked('host_role', 'owner', $listing) ?>> Own</label>
                    </div>
                    <?= getError('host_role', $errors ?? []) ?>
                </div>

                <div class="new-form-group <?= hasError('verification_document', $errors ?? []) ?>">
                    <label>Upload new verification document (optional - PDF, JPG, PNG)</label>
                    <input type="file" name="verification_document" accept=".pdf,.jpg,.jpeg,.png">
                    <?= getError('verification_document', $errors ?? []) ?>
                </div>

                <h3 class="step-header">Property Details</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('room_type', $errors ?? []) ?>">
                    <label>Room Type</label>
                    <div class="radio-row">
                        <label><input type="radio" name="room_type" value="whole_apartment" <?= isChecked('room_type', 'whole_apartment', $listing) ?>> Whole apartment</label>
                        <label><input type="radio" name="room_type" value="room" <?= isChecked('room_type', 'room', $listing) ?>> Single room</label>
                    </div>
                    <?= getError('room_type', $errors ?? []) ?>
                </div>
                
                <div class="new-form-group">
                    <label>Max Guests</label>
                    <input type="number" name="max_guests" min="1" value="<?= old('max_guests', '1', $listing) ?>">
                </div>

                <div class="new-form-group address-group">
                    <label>Address</label>
                    <div class="address-grid">
                        <div class="<?= hasError('country', $errors ?? []) ?>">
                            <select name="country" required style="margin-bottom: 8px;">
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $code => $name): ?>
                                    <option value="<?= $code ?>" <?= old('country', '', $listing) === $code ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= getError('country', $errors ?? []) ?>
                        </div>
                        <div class="<?= hasError('address_line', $errors ?? []) ?>">
                            <input type="text" name="address_line" placeholder="Address" value="<?= old('address_line', '', $listing) ?>" style="margin-bottom: 8px;">
                            <?= getError('address_line', $errors ?? []) ?>
                        </div>
                        <div class="<?= hasError('city', $errors ?? []) ?>">
                            <input type="text" name="city" placeholder="City" value="<?= old('city', '', $listing) ?>" required>
                            <?= getError('city', $errors ?? []) ?>
                        </div>
                    </div>
                </div>

                <!-- Current Images -->
                <?php if (!empty($listing['images'])): ?>
                <div class="new-form-group">
                    <label>Current Images</label>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 8px;">
                        <?php foreach ($listing['images'] as $img): ?>
                            <div class="listing-image-item" style="position: relative; border-radius: 8px; overflow: hidden;">
                                <img src="/<?= ltrim($img['image'], '/') ?>" 
                                     alt="Listing image" 
                                     style="width: 100%; height: 100px; object-fit: cover;">
                                <button type="button" 
                                        class="delete-image-btn"
                                        data-image-id="<?= htmlspecialchars($img['id']) ?>"
                                        style="position: absolute; top: 5px; right: 5px; background: rgba(217, 83, 79, 0.9); color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 14px; line-height: 1;">
                                    &times;
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="new-form-group <?= hasError('images', $errors ?? []) ?>">
                    <label>Add More Images</label>
                    <input type="file" name="images[]" multiple accept="image/*">
                    <?= getError('images', $errors ?? []) ?>
                </div>

                <?php 
                // Get existing availability
                $fromVal = '';
                $untilVal = '';
                if (!empty($listing['availability']) && isset($listing['availability'][0])) {
                    $fromVal = $listing['availability'][0]['available_from'];
                    $untilVal = $listing['availability'][0]['available_until'];
                }
                ?>
                <div class="date-row" style="display: flex; gap: 15px;">
                    <div class="new-form-group" style="flex: 1;">
                        <label>Date Available From</label>
                        <input type="date" name="available_from" value="<?= old('available_from', $fromVal, $listing) ?>">
                    </div>
                    <div class="new-form-group" style="flex: 1;">
                        <label>Date Available Until (Optional)</label>
                        <input type="date" name="available_until" value="<?= old('available_until', $untilVal, $listing) ?>">
                    </div>
                </div>

                <h3 class="step-header">Description & Features</h3>
                <div class="step-line"></div>

                <div class="new-form-group <?= hasError('description', $errors ?? []) ?>">
                    <label>Description</label>
                    <textarea name="description" placeholder="Describe your listing" required style="min-height: 150px;"><?= old('description', '', $listing) ?></textarea>
                    <?= getError('description', $errors ?? []) ?>
                </div>

                <?php if (!empty($attributes)): ?>
                <div class="new-form-group">
                    <label>Amenities & Preferences</label>
                    <div class="tag-box">
                        <?php foreach ($attributes as $category => $attrs): ?>
                            <?php foreach ($attrs as $attr): ?>
                                <label>
                                    <input type="checkbox" name="attributes[]" value="<?= $attr['id'] ?>" <?= hasAttr($attr['id'], $listing['attributes'] ?? []) ?>>
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
                                <input type="checkbox" name="services[]" value="<?= $service['id'] ?>" <?= hasService($service['id'], $listing['services'] ?? []) ?>>
                                <?= htmlspecialchars($service['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <a href="<?= BASE_URL ?>/my-listings" 
                       style="text-align: center; background: #f5f5f5; color: #333; border: 1px solid #ddd; padding: 16px; border-radius: 8px; cursor: pointer; display: inline-block; font-size: 17px; line-height: 1; flex: 1;">
                        Cancel
                    </a>
                    <button type="submit" class="new-submit-btn" style="flex: 2; margin-top: 0;">
                        Save Changes
                    </button>
                </div>
            </form>

            <!-- Quick Actions -->
            <?php 
            require_once dirname(dirname(__DIR__)) . '/core/session.php';
            Session::start();
            $user = Session::getUser();
            $isModerator = $user && in_array($user['role'], ['moderator', 'admin']);
            ?>
            <div class="details-buttons" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #e5e5e5; gap: 20px;">
                <?php if ($isModerator && ($listing['status'] === 'draft' || $listing['status'] === 'paused')): ?>
                    <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/publish" method="POST" style="flex: 1;">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <button type="submit" class="details-btn" style="width: 100%; background: #1f8a4c; color: #fff; border-color: #1f8a4c;">
                            Publish Listing
                        </button>
                    </form>
                <?php endif; ?>

                <?php if ($listing['status'] === 'published'): ?>
                    <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/pause" method="POST" style="flex: 1;">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <button type="submit" class="details-btn" style="width: 100%; background: #f0ad4e; color: #fff; border-color: #f0ad4e;">
                            Pause Listing
                        </button>
                    </form>
                <?php endif; ?>

                <?php if ($listing['status'] === 'paused'): ?>
                    <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/unpause" method="POST" style="flex: 1;">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <button type="submit" class="details-btn" style="width: 100%; background: #1f8a4c; color: #fff; border-color: #1f8a4c;">
                            Unpause Listing
                        </button>
                    </form>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/delete" method="POST" 
                      style="flex: 1;" 
                      onsubmit="return confirm('Are you sure you want to delete this listing? This action cannot be undone.');">
                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                    <button type="submit" class="details-btn" style="width: 100%; background: #d9534f; color: #fff; border-color: #d9534f;">
                        Delete Listing
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
$listingEditConfig = [
    'baseUrl' => BASE_URL,
    'csrfToken' => $csrf_token,
    'listingId' => $listing['id'],
];
?>
<script id="listing-edit-config" type="application/json">
<?php echo json_encode($listingEditConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>
</script>
<script src="/js/listings-edit.js" defer></script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
