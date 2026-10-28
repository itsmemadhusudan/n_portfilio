# Contact form Worker (Mailjet)

GitHub Pages cannot run PHP. This Cloudflare Worker receives the contact form and sends mail with Mailjet (owner inbox + visitor thank-you). Mailjet keys stay in Worker secrets — never in the repo or the browser.

## 1. Create the Worker

1. Cloudflare dashboard → **Workers & Pages** → **Create** → **Create Worker**
2. Name it `contact-form` (or similar) → **Deploy**
3. **Edit code** → replace the stub with `worker.js` from this folder → **Deploy**

## 2. Add secrets / variables

Worker → **Settings** → **Variables and Secrets**:

| Name | Type | Value |
|------|------|--------|
| `MJ_KEY` | Secret | Mailjet API key |
| `MJ_SECRET` | Secret | Mailjet secret key |
| `FROM_EMAIL` | Variable | Verified Mailjet sender (e.g. `timmadh@gmail.com`) |
| `TO_EMAIL` | Variable | `timmadh@gmail.com` |
| `FROM_NAME` | Variable (optional) | `Madhusudan Timalsina` |
| `ALLOWED_ORIGIN` | Variable (optional) | `https://madhusudantimalsina.com.np` |

`FROM_EMAIL` must be a [verified sender](https://app.mailjet.com/account/sender) in Mailjet or sends will fail.

If Mailjet keys were ever committed or shared in chat, regenerate them in Mailjet first.

## 3. Point the site at the Worker

1. Copy the Worker URL from the overview page (e.g. `https://contact-form.<account>.workers.dev`)
2. Set it in `config/portfolio.php`:

```php
'form_static_endpoint' => 'https://contact-form.<account>.workers.dev',
```

3. Rebuild and export (do **not** push until you are ready):

```bash
npm run build
php artisan site:export --base=https://madhusudantimalsina.com.np
```

## 4. Test

Open the live `/contact` page, complete Turnstile, submit. You should get the owner email at `TO_EMAIL` and a thank-you at the visitor address. Captcha tokens are never sent to the Worker.
