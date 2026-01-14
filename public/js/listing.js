/**
 * Listing detail interactions
 * - Availability calendar with date range selection
 * - Apply button date query handling
 * - Image carousel controls
 */
(function () {
    'use strict';

    const configScript = document.getElementById('listing-config');
    const config = configScript ? JSON.parse(configScript.textContent || '{}') : {};
    const availabilityPeriods = Array.isArray(config.availability) ? config.availability : [];
    const applyBaseUrl = config.applyUrl || '';
    const mapConfig = config.map || null;

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('availability-calendar');
        const monthLabel = document.querySelector('.calendar-month-label');
        const navButtons = document.querySelectorAll('.calendar-nav');
        const applyButton = document.querySelector('.div-button .listing');

        if (!calendarEl || !monthLabel || navButtons.length === 0) {
            initListingCarousel();
            initListingMap();
            return;
        }

        let currentYear = parseInt(calendarEl.dataset.year, 10) || new Date().getFullYear();
        let currentMonth = parseInt(calendarEl.dataset.month, 10) || (new Date().getMonth() + 1);
        let selectedStartDate = null;
        let selectedEndDate = null;
        const defaultApplyText = applyButton ? applyButton.textContent : 'Apply for listing';
        const applyUrl = applyButton?.getAttribute('href') || applyBaseUrl;

        function isDateAvailable(dateStr) {
            if (availabilityPeriods.length === 0) return true;

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
            if (!applyButton || !applyUrl) return;

            if (selectedStartDate && selectedEndDate) {
                const start = encodeURIComponent(selectedStartDate);
                const end = encodeURIComponent(selectedEndDate);
                applyButton.setAttribute('href', `${applyUrl}?start=${start}&end=${end}`);
                applyButton.textContent = `Apply (${formatDateDMY(selectedStartDate)} to ${formatDateDMY(selectedEndDate)})`;
            } else if (selectedStartDate) {
                applyButton.setAttribute('href', applyUrl);
                applyButton.textContent = 'Select End Date';
            } else {
                applyButton.setAttribute('href', applyUrl);
                applyButton.textContent = defaultApplyText;
            }
        }

        function normalizeDate(dateInput) {
            let date;
            if (typeof dateInput === 'string') {
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

            const normalizedStart = selectedStartDate ? normalizeDate(selectedStartDate) : null;
            const normalizedEnd = selectedEndDate ? normalizeDate(selectedEndDate) : null;

            for (let day = 1; day <= totalDays; day++) {
                const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const cellDate = normalizeDate(dateStr);
                const cell = document.createElement('div');
                cell.className = 'calendar-cell';

                const isPast = cellDate < today;
                const isAvailable = !isPast && isDateAvailable(dateStr);

                cell.classList.add(isAvailable ? 'available' : 'blocked');

                if (cellDate.getTime() === today.getTime()) {
                    cell.classList.add('today');
                }

                if (normalizedStart && normalizedEnd) {
                    const cellTime = cellDate.getTime();
                    const startTime = normalizedStart.getTime();
                    const endTime = normalizedEnd.getTime();

                    if (startTime === endTime && cellTime === startTime) {
                        cell.classList.add('selected');
                    }
                    else {
                        if (cellTime === startTime) {
                            cell.classList.add('range-start', 'selected');
                        } else if (cellTime === endTime) {
                            cell.classList.add('range-end', 'selected');
                        } else if (cellTime > startTime && cellTime < endTime) {
                            cell.classList.add('in-range');
                        }
                    }
                } else if (normalizedStart && dateStr === selectedStartDate) {
                    cell.classList.add('selected');
                }

                cell.innerHTML = `<span>${day}</span>`;

                if (isAvailable) {
                    cell.addEventListener('click', () => handleDateSelect(dateStr));
                }

                calendarGrid.appendChild(cell);
            }

            container.appendChild(calendarGrid);
        }

        function handleDateSelect(dateStr) {
            if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
                selectedStartDate = dateStr;
                selectedEndDate = null;
            } else {
                if (dateStr < selectedStartDate) {
                    selectedEndDate = selectedStartDate;
                    selectedStartDate = dateStr;
                } else {
                    selectedEndDate = dateStr;
                }
            }
            render();
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

        try {
            render();
        } catch (error) {
            console.error('Calendar render error:', error);
        }

        try {
            initListingCarousel();
        } catch (error) {
            console.error('Carousel initialization error:', error);
        }

        try {
            initListingMap();
        } catch (error) {
            console.error('Listing map initialization error:', error);
        }
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

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const index = parseInt(dot.dataset.index, 10);
                showSlide(index);
                resetAutoPlay();
            });
        });

        function startAutoPlay() {
            autoPlayInterval = setInterval(() => {
                showSlide(currentIndex + 1);
            }, 5000);
        }

        function resetAutoPlay() {
            clearInterval(autoPlayInterval);
            startAutoPlay();
        }

        if (slides.length > 1) {
            startAutoPlay();
        }

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

    function initListingMap() {
        if (!mapConfig || typeof L === 'undefined') {
            return;
        }

        const mapElement = document.getElementById('listing-map');
        if (!mapElement) {
            return;
        }

        const lat = parseFloat(mapConfig.lat);
        const lng = parseFloat(mapConfig.lng);

        if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
            return;
        }

        const map = L.map(mapElement, {
            zoomControl: false,
        }).setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18,
        }).addTo(map);

        L.marker([lat, lng]).addTo(map).bindPopup(mapConfig.title || 'Listing');

        L.control.zoom({ position: 'bottomright' }).addTo(map);

        setTimeout(() => map.invalidateSize(), 200);
    }
})();




