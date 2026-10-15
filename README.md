# Madhusudan Timalsina

**Developer at Smart Sarks** · Nepal

Portfolio: [madhusudantimalsina.com.np](https://madhusudantimalsina.com.np) · [LinkedIn](https://www.linkedin.com/in/madhusudan-timalsina-75a910183/) · [GitHub](https://github.com/itsmemadhusudan)

I build web applications across PHP, Laravel, React, Vue, Python and Node.js — APIs, databases and interfaces for production products.

> Exact spelling: **Timalsina** (with an **a**). Keep this name consistent on LinkedIn, GitHub and the site.

## What's in this repo

Laravel + Blade + Tailwind CSS + Alpine.js portfolio. **All content lives in `config/portfolio.php`** (skills, projects, SEO, bios). No Filament/admin panel and no portfolio database tables.

| Route | Page |
| --- | --- |
| `/` | Home |
| `/about` | About |
| `/skills` | Skills (category tabs) |
| `/projects` | Projects (Alpine type/tech filters) |
| `/projects/{slug}` | Project case study |
| `/stack/{slug}` | Projects for a skill |
| `/education` | Education |
| `/contact` | Contact |

## Edit content (no admin)

1. Change `config/portfolio.php` — `skills[]`, `projects[]`, SEO, copy
2. `npm run build`
3. `php artisan site:export --base=https://madhusudantimalsina.com.np`
4. Commit and push (including `docs/` for GitHub Pages)

Skill fields: `name`, `slug`, `category`, `icon`, `proficiency` (`expert`|`proficient`|`learning`), `featured`, `sort_order`.

Project fields: `name`, `slug`, `summary`, `problem`, `solution`, `result`, `type`, `tech` (skill slugs), `featured`, `sort_order`.

## Local setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan serve   # terminal 1
npm run dev         # terminal 2
```

Open http://127.0.0.1:8000.

### Contact form (Mailjet SMTP)

The `/contact` form emails you the message and sends the visitor a confirmation. Mailjet SMTP, from/to addresses, and form enablement are hardcoded in `config/mail.php` and `config/portfolio.php` (no mail keys needed in `.env`).

Keep `QUEUE_CONNECTION=sync` so mail sends immediately. Static GitHub Pages export turns the form off via `site:export`.

Never commit `.env` — only `.env.example` / `.env.production.example`.

## Build & publish

See [DEPLOY.md](DEPLOY.md) for full steps.

```bash
npm run build
php artisan site:export --base=https://madhusudantimalsina.com.np
```

That updates `docs/` for GitHub Pages (branch `main`, folder `/docs`). `--base` must match the live domain.

PHP host instead of Pages: point the web root at `public/`, copy `.env.production.example` → `.env`, run `php artisan key:generate`, then `composer deploy`. No database required for portfolio content.

## Project layout

```
config/portfolio.php                         content, SEO, skills, projects
app/Support/Portfolio.php                    helpers over config
app/Http/Controllers/PortfolioController.php pages
app/Console/Commands/ExportStaticSite.php    static export → docs/
resources/views/layouts/portfolio.blade.php  layout + schema
resources/views/portfolio/                   pages & partials
resources/views/components/                  reusable UI (card, button, skill-badge, …)
resources/css/app.css                        cyberpunk neon theme tokens
docs/                                        static export for GitHub Pages
```

## Design system (cyberpunk neon)

Tokens live in `resources/css/app.css` (`@theme` + `:root`) — Tailwind v4 CSS-first config (no `tailwind.config.js`).

| Token | Value |
| --- | --- |
| Page / section / surface | `#0a0a1f` / `#0f0f2d` / `#14143a` |
| Accent gradient | `#8b3dff` → `#3b82f6` |
| Neon cyan / violet | `#22d3ee` / `#a855f7` |
| Text | `#e8e8f5` primary, `#9a9ac0` muted |
| Radius | `6px` |
| Glow | `0 0 18px rgba(139,61,255,.25)` |
| Fonts | JetBrains Mono (headings/logo), Inter (body) |

Reusable Blade components:

- `x-card` — neon-bordered surface
- `x-button` — solid gradient or ghost neon outline
- `x-section-title` — eyebrow + title + optional subtitle
- `x-stat-card` — icon + monospace value + label
- `x-page-header` — inner-page H1 block
- `x-skill-badge` — skill chip with optional Learning label
- `x-icon` — inline SVG icons

## SEO checklist

1. Live: [robots.txt](https://madhusudantimalsina.com.np/robots.txt) and [sitemap.xml](https://madhusudantimalsina.com.np/sitemap.xml)
2. Submit the sitemap in [Google Search Console](https://search.google.com/search-console)
3. Keep **Madhusudan Timalsina**, **Developer** and **Smart Sarks** identical on the site, LinkedIn and GitHub
