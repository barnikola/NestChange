<?php
$pageTitle = 'NestChange - Listing Details';
$activeNav = 'listings';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Listings', 'url' => '/listings'],
    ['label' => 'Listing Details'],
];

$carouselImages = [
    '/assets/carousel-exterior.jpg',
    '/assets/carousel-interior.jpg',
];

$availablePeriods = $listing['availability'] ?? [];

ob_start();
?>
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
            <?php if (!empty($listing['images'])): ?>
                <?php foreach ($listing['images'] as $index => $img): ?>
                    <span class="carousel-dot<?php echo $index === 0 ? ' active' : ''; ?>"
                          data-index="<?php echo $index; ?>"></span>
                <?php endforeach; ?>
            <?php endif; ?>
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

<section class="preferences-box">
    <div class="preferences">
        <h3>Preferences & Amenities</h3>
        <p class="subtext">These are rules and preferences of this listing</p>
    </div>
    <div class="pref-list">
        <?php if (!empty($listing['attributes'])): ?>
            <?php foreach ($listing['attributes'] as $attr): ?>
                <div class="pref-item"><span class="icon">i</span><?php echo htmlspecialchars($attr['name']); ?></div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No specific preferences listed.</p>
        <?php endif; ?>
    </div>
</section>

<section class="calendar-card">
    <div class="calendar-header-row">
        <button class="calendar-nav" data-direction="prev" aria-label="Previous month">‹</button>
        <div class="calendar-month-label"><?php echo date('F Y'); ?></div>
        <button class="calendar-nav" data-direction="next" aria-label="Next month">›</button>
    </div>
    <div class="listing-calendar">
        <div id="availability-calendar" 
             data-year="<?php echo date('Y'); ?>" 
             data-month="<?php echo date('n'); ?>"
             data-listing-id="<?php echo $listing['id']; ?>">
        </div>
    </div>
    <?php if (!empty($listing['availability'])): ?>
        <div class="availability-info" style="margin-top: 10px; font-size: 0.9em; color: #666;">
            <strong>Available periods:</strong><br>
            <?php foreach ($listing['availability'] as $period): ?>
                <?php 
                    $from = date('M j, Y', strtotime($period['available_from']));
                    $until = $period['available_until'] ? date('M j, Y', strtotime($period['available_until'])) : 'Ongoing';
                    echo "{$from} - {$until}<br>";
                ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<section class="container">
    <div class="div-button">
        <button class="chat" onclick="window.location.href='/chat/<?php echo $listing['host_profile_id']; ?>'">Chat</button>
        <button class="listing" onclick="window.location.href='/listings/<?php echo $listing['id']; ?>/apply'">Apply for listing</button>
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
    
    const availablePeriods = <?php echo json_encode($availablePeriods ?? []); ?>; 
    
    let currentYear = parseInt(calendarEl.dataset.year, 10);
    let currentMonth = parseInt(calendarEl.dataset.month, 10);
    
    // Selection state
    let startDate = null;
    let endDate = null;

    function render() {
        renderAvailabilityCalendar(calendarEl, currentYear, currentMonth, availablePeriods, startDate, endDate, (dateStr) => {
            handleDateSelect(dateStr);
        });
        const displayDate = new Date(currentYear, currentMonth - 1, 1);
        monthLabel.textContent = displayDate.toLocaleString('default', { month: 'long', year: 'numeric' });
        updateApplyButton();
    }
    
    function handleDateSelect(dateStr) {
        if (!startDate || (startDate && endDate)) {
            // Start new selection
            startDate = dateStr;
            endDate = null;
        } else {
            // Complete selection
            if (dateStr < startDate) {
                endDate = startDate;
                startDate = dateStr;
            } else {
                endDate = dateStr;
            }
        }
        render();
    }

        function updateApplyButton() {
        if (startDate && endDate) {
            applyButton.onclick = function() {
                window.location.href = `${applyBaseUrl}?start=${startDate}&end=${endDate}`;
            };
            applyButton.textContent = `Apply (${formatDateDMY(startDate)} to ${formatDateDMY(endDate)})`;
        } else if (startDate) {
             applyButton.textContent = `Select End Date`;
        } else {
            applyButton.onclick = function() {
                window.location.href = applyBaseUrl;
            };
            applyButton.textContent = 'Apply for listing';
        }
    }

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

    render();
    initListingCarousel();
});

function renderAvailabilityCalendar(container, year, month, availablePeriods, startDate, endDate, onSelect) {
    const monthIndex = month - 1;
    const firstDay = new Date(year, monthIndex, 1);
    const totalDays = new Date(year, month, 0).getDate();
    const startDay = firstDay.getDay();
    const calendarGrid = document.createElement('div');
    calendarGrid.className = 'calendar-grid';

    container.innerHTML = '';

    const weekdayRow = document.createElement('div');
    weekdayRow.className = 'calendar-weekdays';
    const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    weekdays.forEach(day => {
        const dayEl = document.createElement('div');
        dayEl.textContent = day;
        weekdayRow.appendChild(dayEl);
    });
    container.appendChild(weekdayRow);

    for (let i = 0; i < startDay; i++) {
        const cell = document.createElement('div');
        cell.className = 'calendar-cell empty';
        calendarGrid.appendChild(cell);
    }

    for (let day = 1; day <= totalDays; day++) {
        const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const cell = document.createElement('div');
        cell.className = 'calendar-cell';

        let isAvailable = false;
        const currentCheckDate = new Date(dateStr);
        
        if (availablePeriods.length === 0) {
            isAvailable = true;
        } else {
            for (const period of availablePeriods) {
                const start = new Date(period.available_from);
                const end = period.available_until ? new Date(period.available_until) : new Date('9999-12-31');
                
                if (currentCheckDate >= start && currentCheckDate <= end) {
                    isAvailable = true;
                    break;
                }
            }
        }

        cell.classList.add(isAvailable ? 'available' : 'blocked');
        
        if (startDate && dateStr === startDate) cell.classList.add('selected', 'selected-start');
        if (endDate && dateStr === endDate) cell.classList.add('selected', 'selected-end');
        
        if (startDate && endDate && dateStr > startDate && dateStr < endDate) {
            cell.classList.add('selected-range');
        }

        cell.innerHTML = `<span>${day}</span>`;
        if (isAvailable && typeof onSelect === 'function') {
            cell.addEventListener('click', () => onSelect(dateStr));
        }
        calendarGrid.appendChild(cell);
    }

    container.appendChild(calendarGrid);
}

function initListingCarousel() {
    const carousel = document.querySelector('.listing-carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.carousel-slide');
    const dots = carousel.querySelectorAll('.carousel-dot');
    const prevBtn = carousel.querySelector('.carousel-control.prev');
    const nextBtn = carousel.querySelector('.carousel-control.next');
    let currentIndex = 0;

    const showSlide = (index) => {
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;
        slides.forEach((slide, idx) => slide.classList.toggle('active', idx === index));
        dots.forEach((dot, idx) => dot.classList.toggle('active', idx === index));
        currentIndex = index;
    };

    prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
    nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
    dots.forEach(dot => dot.addEventListener('click', () => {
        const index = parseInt(dot.dataset.index, 10);
        showSlide(index);
    }));
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
