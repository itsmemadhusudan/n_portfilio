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
resources/css/app.css                        theme
docs/                                        static export for GitHub Pages
```

## SEO checklist

1. Live: [robots.txt](https://madhusudantimalsina.com.np/robots.txt) and [sitemap.xml](https://madhusudantimalsina.com.np/sitemap.xml)
2. Submit the sitemap in [Google Search Console](https://search.google.com/search-console)
3. Keep **Madhusudan Timalsina**, **Backend Developer**, and **Smart Sarks** identical on the site, LinkedIn and GitHub
