document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const drawer = document.querySelector('[data-nav-drawer]');
    const overlay = document.querySelector('[data-nav-overlay]');

    if (!toggle || !drawer) {
        return;
    }

    const openNav = () => {
        drawer.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.classList.add('nav-open');
        if (overlay) {
            overlay.classList.add('is-visible');
        }
    };

    const closeNav = () => {
        drawer.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('nav-open');
        if (overlay) {
            overlay.classList.remove('is-visible');
        }
    };

    toggle.addEventListener('click', () => {
        if (drawer.classList.contains('is-open')) {
            closeNav();
        } else {
            openNav();
        }
    });

    if (overlay) {
        overlay.addEventListener('click', closeNav);
    }

    drawer.addEventListener('click', (event) => {
        const interactive = event.target.closest('a, button');
        if (interactive && drawer.classList.contains('is-open')) {
            closeNav();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && drawer.classList.contains('is-open')) {
            closeNav();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 900 && drawer.classList.contains('is-open')) {
            closeNav();
        }
    });
});
