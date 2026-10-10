import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

window.Alpine = Alpine;
Alpine.start();

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function initScrollReveals() {
    if (prefersReducedMotion()) {
        document.querySelectorAll('.reveal, .contact-reveal').forEach((el) => {
            el.classList.add('is-revealed');
        });
        return;
    }

    if (! ('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
    );

    document.querySelectorAll('.reveal:not([x-data])').forEach((el) => observer.observe(el));
}

function initHeroEntrance() {
    if (prefersReducedMotion()) {
        document.querySelectorAll('.hero-enter').forEach((el) => {
            el.style.opacity = '1';
            el.style.transform = 'none';
            el.style.animation = 'none';
        });
    }
}

function boot() {
    initHeroEntrance();
    initScrollReveals();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
    boot();
}
