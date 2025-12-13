<?php
$pageTitle = 'NestChange - Exchange Details';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Exchanges', 'url' => '/listings/my-exchanges'],
    ['label' => 'Exchange Details'],
];

ob_start();
?>
<section class="details-section">  
  <div class="details-header">
    <span class="details-badge">Agreement Summary</span>
  </div>

  <div class="details-box">
    <div class="details-head">
      <span>Accommodation</span>
      <span>Location</span>
      <span>Dates</span>
      <span>Services</span>
      <span>House Rules</span>
      <span>Participants</span>
      <span>Status</span>
    </div>

    <div class="details-row">
      <span>Beach House</span>
      <span>LA, USA</span>
      <span>July 10 - 23</span>
      <span>Basic cleaning</span>
      <span>No pets</span>
      <span>You &amp; Host</span>
      <span>Finalized exchange</span>
    </div>

    <div class="details-row">
      <span>Beach House</span>
      <span>LA, USA</span>
      <span>July 10 - 23</span>
      <span>Basic cleaning</span>
      <span>No pets</span>
      <span>You &amp; Host</span>
      <span>Confirmed booking</span>
    </div>

    <div class="details-row">
      <span>Beach House</span>
      <span>LA, USA</span>
      <span>July 10 - 23</span>
      <span>Basic cleaning</span>
      <span>No pets</span>
      <span>You &amp; Host</span>
      <span>Finalized exchange</span>
    </div>

    <div class="details-row">
      <span>Beach House</span>
      <span>LA, USA</span>
      <span>July 10 - 23</span>
      <span>Basic cleaning</span>
      <span>No pets</span>
      <span>You &amp; Host</span>
      <span>Finalized exchange</span>
    </div>
  </div>

  <div class="details-buttons">
    <button class="details-btn">Update Agreement</button>
    <button class="details-btn">Cancel Exchange</button>
    <button class="details-btn">Download Contract</button>
  </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
