import './bootstrap';

const initMobileMenu = () => {
    const openButton = document.querySelector('[data-mobile-menu-open]');
    const closeButton = document.querySelector('[data-mobile-menu-close]');
    const panel = document.querySelector('[data-mobile-menu-panel]');

    if (!openButton || !closeButton || !panel) {
        return;
    }

    const closeMenu = () => {
        panel.classList.remove('is-open');
        panel.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('mobile-menu-lock');
    };

    const openMenu = () => {
        panel.classList.add('is-open');
        panel.setAttribute('aria-hidden', 'false');
        document.body.classList.add('mobile-menu-lock');
    };

    openButton.addEventListener('click', openMenu);
    closeButton.addEventListener('click', closeMenu);

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    panel.addEventListener('click', (event) => {
        if (event.target === panel) {
            closeMenu();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 920) {
            closeMenu();
        }
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMobileMenu);
} else {
    initMobileMenu();
}
