# Madhusudan Timalsina

**Backend Developer at Smart Sarks** · Nepal

Portfolio: [madhusudantimalsina.com.np](https://madhusudantimalsina.com.np) · [LinkedIn](https://www.linkedin.com/in/madhusudan-timalsina-75a910183/) · [GitHub](https://github.com/itsmemadhusudan)

I build Laravel APIs, databases and server-side systems for production products. Stack: Laravel, Node.js, Python, REST APIs, database design.

> Exact spelling: **Timalsina** (with an **a**). Keep this name consistent on LinkedIn, GitHub and the site.

## What's in this repo

Laravel + Blade + Tailwind CSS + Alpine.js portfolio. All copy and links live in `config/portfolio.php`.

| Route | Page |
| --- | --- |
| `/` | Home |
| `/about` | About |
| `/skills` | Skills |
| `/projects` | Projects |
| `/education` | Education |
| `/contact` | Contact |

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

The `/contact` form emails you the message and sends the visitor a confirmation.

1. Copy mail settings from `.env.example` into your local `.env`
2. Set `MAIL_USERNAME` / `MAIL_PASSWORD` to your Mailjet API key + secret
3. Set `MAIL_FROM_ADDRESS` and `MAIL_TO_ADDRESS` (verify the from-address in Mailjet)
4. Keep `QUEUE_CONNECTION=sync` so mail sends immediately
5. Keep `CONTACT_FORM_ENABLED=true` on a PHP host; static GitHub Pages export turns the form off

Never commit `.env` — only `.env.example` / `.env.production.example`.

## Build & publish

```bash
npm run build
php artisan site:export --base=https://madhusudantimalsina.com.np
```

That updates `docs/` for GitHub Pages (branch `main`, folder `/docs`). `--base` must match the live domain.

PHP host instead of Pages: point the web root at `public/`, copy `.env.production.example` → `.env`, run `php artisan key:generate`, then `composer deploy`. No database required.

## Project layout

```
config/portfolio.php                         content, SEO, social links
app/Http/Controllers/PortfolioController.php pages
resources/views/layouts/portfolio.blade.php  layout + schema
resources/views/portfolio/                   pages & partials
resources/views/components/                  reusable UI (card, button, …)
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
- `x-icon` — inline SVG icons

## SEO checklist

1. Live: [robots.txt](https://madhusudantimalsina.com.np/robots.txt) and [sitemap.xml](https://madhusudantimalsina.com.np/sitemap.xml)
2. Submit the sitemap in [Google Search Console](https://search.google.com/search-console)
3. Keep **Madhusudan Timalsina**, **Backend Developer** and **Smart Sarks** identical on the site, LinkedIn and GitHub
