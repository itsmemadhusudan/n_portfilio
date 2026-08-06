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
composer deploy
```

`composer deploy` caches the config, routes and views. Run it after every deploy, and run `php artisan optimize:clear` before pulling new code.

## Deployment

This repository is source code only. GitHub does not run the site — GitHub Pages is a static file host and cannot execute PHP, Blade, or Composer packages, so it would only ever show this README. The site has to run on a PHP 8.2+ host:

```
GitHub (version control)  ->  PHP host (runs the site)
```

If GitHub Pages was switched on for this repo, turn it off under **Settings -> Pages -> Source -> None**, otherwise it keeps serving this README at the `github.io` URL.

### What every host needs

- PHP 8.2 or newer with the standard Laravel extensions
- The web root pointed at `public/`, never at the project root
- A `.env` file created on the server (never committed) — copy `.env.production.example` and fill in `APP_URL`
- `php artisan key:generate` run once, so `APP_KEY` is set
- Nothing to compile on the server: `public/build` is committed, so hosts without Node.js work fine. Just remember to run `npm run build` and commit the result whenever you change anything in `resources/css` or `resources/js`

No database is required. The portfolio reads everything from `config/portfolio.php`, and `.env.production.example` sets the session, cache and queue drivers to file/sync so there are no migrations to run.

### Shared hosting (Hostinger, cPanel)

1. Upload the project outside `public_html`, for example to `~/portfolio`.
2. Upload the contents of the project's `public/` folder into `public_html`, or point the domain's document root at `~/portfolio/public` if the panel allows it.
3. If you had to split the folders in step 2, edit `public_html/index.php` and fix the two `require` paths so they point at `~/portfolio`.
4. Over SSH, run `composer install --no-dev --optimize-autoloader`, create `.env`, run `php artisan key:generate`, then `composer deploy`.

### Railway or Render

1. Connect the GitHub repository and let the platform auto-detect PHP.
2. Build command: `composer install --no-dev --optimize-autoloader`
3. Start command: `php artisan serve --host 0.0.0.0 --port $PORT`
4. Set the environment variables from `.env.production.example` in the platform dashboard, including a generated `APP_KEY` (`php artisan key:generate --show` prints one).

### VPS (Ubuntu with Nginx)

1. `git clone` the repository into `/var/www/portfolio`.
2. Run `composer install --no-dev --optimize-autoloader`, create `.env`, `php artisan key:generate`, then `composer deploy`.
3. Give the web server user write access: `chown -R www-data:www-data storage bootstrap/cache`.
4. Point the Nginx `root` at `/var/www/portfolio/public` and pass `.php` requests to PHP-FPM.

To update any of these later: `git pull`, reinstall dependencies if they changed, then `php artisan optimize:clear && composer deploy`.

### Static copy for GitHub Pages

Every page is server-rendered from static content, so the site can also be exported to plain HTML and served by GitHub Pages while the Laravel app remains the source of truth:

```bash
npm run build
php artisan site:export --base=https://madhusudantimalsina.com.np
```

That writes `docs/` — one `index.html` per route, a copy of `public/build`, and a `.nojekyll` marker. Commit the folder, then enable **Settings -> Pages -> Source: Deploy from a branch -> Branch: main -> Folder: /docs**.

The `--base` flag must match the live URL visitors use. With a custom domain that is `https://madhusudantimalsina.com.np` (no `/n_portfilio` suffix). If CSS or nav links break after publishing, you almost always exported with the wrong `--base` — re-run the two commands and push `docs/` again.

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
