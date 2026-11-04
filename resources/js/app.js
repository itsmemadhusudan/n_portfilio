import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

document.addEventListener('alpine:init', () => {
    Alpine.data('projectFilters', (projects = []) => ({
        projects,
        type: 'all',
        tech: [],
        typeOptions: [
            { value: 'all', label: 'All' },
            { value: 'backend', label: 'Backend' },
            { value: 'frontend', label: 'Frontend' },
            { value: 'web', label: 'Web apps' },
            { value: 'api', label: 'API' },
            { value: 'data-automation', label: 'Data' },
        ],
        init() {
            const params = new URLSearchParams(window.location.search);
            this.type = params.get('type') || 'all';
            const techParam = params.get('tech');
            this.tech = techParam ? techParam.split(',').map((t) => t.trim()).filter(Boolean) : [];
        },
        get visibleCount() {
            return this.projects.filter((p) => this.matches(p.type || '', p.tech || [])).length;
        },
        setType(value) {
            this.type = value;
            this.syncUrl();
        },
        toggleTech(slug) {
            if (this.tech.includes(slug)) {
                this.tech = this.tech.filter((t) => t !== slug);
            } else {
                this.tech = [...this.tech, slug];
            }
            this.syncUrl();
        },
        matches(projectType, projectTech) {
            const typeOk = this.type === 'all' || projectType === this.type;
            const techOk = this.tech.length === 0 || this.tech.every((t) => projectTech.includes(t));

            return typeOk && techOk;
        },
        syncUrl() {
            const params = new URLSearchParams();
            if (this.type && this.type !== 'all') {
                params.set('type', this.type);
            }
            if (this.tech.length) {
                params.set('tech', this.tech.join(','));
            }
            const qs = params.toString();
            const url = qs ? `${window.location.pathname}?${qs}` : window.location.pathname;
            history.replaceState(null, '', url);
        },
    }));
});

window.Alpine = Alpine;
Alpine.start();

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function shouldSkipWebGL() {
    if (prefersReducedMotion()) {
        return true;
    }

    const conn = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    if (conn && (conn.saveData || /2g/.test(conn.effectiveType || ''))) {
        return true;
    }

    // Low-end / mobile: keep CSS space only (smooth first load)
    if (window.matchMedia('(max-width: 720px)').matches) {
        return true;
    }

    if (typeof navigator.hardwareConcurrency === 'number' && navigator.hardwareConcurrency > 0 && navigator.hardwareConcurrency <= 2) {
        return true;
    }

    if (typeof navigator.deviceMemory === 'number' && navigator.deviceMemory > 0 && navigator.deviceMemory <= 4) {
        return true;
    }

    return false;
}

function initScrollReveals() {
    const nodes = document.querySelectorAll('.reveal, .contact-reveal');

    document.querySelectorAll(
        '.stats-code__stats, .feature-grid, .projects-grid, .skills-grid, .stack-grid, .about-grid, .education-list, .achievements-grid',
    ).forEach((group) => {
        [...group.children].forEach((child, i) => {
            if (child.matches('.reveal, .contact-reveal') || child.querySelector('.reveal')) {
                const target = child.matches('.reveal, .contact-reveal')
                    ? child
                    : child.querySelector('.reveal');
                if (target && ! target.style.getPropertyValue('--reveal-delay')) {
                    target.style.setProperty('--reveal-delay', `${Math.min(i, 6) * 50}ms`);
                }
            }
        });
    });

    if (prefersReducedMotion()) {
        nodes.forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    if (! ('IntersectionObserver' in window)) {
        nodes.forEach((el) => el.classList.add('is-revealed'));
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
        { rootMargin: '0px 0px -4% 0px', threshold: 0.08 },
    );

    nodes.forEach((el) => {
        if (! el.hasAttribute('x-data') || el.classList.contains('contact-reveal')) {
            observer.observe(el);
        }
    });
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

function initNavScroll() {
    const nav = document.querySelector('.site-nav');
    if (! nav) {
        return;
    }

    let ticking = false;
    const onScroll = () => {
        if (ticking) {
            return;
        }
        ticking = true;
        requestAnimationFrame(() => {
            nav.classList.toggle('is-scrolled', window.scrollY > 18);
            ticking = false;
        });
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

function startPlanetWhenIdle(canvas) {
    let started = false;

    const start = () => {
        if (started) {
            return;
        }
        started = true;
        import('./planet/scene')
            .then(({ initPlanetScene }) => initPlanetScene(canvas))
            .catch((err) => console.error('Planet scene failed to load', err));
    };

    // Keep first paint CSS-only; upgrade Earth after load + idle.
    const schedule = () => {
        if ('requestIdleCallback' in window) {
            requestIdleCallback(start, { timeout: 3200 });
        } else {
            setTimeout(start, 1600);
        }
    };

    if (document.readyState === 'complete') {
        schedule();
    } else {
        window.addEventListener('load', schedule, { once: true });
    }

    const onInteract = () => setTimeout(start, 120);
    window.addEventListener('scroll', onInteract, { once: true, passive: true });
    window.addEventListener('pointerdown', onInteract, { once: true, passive: true });
}

function boot() {
    initHeroEntrance();
    initScrollReveals();
    initNavScroll();

    // WebGL planet is home-only (canvas omitted on other pages)
    const canvas = document.querySelector('.planet-canvas');
    if (! canvas) {
        return;
    }

    if (shouldSkipWebGL()) {
        canvas.remove();
        return;
    }

    startPlanetWhenIdle(canvas);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
    boot();
}
