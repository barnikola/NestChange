<?php
$pageTitle = 'NestChange - My Exchanges';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Exchanges'],
];

ob_start();
?>
<section id="exc-section">
  <div class="exc-search">
    <input type="text" placeholder="Search by location or date">
  </div>

  <div id="exc-filter">
    <ul>
      <li>Filter:</li>
      <li><a href="#">All</a></li>
      <li><a href="#">Active</a></li>
      <li><a href="#">Completed</a></li>
      <li><a href="#">Cancelled</a></li>
    </ul>
  </div>

  <div class="exc-box">
    <h4>EXCHANGES LIST</h4>
    <div class="exc-images">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
      <img src="/assets/listing.jpg" alt="Listing preview">
    </div>

    <table class="exc-table">
        <tr>
          <th>Exchange ID</th>
          <th>Accommodation</th>
          <th>Dates</th>
          <th>Status</th>
          <th>View</th>
        </tr>

        <tr>
          <td>12345</td>
          <td>Beach House</td>
          <td>July 10 - 23</td>
          <td class="done">Finalized</td>
          <td><a href="/listings/exchange-details">View Details</a></td>
        </tr>
        <tr>
          <td>22341</td>
          <td>Beach House</td>
          <td>July 10 - 23</td>
          <td class="done">Finalized</td>
          <td><a href="/listings/exchange-details">View Details</a></td>
        </tr>
        <tr>
          <td>99911</td>
          <td>Beach House</td>
          <td>July 10 - 23</td>
          <td class="active">Confirmed</td>
          <td><a href="/listings/exchange-details">View Details</a></td>
        </tr>
        <tr>
          <td>77882</td>
          <td>Beach House</td>
          <td>July 10 - 23</td>
          <td class="active">Confirmed</td>
          <td><a href="/listings/exchange-details">View Details</a></td>
        </tr>
        <tr>
          <td>33221</td>
          <td>Beach House</td>
          <td>July 10 - 23</td>
          <td class="active">Confirmed</td>
          <td><a href="/listings/exchange-details">View Details</a></td>
        </tr>
    </table>
  </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
