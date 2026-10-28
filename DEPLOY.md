# Deploy

## GitHub Pages (static)

Content lives in `config/portfolio.php`. There is no admin panel and no portfolio database.

```bash
npm run build
php artisan site:export --base=https://madhusudantimalsina.com.np
```

Commit the updated `docs/` folder and push. GitHub Pages should serve from branch `main`, folder `/docs`.

The export writes:

- Core pages: `/`, `/about`, `/skills`, `/projects`, `/education`, `/contact`
- Project case studies: `/projects/{slug}/`
- Stack pages: `/stack/{slug}/`

Contact form stays visible on GitHub Pages and uses a classic [FormSubmit](https://formsubmit.co) POST to `timmadh@gmail.com` (no PHP on Pages). After send, FormSubmit redirects back to `/contact/?sent=1`. The first submission sends an activation email — open it and click **Activate Form** once (check Spam).

Local / PHP hosts still use Laravel + Mailjet as before.

## PHP host (live contact form + Mailjet)

1. Point the web root at `public/`
2. Copy `.env.production.example` → `.env` (mail/contact are already hardcoded in config)
3. `composer install --no-dev -o`
4. `php artisan key:generate`
5. `npm run build`
6. `composer deploy`

No database is required for portfolio content.

## Content edits

1. Edit `config/portfolio.php` (`skills`, `projects`, SEO, bios)
2. `npm run build`
3. `php artisan site:export --base=https://madhusudantimalsina.com.np`
4. Commit and push `docs/` (and source changes)

## CI

GitHub Actions runs Pint (dirty check) and `php artisan test` on push/PR.
