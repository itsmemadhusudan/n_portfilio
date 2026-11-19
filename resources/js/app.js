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
            if (this.type && this.type !== 'all') params.set('type', this.type);
            if (this.tech.length) params.set('tech', this.tech.join(','));
            const qs = params.toString();
            history.replaceState(null, '', qs ? `${window.location.pathname}?${qs}` : window.location.pathname);
        },
    }));
});

window.Alpine = Alpine;
Alpine.start();

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function initTheme() {
    const root = document.documentElement;
    const toggle = document.querySelector('[data-theme-toggle]');
    const moon = document.querySelector('[data-icon-moon]');
    const sun = document.querySelector('[data-icon-sun]');

    const syncIcons = () => {
        const dark = root.classList.contains('dark');
        if (moon) moon.hidden = dark;
        if (sun) sun.hidden = !dark;
    };

    syncIcons();

    toggle?.addEventListener('click', () => {
        const next = root.classList.toggle('dark') ? 'dark' : 'light';
        try {
            localStorage.setItem('theme', next);
        } catch (_) {}
        syncIcons();
    });
}

function initHeader() {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;

    const onScroll = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 24);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    document.querySelectorAll('[data-dropdown]').forEach((item) => {
        const btn = item.querySelector('button');
        btn?.addEventListener('click', () => {
            const open = item.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });

    const panel = document.querySelector('[data-mobile-panel]');
    const toggle = document.querySelector('[data-nav-toggle]');
    toggle?.addEventListener('click', () => {
        const open = !panel?.classList.contains('is-open');
        panel?.classList.toggle('is-open', open);
        panel?.toggleAttribute('hidden', !open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    document.querySelectorAll('[data-mobile-acc]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const sub = btn.nextElementSibling;
            const open = sub?.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });
}

function initSearch() {
    const overlay = document.querySelector('[data-search-overlay]');
    const openBtn = document.querySelector('[data-search-open]');
    const input = overlay?.querySelector('input');

    const close = () => {
        overlay?.classList.remove('is-open');
        overlay?.setAttribute('hidden', '');
    };

    openBtn?.addEventListener('click', () => {
        overlay?.classList.add('is-open');
        overlay?.removeAttribute('hidden');
        input?.focus();
    });

    overlay?.addEventListener('click', (e) => {
        if (e.target === overlay) close();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
    });
}

function initReveals() {
    const nodes = document.querySelectorAll('.reveal, .reveal-scale');
    if (prefersReducedMotion()) {
        nodes.forEach((el) => el.classList.add('is-revealed'));
        return;
    }
    if (!('IntersectionObserver' in window)) {
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
        { threshold: 0.12, rootMargin: '0px 0px -6% 0px' },
    );
    nodes.forEach((el) => observer.observe(el));
}

function initCounters() {
    const root = document.querySelector('[data-stats]');
    if (!root) return;
    const nums = root.querySelectorAll('[data-count-to]');

    const run = () => {
        nums.forEach((el) => {
            const target = Number(el.getAttribute('data-count-to') || 0);
            if (prefersReducedMotion()) {
                el.textContent = String(target);
                return;
            }
            const duration = 1100;
            const start = performance.now();
            const tick = (now) => {
                const t = Math.min(1, (now - start) / duration);
                const eased = 1 - Math.pow(1 - t, 3);
                el.textContent = String(Math.round(target * eased));
                if (t < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        });
    };

    if (!('IntersectionObserver' in window)) {
        run();
        return;
    }
    const observer = new IntersectionObserver(
        (entries) => {
            if (entries.some((e) => e.isIntersecting)) {
                run();
                observer.disconnect();
            }
        },
        { threshold: 0.35 },
    );
    observer.observe(root);
}

function initBackTop() {
    const btn = document.querySelector('[data-back-top]');
    if (!btn) return;
    const onScroll = () => {
        btn.classList.toggle('is-visible', window.scrollY > 480);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    btn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
    });
}

function boot() {
    initTheme();
    initHeader();
    initSearch();
    initReveals();
    initCounters();
    initBackTop();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
    boot();
}
