(function () {
    function enhanceDisplays() {
        document.querySelectorAll('.star-display').forEach(display => {
            if (display.dataset.enhanced === 'true') {
                return;
            }

            const rating = parseFloat(display.dataset.rating || '0');
            const max = parseInt(display.dataset.max || '5', 10);

            if (!display.querySelector('.star')) {
                for (let i = 1; i <= max; i++) {
                    const star = document.createElement('span');
                    star.className = 'star';
                    star.textContent = '★';
                    display.appendChild(star);
                }
            }

            display.querySelectorAll('.star').forEach((star, index) => {
                const starIndex = index + 1;
                star.classList.toggle('filled', rating >= starIndex);
            });

            display.setAttribute('aria-label', `${rating.toFixed(1)} out of ${max} stars`);
            display.dataset.enhanced = 'true';
        });
    }

    function enhanceInputs() {
        document.querySelectorAll('.star-input').forEach(container => {
            if (container.dataset.enhanced === 'true') {
                return;
            }

            const radios = container.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                const label = container.querySelector(`label[for="${radio.id}"]`);
                if (label) {
                    label.dataset.value = radio.value;
                }

                radio.addEventListener('change', () => {
                    container.dataset.value = radio.value;
                });
            });

            const checked = container.querySelector('input:checked');
            if (checked) {
                container.dataset.value = checked.value;
            }

            container.dataset.enhanced = 'true';
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        enhanceDisplays();
        enhanceInputs();
    });
})();
