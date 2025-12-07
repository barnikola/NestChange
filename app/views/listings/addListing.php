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

        <div class="form-box">
            <form class="listing-form">
                <h3 class="step-header">Step 1</h3>
                <div class="step-line"></div>

                <div class="new-form-group">
                    <label>Name of Listing</label>
                    <input type="text" placeholder="Value">
                </div>

                <div class="new-form-group">
                    <label>Do you own or rent?</label>
                    <div class="radio-row">
                        <label><input type="radio" name="ownRent"> Rent</label>
                        <label><input type="radio" name="ownRent"> Own</label>
                    </div>
                </div>

                <div class="new-form-group">
                    <label>Upload home ownership documentation</label>
                    <div class="upload-box">⬆</div>
                </div>

                <h3 class="step-header">Step 2</h3>
                <div class="step-line"></div>

                <div class="new-form-group">
                    <label>Room Type</label>
                    <div class="radio-row">
                        <label><input type="radio" name="room"> Whole apartment</label>
                        <label><input type="radio" name="room"> Single room</label>
                    </div>
                </div>

                <div class="new-form-group">
                    <label>Address</label>
                    <select>
                        <option>Country</option>
                    </select>
                    <input type="text" placeholder="Address">
                    <input type="text" placeholder="City">
                    <input type="text" placeholder="Postcode">
                </div>

                <div class="new-form-group">
                    <label>Upload images</label>
                    <div class="upload-box">⬆</div>
                </div>

                <div class="new-form-group">
                    <label>Date and Duration</label>
                    <input type="date">
                </div>

                <h3 class="step-header">Step 3</h3>
                <div class="step-line"></div>

                <div class="new-form-group">
                    <label>Description</label>
                    <textarea placeholder="Value"></textarea>
                </div>

                <div class="new-form-group">
                    <label>Preferences</label>
                    <div class="tag-box">
                        <span class="tag">No gender preference</span>
                        <span class="tag">Only Female Students</span>
                        <span class="tag">No overnight guests</span>
                        <span class="tag">No pets allowed</span>
                        <span class="tag">Smoking not allowed</span>
                    </div>
                </div>

                <div class="new-form-group">
                    <label>Services</label>
                    <div class="tag-box">
                        <span class="tag">Plant watering</span>
                        <span class="tag">Deep Cleaning</span>
                        <span class="tag">Tutoring</span>
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
