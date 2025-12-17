<?php
$pageTitle = 'NestChange - ' . htmlspecialchars($listing['title'] ?? 'Listing Details');
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Listings', 'url' => '/listings'],
    ['label' => htmlspecialchars($listing['title'] ?? 'Listing')],
];

$extraHead = '<link rel="stylesheet" href="/css/listings.css">';

// Helper function to get initials from name
function getInitials($firstName, $lastName = ''): string {
    $initials = '';
    if ($firstName) $initials .= strtoupper(substr($firstName, 0, 1));
    if ($lastName) $initials .= strtoupper(substr($lastName, 0, 1));
    return $initials ?: '?';
}

// Helper function to get icon for amenity/service
function getAmenityIcon($name): string {
    $icons = [
        'wifi' => '📶',
        'air conditioning' => '❄️',
        'heating' => '🔥',
        'kitchen' => '🍳',
        'washing machine' => '🧺',
        'dryer' => '💨',
        'tv' => '📺',
        'workspace' => '💻',
        'smoke alarm' => '🚨',
        'carbon monoxide alarm' => '⚠️',
        'first aid kit' => '🏥',
        'fire extinguisher' => '🧯',
        'near public transport' => '🚌',
        'city center' => '🏙️',
        'near university' => '🎓',
        'quiet neighborhood' => '🌳',
        'private bathroom' => '🚿',
        'balcony' => '🌅',
        'garden access' => '🌿',
        'furnished' => '🛋️',
    ];
    
    $key = strtolower($name);
    return $icons[$key] ?? 'ℹ️';
}

function getServiceIcon($name): string {
    $icons = [
        'cleaning' => '🧹',
        'laundry' => '👕',
        'breakfast' => '🥐',
        'airport pickup' => '✈️',
        'bike rental' => '🚴',
        'parking' => '🅿️',
        'gym access' => '🏋️',
        'pool access' => '🏊',
        'pet friendly' => '🐾',
        'language exchange' => '🗣️',
    ];
    
    $key = strtolower($name);
    return $icons[$key] ?? '✓';
}

// Group attributes by category
$attributesByCategory = [];
if (!empty($listing['attributes'])) {
    foreach ($listing['attributes'] as $attr) {
        $category = $attr['category'] ?? 'Other';
        if (!isset($attributesByCategory[$category])) {
            $attributesByCategory[$category] = [];
        }
        $attributesByCategory[$category][] = $attr;
    }
}

ob_start();
?>
<!-- Listing Header with Carousel -->
<section class="holder">
    <div class="listing-carousel">
        <button class="carousel-control prev" type="button" aria-label="Previous photo">‹</button>
        <div class="carousel-track">
            <?php if (!empty($listing['images'])): ?>
                <?php foreach ($listing['images'] as $index => $img): ?>
                    <img
                        src="/<?php echo ltrim($img['image'], '/'); ?>"
                        alt="<?php echo htmlspecialchars($listing['title']); ?> photo <?php echo $index + 1; ?>"
                        class="carousel-slide<?php echo $index === 0 ? ' active' : ''; ?>">
                <?php endforeach; ?>
            <?php else: ?>
                <img src="/assets/listing.jpg" alt="Default listing photo" class="carousel-slide active">
            <?php endif; ?>
        </div>
        <button class="carousel-control next" type="button" aria-label="Next photo">›</button>
        <div class="carousel-dots">
            <?php $imageCount = !empty($listing['images']) ? count($listing['images']) : 1; ?>
            <?php for ($i = 0; $i < $imageCount; $i++): ?>
                <span class="carousel-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>"></span>
            <?php endfor; ?>
        </div>
    </div>
    <div class="text-box">
        <h2><?php echo htmlspecialchars($listing['title']); ?></h2>
        <p class="listing-location"><?php echo htmlspecialchars($listing['city']); ?>, <?php echo htmlspecialchars($listing['country']); ?></p>
        <p class="listing-details">
            <?php echo $listing['room_type'] === 'whole_apartment' ? 'Entire home' : 'Private room'; ?> · 
            <?php echo htmlspecialchars($listing['max_guests'] ?? 0); ?> guests
        </p>
        <div class="listing-description">
            <?php echo nl2br(htmlspecialchars($listing['description'])); ?>
        </div>
    </div>
</section>

<!-- Host Panel -->
<section class="host-panel">
    <div class="host-panel-header">
        <div class="host-avatar">
            <?php if (!empty($listing['host']['profile_picture'])): ?>
                <img src="/<?php echo ltrim($listing['host']['profile_picture'], '/'); ?>" 
                     alt="<?php echo htmlspecialchars($listing['host']['first_name'] ?? 'Host'); ?>">
            <?php else: ?>
                <div class="host-avatar-placeholder">
                    <?php echo getInitials($listing['host']['first_name'] ?? '', $listing['host']['last_name'] ?? ''); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="host-info">
            <span class="host-label">Hosted by</span>
            <h3 class="host-name">
                <a href="<?php echo BASE_URL; ?>/profile/<?php echo htmlspecialchars($listing['host_profile_id']); ?>">
                    <?php echo htmlspecialchars(($listing['host']['first_name'] ?? 'Anonymous') . ' ' . ($listing['host']['last_name'] ?? '')); ?>
                </a>
            </h3>
            
            </div>
        </div>
    </div>
    
    <div class="host-details">
        <?php if (!empty($listing['host']['created_at'])): ?>
        <div class="host-detail-item">
            <span class="host-detail-label">Member since</span>
            <span class="host-detail-value"><?php echo date('M Y', strtotime($listing['host']['created_at'])); ?></span>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="host-actions">
        <a href="<?php echo BASE_URL; ?>/profile/<?php echo htmlspecialchars($listing['host_profile_id']); ?>" class="host-action-btn">
            View Profile
        </a>
        <a href="<?php echo BASE_URL; ?>/chat/<?php echo htmlspecialchars($listing['host_profile_id']); ?>?listing_id=<?php echo htmlspecialchars($listing['id']); ?>" class="host-action-btn primary">
            Contact Host
        </a>
    </div>
</section>

<!-- Amenities & Preferences Section -->
<section class="preferences-box">
    <div class="preferences">
        <h3>Amenities & Features</h3>
        <p class="subtext">Hover over each item to learn more</p>
    </div>
    
    <?php if (!empty($attributesByCategory)): ?>
        <?php foreach ($attributesByCategory as $category => $attrs): ?>
            <div class="amenities-section">
                <h4 class="amenities-category-title"><?php echo htmlspecialchars($category); ?></h4>
                <div class="amenities-grid">
                    <?php foreach ($attrs as $attr): ?>
                        <div class="amenity-item" 
                             data-tooltip="<?php echo htmlspecialchars($attr['description'] ?? $attr['name'] . ' is available at this property'); ?>">
                            <span class="amenity-icon"><?php echo getAmenityIcon($attr['name']); ?></span>
                            <span class="amenity-name"><?php echo htmlspecialchars($attr['name']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: #666; padding: 20px 0;">No specific amenities listed for this property.</p>
    <?php endif; ?>
</section>

<!-- Services Section -->
<?php if (!empty($listing['services'])): ?>
<section class="preferences-box">
    <div class="preferences">
        <h3>Guest Requirements</h3>
        <p class="subtext">Mandatory services and responsibilities for guests</p>
    </div>
    <div class="amenities-grid" style="margin-top: 16px;">
        <?php foreach ($listing['services'] as $service): ?>
            <div class="service-item" 
                 data-tooltip="<?php echo htmlspecialchars($service['description'] ?? 'Guest is required to handle ' . strtolower($service['name'])); ?>">
                <span class="service-icon"><?php echo getServiceIcon($service['name']); ?></span>
                <span class="service-name"><?php echo htmlspecialchars($service['name']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- Availability Calendar -->
<section class="calendar-card">
    <div class="calendar-header-row">
        <button class="calendar-nav" data-direction="prev" aria-label="Previous month" type="button">‹</button>
        <div class="calendar-month-label"><?php echo date('F Y'); ?></div>
        <button class="calendar-nav" data-direction="next" aria-label="Next month" type="button">›</button>
    </div>
    <div class="listing-calendar">
        <div id="availability-calendar" 
             data-year="<?php echo date('Y'); ?>" 
             data-month="<?php echo date('n'); ?>"
             data-listing-id="<?php echo $listing['id']; ?>">
        </div>
    </div>
    
    <!-- Legend -->
    <div class="availability-legend">
        <div class="legend-item">
            <span class="legend-dot available"></span>
            <span>Available</span>
        </div>
        <div class="legend-item">
            <span class="legend-dot blocked"></span>
            <span>Unavailable</span>
        </div>
        <div class="legend-item">
            <span class="legend-dot selected"></span>
            <span>Selected</span>
        </div>
    </div>
    
    <?php if (!empty($listing['availability'])): ?>
        <div class="availability-info" style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #f0f0f0; font-size: 0.9em; color: #666;">
            <strong>Available periods:</strong><br>
            <?php foreach ($listing['availability'] as $period): ?>
                <?php 
                    $from = date('M j, Y', strtotime($period['available_from']));
                    $until = $period['available_until'] ? date('M j, Y', strtotime($period['available_until'])) : 'Ongoing';
                    echo "📅 {$from} – {$until}<br>";
                ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<!-- Action Buttons -->
<section class="container">
    <div class="div-button">
        <?php 
        $currentUser = Session::getUser();
        $userProfileId = $currentUser['profile_id'] ?? null;
        $isOwner = $userProfileId && $userProfileId === $listing['host_profile_id'];
        ?>

        <?php if (!$isOwner): ?>
            <button class="chat" onclick="window.location.href='/chat/<?php echo $listing['host_profile_id']; ?>'">Chat</button>
            <button class="listing" onclick="window.location.href='/listings/<?php echo $listing['id']; ?>/apply'">Apply for listing</button>
        <?php else: ?>
             <button class="listing" style="background: #ccc; cursor: default;" disabled>You own this listing</button>
        <?php endif; ?>
        <button class="listing" onclick="window.location.href='<?php echo BASE_URL; ?>/listings/<?php echo $listing['id']; ?>/apply'">
            Apply for Exchange
        </button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('availability-calendar');
    const monthLabel = document.querySelector('.calendar-month-label');
    const navButtons = document.querySelectorAll('.calendar-nav');
    const applyButton = document.querySelector('.div-button .listing'); // Apply button
    
    // Initial apply link base
    const applyBaseUrl = applyButton.getAttribute('onclick').match(/'([^']+)'/)[1];
    
    // Get availability dates from PHP
    const availabilityPeriods = <?php echo json_encode($listing['availability'] ?? []); ?>;
    
    // Build blocked dates from availability (dates outside availability periods are blocked)
    const blockedDates = [];
    
    let currentYear = parseInt(calendarEl.dataset.year, 10);
    let currentMonth = parseInt(calendarEl.dataset.month, 10);
    let selectedStartDate = null;
    let selectedEndDate = null;

    // Check if a date is within any availability period
    function isDateAvailable(dateStr) {
        if (availabilityPeriods.length === 0) return true; // No restrictions
        
        const date = new Date(dateStr);
        for (const period of availabilityPeriods) {
            const from = new Date(period.available_from);
            const until = period.available_until ? new Date(period.available_until) : new Date('2099-12-31');
            
            if (date >= from && date <= until) {
                return true;
            }
        }
        return false;
    }

    function render() {
        renderAvailabilityCalendar(calendarEl, currentYear, currentMonth);
        const displayDate = new Date(currentYear, currentMonth - 1, 1);
        monthLabel.textContent = displayDate.toLocaleString('default', { month: 'long', year: 'numeric' });
        updateApplyButton();
    }
    
    function updateApplyButton() {
        // Selection state is stored in selectedStartDate/selectedEndDate
        if (selectedStartDate && selectedEndDate) {
            applyButton.onclick = function () {
                const start = encodeURIComponent(selectedStartDate);
                const end = encodeURIComponent(selectedEndDate);
                window.location.href = `${applyBaseUrl}?start=${start}&end=${end}`;
            };
            applyButton.textContent = `Apply (${formatDateDMY(selectedStartDate)} to ${formatDateDMY(selectedEndDate)})`;
        } else if (selectedStartDate) {
            // Prevent stale onclick from previous selection
            applyButton.onclick = function () {
                window.location.href = applyBaseUrl;
            };
            applyButton.textContent = 'Select End Date';
        } else {
            applyButton.onclick = function () {
                window.location.href = applyBaseUrl;
            };
            applyButton.textContent = 'Apply for listing';
        }
    }

    // Helper function to normalize dates to local midnight for comparison
    function normalizeDate(dateInput) {
        let date;
        if (typeof dateInput === 'string') {
            // Parse YYYY-MM-DD format to local date
            const [y, m, d] = dateInput.split('-').map(Number);
            date = new Date(y, m - 1, d);
        } else {
            date = new Date(dateInput);
        }
        date.setHours(0, 0, 0, 0);
        return date;
    }

    function renderAvailabilityCalendar(container, year, month) {
        const monthIndex = month - 1;
        const firstDay = new Date(year, monthIndex, 1);
        const totalDays = new Date(year, month, 0).getDate();
        const startDay = firstDay.getDay();
        const today = normalizeDate(new Date());
        
        const calendarGrid = document.createElement('div');
        calendarGrid.className = 'calendar-grid';

        container.innerHTML = '';

        // Weekday headers
        const weekdayRow = document.createElement('div');
        weekdayRow.className = 'calendar-weekdays';
        const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        weekdays.forEach(day => {
            const dayEl = document.createElement('div');
            dayEl.textContent = day;
            weekdayRow.appendChild(dayEl);
        });
        container.appendChild(weekdayRow);

        // Empty cells for days before start of month
        for (let i = 0; i < startDay; i++) {
            const cell = document.createElement('div');
            cell.className = 'calendar-cell empty';
            calendarGrid.appendChild(cell);
        }

        // Normalize selected dates for comparison
        const normalizedStart = selectedStartDate ? normalizeDate(selectedStartDate) : null;
        const normalizedEnd = selectedEndDate ? normalizeDate(selectedEndDate) : null;

        // Day cells
        for (let day = 1; day <= totalDays; day++) {
            const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const cellDate = normalizeDate(dateStr);
            const cell = document.createElement('div');
            cell.className = 'calendar-cell';
            
            const isPast = cellDate < today;
            const isAvailable = !isPast && isDateAvailable(dateStr);
            
            cell.classList.add(isAvailable ? 'available' : 'blocked');
            
            // Today marker
            if (cellDate.getTime() === today.getTime()) {
                cell.classList.add('today');
            }
            
            // Range selection highlighting
            if (normalizedStart && normalizedEnd) {
                const cellTime = cellDate.getTime();
                const startTime = normalizedStart.getTime();
                const endTime = normalizedEnd.getTime();
                
                if (cellTime === startTime) {
                    cell.classList.add('range-start');
                    cell.classList.add('selected');
                } else if (cellTime === endTime) {
                    cell.classList.add('range-end');
                    cell.classList.add('selected');
                } else if (cellTime > startTime && cellTime < endTime) {
                    cell.classList.add('in-range');
                }
            } else if (normalizedStart && dateStr === selectedStartDate) {
                cell.classList.add('selected');
            }
            
            cell.innerHTML = `<span>${day}</span>`;
            
            // Click handler for date selection
            if (isAvailable) {
                cell.addEventListener('click', () => handleDateSelect(dateStr));
            }
            
            calendarGrid.appendChild(cell);
        }

        container.appendChild(calendarGrid);
    }

    function handleDateSelect(dateStr) {
        if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
            // Start new selection
            selectedStartDate = dateStr;
            selectedEndDate = null;
        } else {
            // Complete range selection
            if (dateStr < selectedStartDate) {
                selectedEndDate = selectedStartDate;
                selectedStartDate = dateStr;
            } else {
                selectedEndDate = dateStr;
            }
        }
        render();
    }

    // Navigation handlers
    navButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.dataset.direction === 'prev') {
                currentMonth -= 1;
                if (currentMonth === 0) {
                    currentMonth = 12;
                    currentYear -= 1;
                }
            } else {
                currentMonth += 1;
                if (currentMonth === 13) {
                    currentMonth = 1;
                    currentYear += 1;
                }
            }
            render();
        });
    });

    // Initial render
    render();
    
    // Initialize carousel
    initListingCarousel();
});

function initListingCarousel() {
    const carousel = document.querySelector('.listing-carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    const prevBtn = carousel.querySelector('.carousel-control.prev');
    const nextBtn = carousel.querySelector('.carousel-control.next');
    let currentIndex = 0;
    let autoPlayInterval;

    const showSlide = (index) => {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        
        slides.forEach((slide, idx) => {
            slide.classList.toggle('active', idx === index);
        });
        dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === index);
        });
        currentIndex = index;
    };

    // Navigation handlers
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            showSlide(currentIndex - 1);
            resetAutoPlay();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            showSlide(currentIndex + 1);
            resetAutoPlay();
        });
    }
    
    // Dot navigation
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const index = parseInt(dot.dataset.index, 10);
            showSlide(index);
            resetAutoPlay();
        });
    });

    // Auto-play functionality
    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            showSlide(currentIndex + 1);
        }, 5000);
    }

    function resetAutoPlay() {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    }

    // Start auto-play if more than one image
    if (slides.length > 1) {
        startAutoPlay();
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            showSlide(currentIndex - 1);
            resetAutoPlay();
        } else if (e.key === 'ArrowRight') {
            showSlide(currentIndex + 1);
            resetAutoPlay();
        }
    });
}

function formatDateDMY(dateStr) {
    if (!dateStr) return '';
    const parts = dateStr.split('-');
    return `${parts[2]}-${parts[1]}-${parts[0]}`;
}
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
