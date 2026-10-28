@extends('layouts.portfolio')

@php
    $formStatic = ! empty($portfolio['contact']['form_static']);
    $formAction = $portfolio['contact']['form_action'] ?? null;
    $formAction = $formAction ?: route('contact.store');
@endphp

@section('content')
 <x-page-header
 eyebrow="Contact"
 :title="$seo['h1']"
 :subtitle="$portfolio['contact']['blurb']"
 />

 <section class="page-wrap pb-10">
 <div class="contact-layout mb-10">
 <div
 class="contact-layout__main contact-reveal"
 style="--reveal-delay: 0ms"
 x-data="{ shown: false }"
 x-intersect:enter.once="shown = true"
 :class="shown && 'is-revealed'"
 >
 @if (! empty($portfolio['contact']['form_enabled']))
 <x-card padding="p-6 sm:p-8" class="contact-form-card">
 <h2 class="text-xl font-display mb-2" style="font-weight: 600; color: var(--text-primary);">
 {{ $portfolio['contact']['form_title'] }}
 </h2>
 <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
 {{ $portfolio['contact']['form_intro'] }}
 </p>

 @if (session('contact_success'))
 <div class="contact-success" id="contact-form" role="status">
 <p class="contact-alert contact-alert--success mb-4">
 {{ session('contact_success') }}
 </p>
 <a href="{{ route('contact') }}#contact-form" class="btn-neon btn-neon--ghost">
 Send another message
 </a>
 </div>
 @else
 @if (session('contact_error'))
 <p class="contact-alert contact-alert--error mb-5" role="alert">
 {{ session('contact_error') }}
 </p>
 @endif

 <form
 id="contact-form"
 action="{{ $formAction }}"
 method="POST"
 class="contact-form"
 novalidate
 x-data="contactForm(@js([
     'static' => $formStatic,
     'endpoint' => $formAction,
     'success' => $portfolio['contact']['form_success'],
     'autoresponse' => $portfolio['contact']['form_autoresponse'] ?? '',
 ]))"
 @submit.prevent="submit"
 >
 @unless ($formStatic)
 @csrf
 @endunless

 <div class="contact-form__honeypot" aria-hidden="true">
 <label for="website">Website</label>
 <input
 type="text"
 id="website"
 name="{{ $formStatic ? '_gotcha' : 'website' }}"
 tabindex="-1"
 autocomplete="off"
 value=""
 >
 </div>

 <div class="contact-form__grid">
 <div class="contact-form__field">
 <label for="contact-name">Name</label>
 <input
 id="contact-name"
 type="text"
 name="name"
 value="{{ old('name') }}"
 required
 maxlength="120"
 autocomplete="name"
 placeholder="Your name"
 x-model="name"
 >
 @error('name')
 <span class="contact-form__error">{{ $message }}</span>
 @enderror
 </div>

 <div class="contact-form__field">
 <label for="contact-email">Email</label>
 <input
 id="contact-email"
 type="email"
 name="email"
 value="{{ old('email') }}"
 required
 maxlength="255"
 autocomplete="email"
 placeholder="you@example.com"
 x-model="email"
 >
 @error('email')
 <span class="contact-form__error">{{ $message }}</span>
 @enderror
 </div>
 </div>

 <div class="contact-form__field">
 <label for="contact-subject">Subject <span class="contact-form__optional">(optional)</span></label>
 <input
 id="contact-subject"
 type="text"
 name="subject"
 value="{{ old('subject') }}"
 maxlength="160"
 placeholder="What's your subject?"
 x-model="subject"
 >
 @error('subject')
 <span class="contact-form__error">{{ $message }}</span>
 @enderror
 </div>

 <div class="contact-form__field">
 <label for="contact-message">Message</label>
 <textarea
 id="contact-message"
 name="message"
 rows="5"
 required
 maxlength="5000"
 placeholder="What are you building and how can I help?"
 x-model="message"
 >{{ old('message') }}</textarea>
 @error('message')
 <span class="contact-form__error">{{ $message }}</span>
 @enderror
 </div>

 <div class="contact-form__field contact-form__captcha">
 <div
 class="cf-turnstile"
 data-sitekey="{{ config('services.turnstile.site_key') }}"
 data-theme="dark"
 data-size="flexible"
 data-callback="onTurnstileSuccess"
 ></div>
 @error('cf-turnstile-response')
 <span class="contact-form__error">{{ $message }}</span>
 @enderror
 <p class="contact-form__error" x-show="captchaError" x-cloak x-text="captchaError"></p>
 </div>

 <p class="contact-alert contact-alert--success mb-4" x-show="done" x-cloak x-text="successMessage"></p>
 <p class="contact-alert contact-alert--error mb-4" x-show="error" x-cloak x-text="error"></p>

 <div class="contact-form__actions" x-show="!done">
 <button
 type="submit"
 class="btn-neon btn-neon--solid"
 :disabled="sending"
 :aria-busy="sending"
 >
 <span x-show="!sending">Send message</span>
 <span x-cloak x-show="sending" class="contact-form__sending">
 <span class="contact-form__spinner" aria-hidden="true"></span>
 Sending…
 </span>
 </button>
 <p class="contact-form__note" x-show="!sending">
 Confirmation goes to your inbox · reply within 24-48 hours
 </p>
 <p class="contact-form__note" x-cloak x-show="sending">
 Sending — usually under a few seconds…
 </p>
 </div>
 </form>
 @endif
 </x-card>
 @else
 <x-card padding="p-6 sm:p-8">
 <h2 class="text-xl font-display mb-2" style="font-weight: 600; color: var(--text-primary);">
 Reach out directly
 </h2>
 <p class="text-sm leading-relaxed mb-6" style="color: var(--text-secondary);">
 {{ $portfolio['contact']['availability'] }}
 </p>
 <div class="flex flex-wrap gap-3">
 <x-button :href="$portfolio['email_href']" variant="solid" :external="true">Email me</x-button>
 @if (! empty($portfolio['phone_href']))
 <x-button :href="$portfolio['phone_href']" variant="ghost" :external="true">WhatsApp</x-button>
 @endif
 </div>
 </x-card>
 @endif
 </div>

 <aside class="contact-layout__aside">
 <div
 class="contact-reveal"
 style="--reveal-delay: 80ms"
 x-data="{ shown: false }"
 x-intersect:enter.once="shown = true"
 :class="shown && 'is-revealed'"
 >
 <x-card padding="p-5">
 <p class="section-label mb-3">Reach me directly</p>
 <div class="contact-channels">
 <a href="{{ $portfolio['email_href'] }}" target="_blank" rel="noopener noreferrer" class="contact-channel">
 <span class="contact-channel__icon" aria-hidden="true">
 <x-icon name="mail" :size="16" />
 </span>
 <span>
 <span class="contact-channel__label">Email</span>
 <span class="contact-channel__value">{{ $portfolio['email'] }}</span>
 </span>
 </a>
 @if (! empty($portfolio['phone_href']))
 <a href="{{ $portfolio['phone_href'] }}" target="_blank" rel="noopener noreferrer" class="contact-channel">
 <span class="contact-channel__icon" aria-hidden="true">
 <x-icon name="phone" :size="16" />
 </span>
 <span>
 <span class="contact-channel__label">WhatsApp</span>
 <span class="contact-channel__value">Message on WhatsApp</span>
 </span>
 </a>
 @endif
 <a href="{{ $portfolio['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="contact-channel">
 <span class="contact-channel__icon" aria-hidden="true">
 <x-icon name="linkedin" :size="16" />
 </span>
 <span>
 <span class="contact-channel__label">LinkedIn</span>
 <span class="contact-channel__value">madhusudan-timalsina</span>
 </span>
 </a>
 @if (! empty($portfolio['social']['github']))
 <a href="{{ $portfolio['social']['github'] }}" target="_blank" rel="noopener noreferrer" class="contact-channel">
 <span class="contact-channel__icon" aria-hidden="true">
 <x-icon name="github" :size="16" />
 </span>
 <span>
 <span class="contact-channel__label">GitHub</span>
 <span class="contact-channel__value">itsmemadhusudan</span>
 </span>
 </a>
 @endif
 </div>
 </x-card>
 </div>

 <div
 class="contact-reveal mt-4"
 style="--reveal-delay: 140ms"
 x-data="{ shown: false }"
 x-intersect:enter.once="shown = true"
 :class="shown && 'is-revealed'"
 >
 <x-card padding="p-5">
 <p class="section-label mb-2">{{ $portfolio['contact']['current_role']['duration'] }}</p>
 <p class="font-display text-base mb-1" style="font-weight: 600; color: var(--text-primary);">
 {{ $portfolio['contact']['current_role']['role'] }}
 </p>
 <p class="text-sm mb-3" style="color: var(--neon-cyan);">
 {{ $portfolio['contact']['current_role']['company'] }} · {{ $portfolio['location'] }}
 </p>
 <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">
 {{ $portfolio['contact']['availability'] }}
 </p>
 </x-card>
 </div>
 </aside>
 </div>

 @if (! empty($portfolio['contact']['topics']))
 <div class="page-wrap mb-10">
 <h2 class="section-title text-xl mb-4">Good conversation topics</h2>
 <ul class="grid sm:grid-cols-2 gap-2">
 @foreach ($portfolio['contact']['topics'] as $topic)
 <li>
 <x-card padding="px-4 py-3">
 <p class="text-sm" style="color: var(--text-secondary);">{{ $topic }}</p>
 </x-card>
 </li>
 @endforeach
 </ul>
 </div>
 @endif

 @if (! empty($seo['faqs']))
 <div
 class="contact-reveal"
 style="--reveal-delay: 120ms"
 x-data="{ shown: false }"
 x-intersect:enter.once="shown = true"
 :class="shown && 'is-revealed'"
 >
 <x-section-title title="Frequently asked questions" />
 <div class="grid sm:grid-cols-2 gap-3">
 @foreach ($seo['faqs'] as $faq)
 <x-card padding="p-4">
 <h3 class="font-medium mb-2 text-[13px] font-display" style="color: var(--text-primary);">{{ $faq['question'] }}</h3>
 <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $faq['answer'] }}</p>
 </x-card>
 @endforeach
 </div>
 </div>
 @endif
 </section>
@endsection

@push('scripts')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
 window.onTurnstileSuccess = function (token) {
 window.__turnstileToken = token;
 document.dispatchEvent(new CustomEvent('turnstile-success', { detail: token }));
 };

 document.addEventListener('alpine:init', () => {
 Alpine.data('contactForm', (config) => ({
 static: !!config.static,
 endpoint: config.endpoint,
 successMessage: config.success,
 autoresponse: config.autoresponse || '',
 name: '',
 email: '',
 subject: '',
 message: '',
 sending: false,
 done: false,
 error: '',
 captchaError: '',
 turnstileToken: '',
 init() {
 document.addEventListener('turnstile-success', (e) => {
 this.turnstileToken = e.detail || window.__turnstileToken || '';
 this.captchaError = '';
 });
 },
 async submit() {
 this.error = '';
 this.captchaError = '';
 this.turnstileToken = this.turnstileToken || window.__turnstileToken || '';

 if (! this.turnstileToken) {
 this.captchaError = 'Please complete the captcha verification.';
 return;
 }

 if (this.message.trim().length < 10) {
 this.error = 'Please write at least a short message (10+ characters).';
 return;
 }

 this.sending = true;

 try {
            if (this.static) {
              // Captcha is checked client-side only — never send the token to FormSubmit
              // or it appears in the owner email as a form field.
              // Keep the payload lean; FormSubmit is slower when it also builds a table template.
              const controller = new AbortController();
              const timeoutId = window.setTimeout(() => controller.abort(), 12000);

              let response;
              try {
                response = await fetch(this.endpoint, {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                  },
                  signal: controller.signal,
                  body: JSON.stringify({
                    name: this.name,
                    email: this.email,
                    subject: this.subject || 'Portfolio contact',
                    message: this.message,
                    _replyto: this.email,
                    _subject: 'New portfolio contact from ' + this.name,
                    _captcha: 'false',
                    _autoresponse: this.autoresponse,
                  }),
                });
              } finally {
                window.clearTimeout(timeoutId);
              }

              const payload = await response.json().catch(() => ({}));
              const ok = response.ok && String(payload.success) === 'true';

              if (! ok) {
                throw new Error(payload.message || 'Unable to send right now.');
              }

              this.done = true;
            } else {
              // Native submit bypasses Alpine prevent; Turnstile already injected its token field.
              HTMLFormElement.prototype.submit.call(this.$el);
              return;
            }
 } catch (e) {
 this.error = e && e.name === 'AbortError'
   ? 'Sending is taking too long. Please try again or email me directly.'
   : 'Sorry. The message could not be sent right now. Please email me directly or try again later.';
 } finally {
 this.sending = false;
 }
 },
 }));
 });
</script>
@endpush
