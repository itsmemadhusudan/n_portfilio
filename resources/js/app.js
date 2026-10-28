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

    Alpine.data('heroTypewriter', (phrase = '') => ({
        full: String(phrase || ''),
        displayed: '',
        done: false,
        timer: null,
        start() {
            if (! this.full) {
                this.done = true;
                return;
            }

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                this.displayed = this.full;
                this.done = true;
                return;
            }

            let i = 0;
            const tick = () => {
                i += 1;
                this.displayed = this.full.slice(0, i);
                if (i >= this.full.length) {
                    this.done = true;
                    return;
                }
                this.timer = window.setTimeout(tick, i < 3 ? 90 : 55);
            };

            this.timer = window.setTimeout(tick, 420);
        },
        destroy() {
            if (this.timer) {
                window.clearTimeout(this.timer);
            }
        },
    }));
});

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
