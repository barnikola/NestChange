<?php
$pageTitle = 'NestChange - Add Listing';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'New Listing'],
];

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
            <form class="listing-form" action="/NestChange/public/index.php?target=listings&function=add" method="POST" enctype="multipart/form-data">
                <h3 class="step-header">Step 1</h3>
                <div class="step-line"></div>

                <div class="new-form-group">
                    <label>Name of Listing</label>
                    <input type="text" name="title" placeholder="Value">
                </div>

                <div class="new-form-group">
                    <label>Do you own or rent?</label>
                    <div class="radio-row">
                        <label><input type="radio" name="host_role" value="renter" required> Rent</label>
                        <label><input type="radio" name="host_role" value="owner"> Own</label>
                    </div>
                </div>

                <div class="new-form-group">
                    <label>Upload home ownership documentation</label>
                    <input type="file" name="verification_doc" id="doc-upload" accept=".pdf, image/*" required>
                </div>

                <h3 class="step-header">Step 2</h3>
                <div class="step-line"></div>

                <div class="new-form-group">
                    <label>Room Type</label>
                    <div class="radio-row">
                        <label><input type="radio" name="room_type" value="whole_apartment"> Whole apartment</label>
                        <label><input type="radio" name="room_type" value="room"> Single room</label>
                    </div>
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
                </div>

                <div class="new-form-group">
                    <label>Upload images</label>
                    <input type="file" name="listing_image" id="image-upload" accept="image/*" required>
                </div>

                <div class="new-form-group">
                    <label>Date and Duration</label>
                    <input type="date" name="available_date" required>
                </div>

                <h3 class="step-header">Step 3</h3>
                <div class="step-line"></div>

                <div class="new-form-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Value" required></textarea>
                </div>

                <div class="new-form-group">
                    <label>Preferences</label>
                    <div class="tag-box">
                        <label class="tag"><input type="checkbox" name="attributes[]" value="1"> Wifi</label>
                        <label class="tag"><input type="checkbox" name="attributes[]" value="2"> Kitchen</label>
                        <label class="tag"><input type="checkbox" name="attributes[]" value="3"> Dishwasher</label>
                        <label class="tag"><input type="checkbox" name="attributes[]" value="4"> Pets allowed</label>
                        <label class="tag"><input type="checkbox" name="attributes[]" value="5"> Free Parking</label>

                    </div>
                </div>

                <div class="new-form-group">
                    <label>Services</label>
                    <div class="tag-box">
                        <label class="tag"><input type="checkbox" name="services[]" value="1"> Basic cleaning</label>
                        <label class="tag"><input type="checkbox" name="services[]" value="2"> Pet care</label>
                        <label class="tag"><input type="checkbox" name="services[]" value="3"> Plant care</label>
                        <label class="tag"><input type="checkbox" name="services[]" value="4"> Tutoring</label>

                    </div>
                </div>

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
