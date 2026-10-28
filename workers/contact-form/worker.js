/**
 * Cloudflare Worker: portfolio contact form → Mailjet
 *
 * Deploy: Workers & Pages → Create Worker → paste this file → Deploy
 * Secrets (Settings → Variables and Secrets):
 *   MJ_KEY, MJ_SECRET          (Secret) — Mailjet API credentials
 *   FROM_EMAIL                 — verified Mailjet sender (e.g. timmadh@gmail.com)
 *   TO_EMAIL                   — owner inbox (timmadh@gmail.com)
 *   FROM_NAME                  — optional, default "Madhusudan Timalsina"
 *   ALLOWED_ORIGIN             — optional, default https://madhusudantimalsina.com.np
 *
 * Then set config/portfolio.php contact.form_static_endpoint to this Worker's URL
 * and re-run: npm run build && php artisan site:export --base=https://madhusudantimalsina.com.np
 */

export default {
  async fetch(request, env) {
    const allowedOrigin = env.ALLOWED_ORIGIN || 'https://madhusudantimalsina.com.np';
    const requestOrigin = request.headers.get('Origin') || '';
    const originOk =
      !requestOrigin ||
      requestOrigin === allowedOrigin ||
      requestOrigin === 'http://127.0.0.1:8000' ||
      requestOrigin === 'http://localhost:8000';

    const cors = {
      'Access-Control-Allow-Origin': originOk ? (requestOrigin || allowedOrigin) : allowedOrigin,
      'Access-Control-Allow-Methods': 'POST, OPTIONS',
      'Access-Control-Allow-Headers': 'Content-Type',
      'Access-Control-Max-Age': '86400',
    };

    if (request.method === 'OPTIONS') {
      return new Response(null, { status: 204, headers: cors });
    }

    if (request.method !== 'POST') {
      return json({ ok: false, message: 'Method not allowed' }, 405, cors);
    }

    if (!originOk) {
      return json({ ok: false, message: 'Origin not allowed' }, 403, cors);
    }

    let body;
    try {
      body = await request.json();
    } catch {
      return json({ ok: false, message: 'Invalid JSON' }, 400, cors);
    }

    // Honeypot — bots fill this; humans leave it empty.
    if (body.website || body._gotcha) {
      return json({ ok: true }, 200, cors);
    }

    const name = String(body.name || '').trim();
    const email = String(body.email || '').trim();
    const subject = String(body.subject || 'Portfolio contact').trim() || 'Portfolio contact';
    const message = String(body.message || '').trim();

    if (!name || !email || message.length < 10) {
      return json({ ok: false, message: 'Missing or invalid fields' }, 400, cors);
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      return json({ ok: false, message: 'Invalid email' }, 400, cors);
    }

    const mjKey = env.MJ_KEY;
    const mjSecret = env.MJ_SECRET;
    const fromEmail = env.FROM_EMAIL;
    const toEmail = env.TO_EMAIL || 'timmadh@gmail.com';
    const fromName = env.FROM_NAME || 'Madhusudan Timalsina';

    if (!mjKey || !mjSecret || !fromEmail) {
      return json({ ok: false, message: 'Worker mail is not configured' }, 500, cors);
    }

    const escape = (value) =>
      String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;');

    const ownerHtml = `
      <h2>New portfolio contact</h2>
      <p><strong>Name:</strong> ${escape(name)}</p>
      <p><strong>Email:</strong> ${escape(email)}</p>
      <p><strong>Subject:</strong> ${escape(subject)}</p>
      <p><strong>Message:</strong></p>
      <p>${escape(message).replaceAll('\n', '<br>')}</p>
      <p>Reply directly to this email to respond to ${escape(name)}.</p>
    `;

    const thankYouHtml = `
      <h2>Thank you, ${escape(name)}</h2>
      <p>Thank you for your message. I have received it and will reply within 24–48 hours.</p>
      <p><strong>Subject:</strong> ${escape(subject)}</p>
      <p><strong>Your message:</strong></p>
      <p>${escape(message).replaceAll('\n', '<br>')}</p>
      <p>Best regards,<br>Madhusudan Timalsina<br>Developer · Lalitpur, Nepal<br>
      <a href="https://madhusudantimalsina.com.np">madhusudantimalsina.com.np</a></p>
    `;

    const mailjetRes = await fetch('https://api.mailjet.com/v3.1/send', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: 'Basic ' + btoa(`${mjKey}:${mjSecret}`),
      },
      body: JSON.stringify({
        Messages: [
          {
            From: { Email: fromEmail, Name: fromName },
            To: [{ Email: toEmail, Name: fromName }],
            ReplyTo: { Email: email, Name: name },
            Subject: `New portfolio contact from ${name} — ${subject}`,
            HTMLPart: ownerHtml,
            TextPart: `Name: ${name}\nEmail: ${email}\nSubject: ${subject}\n\n${message}`,
          },
          {
            From: { Email: fromEmail, Name: fromName },
            To: [{ Email: email, Name: name }],
            Subject: 'Thank you for your message | Madhusudan Timalsina',
            HTMLPart: thankYouHtml,
            TextPart:
              `Thank you, ${name}.\n\nI have received your message and will reply within 24-48 hours.\n\nSubject: ${subject}\n\n${message}\n\nMadhusudan Timalsina\nDeveloper · Lalitpur, Nepal\nhttps://madhusudantimalsina.com.np`,
          },
        ],
      }),
    });

    if (!mailjetRes.ok) {
      const detail = await mailjetRes.text().catch(() => '');
      console.error('Mailjet failed', mailjetRes.status, detail);
      return json({ ok: false, message: 'Mail provider rejected the send' }, 502, cors);
    }

    const payload = await mailjetRes.json().catch(() => ({}));
    const statuses = (payload.Messages || []).map((m) => m.Status);
    if (statuses.length === 0 || statuses.some((s) => s !== 'success')) {
      console.error('Mailjet rejected message', payload);
      return json({ ok: false, message: 'Mail provider rejected the send' }, 502, cors);
    }

    return json({ ok: true }, 200, cors);
  },
};

function json(data, status, cors) {
  return new Response(JSON.stringify(data), {
    status,
    headers: {
      ...cors,
      'Content-Type': 'application/json',
    },
  });
}
