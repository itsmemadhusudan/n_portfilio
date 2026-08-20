import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

window.Alpine = Alpine;
Alpine.start();

const MAGNETIC_SELECTOR = '.anim-border, .project-card, .anim-btn, .btn-pill';

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function isFinePointer() {
    return window.matchMedia('(hover: hover) and (pointer: fine)').matches;
}

function strengthFor(el) {
    if (el.classList.contains('btn-pill') || el.classList.contains('anim-btn')) {
        return { move: 28, tilt: 12 };
    }

    return { move: 24, tilt: 14 };
}

function bindMagnetic(el) {
    if (el.dataset.magneticBound === '1') {
        return;
    }

    el.dataset.magneticBound = '1';
    el.classList.add('is-magnetic');

    const reset = () => {
        el.style.transform = '';
        el.classList.remove('is-magnetic-active');
    };

    el.addEventListener('pointerenter', () => {
        el.classList.add('is-magnetic-active');
    });

    el.addEventListener('pointermove', (event) => {
        if (! isFinePointer() || prefersReducedMotion()) {
            return;
        }

        const rect = el.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width - 0.5;
        const y = (event.clientY - rect.top) / rect.height - 0.5;
        const { move, tilt } = strengthFor(el);

        el.style.transform = [
            `translate3d(${(x * move).toFixed(2)}px, ${(y * move).toFixed(2)}px, 0)`,
            `rotateX(${(-y * tilt).toFixed(2)}deg)`,
            `rotateY(${(x * tilt).toFixed(2)}deg)`,
        ].join(' ');
    });

    el.addEventListener('pointerleave', reset);
    el.addEventListener('pointercancel', reset);
    el.addEventListener('blur', reset);
}

function initMagneticElements(root = document) {
    if (prefersReducedMotion() || ! isFinePointer()) {
        return;
    }

    root.querySelectorAll(MAGNETIC_SELECTOR).forEach(bindMagnetic);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initMagneticElements(), { once: true });
} else {
    initMagneticElements();
}
