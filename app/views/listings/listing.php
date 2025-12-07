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

$blockedDates = [
    '2025-04-05',
    '2025-04-06',
    '2025-04-12',
    '2025-04-21',
];

ob_start();
?>
<section class="holder">
    <div class="listing-carousel">
        <button class="carousel-control prev" type="button" aria-label="Previous photo">‹</button>
        <div class="carousel-track">
            <?php foreach ($carouselImages ?? [] as $index => $image): ?>
                <img
                    src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>"
                    alt="Listing photo <?php echo $index + 1; ?>"
                    class="carousel-slide<?php echo $index === 0 ? ' active' : ''; ?>">
            <?php endforeach; ?>
        </div>
        <button class="carousel-control next" type="button" aria-label="Next photo">›</button>
        <div class="carousel-dots">
            <?php foreach ($carouselImages ?? [] as $index => $image): ?>
                <span class="carousel-dot<?php echo $index === 0 ? ' active' : ''; ?>"
                      data-index="<?php echo $index; ?>"></span>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="text-box">
    <h2>House Exchange in Greece in 2 Weeks</h2>
        <p>Experience a smooth and secure house exchange in Greece tailored for short-term stays.</p>
        <p>Our platform makes it easy to connect, verify, and exchange homes within 2 weeks.<br>
            Fast process, trusted hosts, and a perfect Greek getaway without high costs.</p>
    </div>
</section>

<section class="preferences-box">
    <div class="preferences">
        <h3>Preferences</h3>
        <p class="subtext">These are rules and preferences of this listing</p>
    </div>
    <div class="pref-list">
        <div class="pref-item"><span class="icon">i</span>No smoking</div>
        <div class="pref-item"><span class="icon">i</span>House exchange</div>
        <div class="pref-item"><span class="icon">i</span>Pet care</div>
        <div class="pref-item"><span class="icon">i</span>Only female students</div>
        <div class="pref-item"><span class="icon">i</span>Language exchange</div>
        <div class="pref-item"><span class="icon">i</span>No noise after 11</div>
    </div>
</section>

<section class="calendar-card">
    <div class="calendar-header-row">
        <button class="calendar-nav" data-direction="prev" aria-label="Previous month">‹</button>
        <div class="calendar-month-label">April 2025</div>
        <button class="calendar-nav" data-direction="next" aria-label="Next month">›</button>
    </div>
    <div class="listing-calendar">
        <div id="availability-calendar" data-year="2025" data-month="4"></div>
    </div>
    <div class="time-row">
        <span>Time</span>
        <span class="time-value">9:41 AM</span>
    </div>
</section>

<section class="container">
    <div class="div-button">
        <button class="chat" onclick="window.location.href='/chat'">Chat</button>
        <button class="listing" onclick="window.location.href='/listings/apply-for-listing'">Apply for listing</button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('availability-calendar');
    const monthLabel = document.querySelector('.calendar-month-label');
    const navButtons = document.querySelectorAll('.calendar-nav');
    const blockedDates = <?php echo json_encode($blockedDates); ?>;
    let currentYear = parseInt(calendarEl.dataset.year, 10);
    let currentMonth = parseInt(calendarEl.dataset.month, 10);
    let selectedDate = null;

    function render() {
        renderAvailabilityCalendar(calendarEl, currentYear, currentMonth, blockedDates, selectedDate, (dateStr) => {
            selectedDate = dateStr;
        });
        const displayDate = new Date(currentYear, currentMonth - 1, 1);
        monthLabel.textContent = displayDate.toLocaleString('default', { month: 'long', year: 'numeric' });
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

function renderAvailabilityCalendar(container, year, month, blockedDates, selectedDate, onSelect) {
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
        const isBlocked = blockedDates.includes(dateStr);
        cell.classList.add(isBlocked ? 'blocked' : 'available');
        if (selectedDate === dateStr) {
            cell.classList.add('selected');
        }
        cell.innerHTML = `<span>${day}</span>`;
        if (!isBlocked && typeof onSelect === 'function') {
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
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
