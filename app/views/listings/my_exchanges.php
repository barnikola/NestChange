<?php
$pageTitle = 'NestChange - My Exchanges';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Exchanges'],
];
$exchanges = $exchanges ?? [];

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
    <?php if (empty($exchanges)): ?>
      <p class="exc-empty">No exchanges yet. Confirmed bookings will appear here once their start date passes.</p>
    <?php else: ?>
      <table class="exc-table">
          <tr>
            <th>Exchange ID</th>
            <th>Accommodation</th>
            <th>Dates</th>
            <th>Status</th>
            <th>View</th>
          </tr>

          <?php foreach ($exchanges as $exchange): ?>
            <tr>
              <td data-label="Exchange ID"><?= htmlspecialchars($exchange['booking_id'] ?? $exchange['application_id']) ?></td>
              <td data-label="Accommodation">
                <div class="exc-accommodation"><?= htmlspecialchars($exchange['listing_title'] ?? 'Listing') ?></div>
                <div class="exc-location">
                  <?= htmlspecialchars(trim(($exchange['listing_city'] ?? '') . (empty($exchange['listing_country']) ? '' : ', ' . $exchange['listing_country']))) ?>
                </div>
                <?php if (!empty($exchange['other_name'])): ?>
                  <div class="exc-role">
                    <?= $exchange['role'] === 'host' ? 'Hosting ' : 'Staying with ' ?>
                    <?= htmlspecialchars($exchange['other_name']) ?>
                  </div>
                <?php endif; ?>
              </td>
              <td data-label="Dates"><?= htmlspecialchars($exchange['date_range'] ?? 'Dates not set') ?></td>
              <td data-label="Status" class="<?= htmlspecialchars($exchange['status_class'] ?? '') ?>">
                <?= htmlspecialchars(ucfirst($exchange['status'] ?? '')) ?>
              </td>
              <td data-label="View">
                <a href="<?= BASE_URL ?>/applications/<?= htmlspecialchars($exchange['application_id']) ?>">View Details</a>
              </td>
            </tr>
          <?php endforeach; ?>
      </table>
    <?php endif; ?>
  </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
