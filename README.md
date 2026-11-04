# Madhusudan Timalsina

**Developer at Smart Sarks** · Nepal

Portfolio: [madhusudantimalsina.com.np](https://madhusudantimalsina.com.np) · [LinkedIn](https://www.linkedin.com/in/madhusudan-timalsina-75a910183/) · [GitHub](https://github.com/itsmemadhusudan)

I build web applications across PHP, Laravel, React, Vue, Python and Node.js — APIs, databases and interfaces for production products.

> Exact spelling: **Timalsina** (with an **a**). Keep this name consistent on LinkedIn, GitHub and the site.

## What's in this repo

Laravel + Blade + Tailwind CSS + Alpine.js portfolio with a deep-space landing (deferred Three.js Earth on the home page only). **Content lives in config** — no admin panel and no portfolio database.

| Source | Purpose |
| --- | --- |
| `config/portfolio.php` | Skills, projects, SEO, bios, nav, contact |
| `config/stack-guides.php` | Long-form stack / SEO guides (PHP, Laravel, Node, …) |

| Route | Page |
| --- | --- |
| `/` | Home (hero + planet backdrop) |
| `/about` | About |
| `/skills` | Skills (category tabs → stack pages) |
| `/projects` | Projects (Alpine type/tech filters) |
| `/projects/{slug}` | Project case study |
| `/stack/{slug}` | Skill stack guide + related projects |
| `/education` | Education |
| `/contact` | Contact |

Every skill has a `/stack/{slug}` page: custom guide when defined in `stack-guides.php`, otherwise a generated fallback.

## Edit content

1. Change `config/portfolio.php` and/or `config/stack-guides.php`
2. `pnpm run build` (or `npm run build`)
3. **Re-export static Pages site** (required for GitHub Pages to update):

```bash
php artisan site:export --base=https://madhusudantimalsina.com.np
```

4. Commit **including `docs/`** and push `main`

GitHub Pages serves **`main` → `/docs`**. Editing Laravel views alone does **not** update the live site until you re-run `site:export` and push `docs/`.

Skill fields: `name`, `slug`, `category`, `icon`, `proficiency` (`expert`|`proficient`|`learning`), `featured`, `sort_order`.

Project fields: `name`, `slug`, `summary`, `problem`, `solution`, `result`, `type`, `tech` (skill slugs), `featured`, `sort_order`.

## Local setup

```bash
composer install
pnpm install          # or: npm install
cp .env.example .env
php artisan key:generate
php artisan serve     # terminal 1
pnpm run dev          # terminal 2 (Vite)
```

Open http://127.0.0.1:8000.

### Contact form

- **Local / PHP host:** Laravel + Mailjet (`config/mail.php`, `config/portfolio.php`). Keep `QUEUE_CONNECTION=sync`.
- **GitHub Pages:** static export keeps the form and posts via [FormSubmit](https://formsubmit.co) (no PHP on Pages).

Never commit `.env` — only `.env.example` / `.env.production.example`.

## Build & publish

Full steps: [DEPLOY.md](DEPLOY.md).

```bash
pnpm run build
php artisan site:export --base=https://madhusudantimalsina.com.np
```

`--base` must match the live domain. Export copies:

- HTML for all portfolio + stack + project pages
- `public/build/` → `docs/build/`
- `public/images/` → `docs/images/`
- `public/assets/` → `docs/assets/` (Earth textures for the landing WebGL scene)
- `CNAME`, `.nojekyll`, sitemap, robots, headers

Optional: compress planet textures before build:

```bash
php scripts/compress-planet-textures.php
```

PHP host instead of Pages: point the web root at `public/`, copy `.env.production.example` → `.env`, `php artisan key:generate`, then `composer deploy`. No database required for portfolio content.

## Project layout

```
config/portfolio.php                         content, SEO, skills, projects
config/stack-guides.php                      stack guide articles + FAQs
app/Support/Portfolio.php                    helpers + guide fallbacks
app/Http/Controllers/PortfolioController.php pages
app/Console/Commands/ExportStaticSite.php    static export → docs/
resources/views/layouts/portfolio.blade.php  layout + schema + space bg
resources/views/portfolio/                   pages & partials
resources/js/app.js                          Alpine + deferred planet boot
resources/js/planet/scene.js                 lightweight Three.js Earth
resources/css/app.css                        deep-space + mint theme
public/assets/planet/                        Earth day/night/cloud maps
docs/                                        GitHub Pages publish folder
workers/contact-form/                        optional Cloudflare Worker mail
```

## Design (deep space + mint)

Tokens live in `resources/css/app.css` (Tailwind v4 CSS-first — no `tailwind.config.js`).

- Dark space background with CSS starfield fallback, then deferred WebGL Earth on **home only**
- Mint accent CTAs; Inter + JetBrains Mono
- First paint stays CSS-only; Three.js loads after idle / interaction
- Mobile / low-end / reduced-motion skip WebGL

## SEO checklist

1. Live: [robots.txt](https://madhusudantimalsina.com.np/robots.txt) and [sitemap.xml](https://madhusudantimalsina.com.np/sitemap.xml)
2. Submit the sitemap in [Google Search Console](https://search.google.com/search-console)
3. Keep **Madhusudan Timalsina**, **Developer** and **Smart Sarks** identical on the site, LinkedIn and GitHub
4. Stack guides expose `FAQPage` / `TechArticle` JSON-LD where configured

## CI

GitHub Actions (`.github/workflows/ci.yml`) runs Pint and `php artisan test` on push/PR to `main`.
