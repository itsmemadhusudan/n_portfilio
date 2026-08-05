# n_portfilio

Personal portfolio site for **Madhusudan Timalsina** — a backend-focused developer portfolio built with Laravel, Blade, Tailwind CSS and Alpine.js.

## Stack

- **Laravel 12** (PHP 8.2+) — routing, controllers, Blade templating
- **Tailwind CSS 4** — styling, via Vite
- **Alpine.js** (with the `intersect` plugin) — scroll reveals and interactive cards
- **Vite** — asset bundling and hot reload

## Pages

| Route | Page |
| --- | --- |
| `/` | Home — hero, services, recent projects, process |
| `/about` | About — story, profile, focus areas, values |
| `/skills` | Skills — stack layers, languages, frameworks, soft skills |
| `/projects` | Projects — case studies and freelance capabilities |
| `/education` | Education — degrees, coursework, achievements |
| `/contact` | Contact — availability, roles and direct links |

## Content

All copy, links, projects, skills and contact details live in a single file: `config/portfolio.php`. Edit that file to update the site — the Blade views read everything from it, so no markup changes are needed for content edits.

## Local setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Run the dev servers in two terminals:

```bash
php artisan serve
npm run dev
```

The site is then available at http://127.0.0.1:8000.

## Production build

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Project layout

```
app/Http/Controllers/PortfolioController.php   one method per page
config/portfolio.php                           all site content
resources/views/layouts/portfolio.blade.php    shared layout
resources/views/portfolio/                     page views
resources/views/portfolio/partials/            nav, background, terminal, contact
resources/views/components/                    icon, page-header, anim-card, anim-btn
resources/css/app.css                          theme, animations, gradient borders
```
