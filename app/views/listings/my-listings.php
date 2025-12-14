<?php
require_once dirname(dirname(__DIR__)) . '/core/session.php';
Session::start();

$pageTitle = 'NestChange - My Listings';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'My Listings'],
];
$extraHead = '<link rel="stylesheet" href="/css/listings.css">';

ob_start();
?>
<section id="exc-section">
  <div class="exc-search">
    <input type="text" id="listing-search" placeholder="Search by title or location">
  </div>

  <div id="exc-filter">
    <ul>
      <li>Filter:</li>
      <li><a href="#" class="filter-btn active" data-status="all">All</a></li>
      <li><a href="#" class="filter-btn" data-status="published">Published</a></li>
      <li><a href="#" class="filter-btn" data-status="draft">Draft</a></li>
      <li><a href="#" class="filter-btn" data-status="paused">Paused</a></li>
    </ul>
  </div>

  <div class="exc-box">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h4>MY LISTINGS</h4>
      <a href="<?= BASE_URL ?>/listings/create" class="details-btn" style="text-align: center;">
        + Add New Listing
      </a>
    </div>

    <?php if (empty($listings)): ?>
      <div style="text-align: center; padding: 40px 20px; color: #666;">
        <p>You haven't created any listings yet.</p>
        <a href="<?= BASE_URL ?>/listings/create" class="details-btn" style="display: inline-block; margin-top: 20px;">
          Create Your First Listing
        </a>
      </div>
    <?php else: ?>
      <div class="exc-images" id="listing-images">
        <?php foreach (array_slice($listings, 0, 8) as $listing): ?>
          <a href="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>">
            <img src="<?= !empty($listing['primary_image']) ? '/' . ltrim($listing['primary_image'], '/') : '/assets/listing.jpg' ?>" 
                 alt="<?= htmlspecialchars($listing['title']) ?>">
          </a>
        <?php endforeach; ?>
      </div>

      <table class="exc-table" id="listings-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($listings as $listing): ?>
            <tr data-status="<?= htmlspecialchars($listing['status']) ?>" 
                data-title="<?= htmlspecialchars(strtolower($listing['title'])) ?>"
                data-location="<?= htmlspecialchars(strtolower($listing['city'] . ' ' . $listing['country'])) ?>">
              <td><?= htmlspecialchars($listing['title']) ?></td>
              <td><?= htmlspecialchars($listing['city']) ?>, <?= htmlspecialchars($listing['country']) ?></td>
              <td><?= $listing['room_type'] === 'whole_apartment' ? 'Entire home' : 'Private room' ?></td>
              <td class="<?= $listing['status'] === 'published' ? 'active' : 'done' ?>">
                <?= ucfirst(htmlspecialchars($listing['status'])) ?>
              </td>
              <td>
                <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                  <a href="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>">View</a>
                  <a href="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/edit">Edit</a>
                  
                  <?php 
                  $user = Session::getUser();
                  $isModerator = $user && in_array($user['role'], ['moderator', 'admin']);
                  ?>
                  
                  <?php if ($isModerator && ($listing['status'] === 'draft' || $listing['status'] === 'paused')): ?>
                    <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/publish" method="POST" style="display: inline;">
                      <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                      <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; color: #1f8a4c;">
                        Publish
                      </button>
                    </form>
                  <?php endif; ?>
                  
                  <?php if ($listing['status'] === 'published'): ?>
                    <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/pause" method="POST" style="display: inline;">
                      <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                      <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; color: #d9534f;">
                        Pause
                      </button>
                    </form>
                  <?php endif; ?>
                  
                  <?php if ($listing['status'] === 'paused'): ?>
                    <form action="<?= BASE_URL ?>/listings/<?= htmlspecialchars($listing['id']) ?>/unpause" method="POST" style="display: inline;">
                      <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                      <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; color: #1f8a4c;">
                        Unpause
                      </button>
                    </form>
                  <?php endif; ?>
                  
                  <button type="button" class="delete-listing-btn" 
                          data-listing-id="<?= htmlspecialchars($listing['id']) ?>"
                          data-listing-title="<?= htmlspecialchars($listing['title']) ?>"
                          style="background: none; border: none; cursor: pointer; padding: 0; color: #d9534f;">
                    Delete
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</section>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
  <div style="background: #fff; padding: 30px; border-radius: 16px; max-width: 400px; text-align: center;">
    <h3 style="margin-bottom: 15px;">Delete Listing?</h3>
    <p style="margin-bottom: 20px; color: #666;">Are you sure you want to delete "<span id="delete-listing-title"></span>"? This action cannot be undone.</p>
    <form id="delete-form" action="" method="POST">
      <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
      <div style="display: flex; gap: 15px; justify-content: center;">
        <button type="button" id="cancel-delete" class="details-btn" style="background: #f5f5f5;">Cancel</button>
        <button type="submit" class="details-btn" style="background: #d9534f; color: #fff; border-color: #d9534f;">Delete</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Filter functionality
  const filterBtns = document.querySelectorAll('.filter-btn');
  const tableRows = document.querySelectorAll('#listings-table tbody tr');
  
  filterBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Update active state
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      this.style.background = '#000';
      this.style.color = '#fff';
      filterBtns.forEach(b => {
        if (b !== this) {
          b.style.background = '#f2f2f2';
          b.style.color = '#000';
        }
      });
      
      const status = this.dataset.status;
      
      tableRows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });
  
  // Search functionality
  const searchInput = document.getElementById('listing-search');
  searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase().trim();
    
    tableRows.forEach(row => {
      const title = row.dataset.title || '';
      const location = row.dataset.location || '';
      
      if (title.includes(query) || location.includes(query)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
  
  // Delete modal functionality
  const deleteModal = document.getElementById('delete-modal');
  const deleteForm = document.getElementById('delete-form');
  const deleteTitleSpan = document.getElementById('delete-listing-title');
  const cancelBtn = document.getElementById('cancel-delete');
  
  document.querySelectorAll('.delete-listing-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const listingId = this.dataset.listingId;
      const listingTitle = this.dataset.listingTitle;
      
      deleteTitleSpan.textContent = listingTitle;
      deleteForm.action = '<?= BASE_URL ?>/listings/' + listingId + '/delete';
      deleteModal.style.display = 'flex';
    });
  });
  
  cancelBtn.addEventListener('click', function() {
    deleteModal.style.display = 'none';
  });
  
  deleteModal.addEventListener('click', function(e) {
    if (e.target === deleteModal) {
      deleteModal.style.display = 'none';
    }
  });
  
  // Set initial active filter style
  document.querySelector('.filter-btn.active').style.background = '#000';
  document.querySelector('.filter-btn.active').style.color = '#fff';
});
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
