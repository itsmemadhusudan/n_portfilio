@extends('layouts.app')

@php
    $formStatic = ! empty($portfolio['contact']['form_static']);
    $formAction = $portfolio['contact']['form_action'] ?? null;
    $formAction = $formAction ?: route('contact.store');
@endphp

@section('content')
    <x-page-header eyebrow="Contact" :title="$seo['h1']" :subtitle="$portfolio['contact']['blurb']" />

    <section class="page-body">
        <div class="container" style="display:grid;gap:1.5rem">
            @if (! empty($portfolio['contact']['form_enabled']))
                <div class="ui-card">
                    <h2 class="section-title" style="font-size:1.35rem">{{ $portfolio['contact']['form_title'] }}</h2>
                    <p class="muted" style="margin-bottom:1.25rem">{{ $portfolio['contact']['form_intro'] }}</p>

                    @if (session('contact_success'))
                        <p class="contact-alert contact-alert--success" role="status">{{ session('contact_success') }}</p>
                    @else
                        @if (session('contact_error'))
                            <p class="contact-alert contact-alert--error" role="alert">{{ session('contact_error') }}</p>
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
                                <input type="text" id="website" name="{{ $formStatic ? '_gotcha' : 'website' }}" tabindex="-1" autocomplete="off" value="">
                            </div>

                            <label>
                                Name
                                <input type="text" name="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name" placeholder="Your name" x-model="name">
                                @error('name')<span class="contact-form__error">{{ $message }}</span>@enderror
                            </label>

                            <label>
                                Email
                                <input type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email" placeholder="you@example.com" x-model="email">
                                @error('email')<span class="contact-form__error">{{ $message }}</span>@enderror
                            </label>

                            <label>
                                Subject <span class="muted">(optional)</span>
                                <input type="text" name="subject" value="{{ old('subject') }}" maxlength="160" placeholder="What's your subject?" x-model="subject">
                            </label>

                            <label>
                                Message
                                <textarea name="message" rows="5" required maxlength="5000" placeholder="What are you building and how can I help?" x-model="message">{{ old('message') }}</textarea>
                                @error('message')<span class="contact-form__error">{{ $message }}</span>@enderror
                            </label>

                            <div>
                                <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="auto" data-size="flexible" data-callback="onTurnstileSuccess"></div>
                                @error('cf-turnstile-response')<span class="contact-form__error">{{ $message }}</span>@enderror
                                <p class="contact-form__error" x-show="captchaError" x-cloak x-text="captchaError"></p>
                            </div>

                            <p class="contact-alert contact-alert--success" x-show="done" x-cloak x-text="successMessage"></p>
                            <p class="contact-alert contact-alert--error" x-show="error" x-cloak x-text="error"></p>

                            <div x-show="!done">
                                <button type="submit" class="btn btn--primary" :disabled="sending" :aria-busy="sending">
                                    <span x-show="!sending">Send message</span>
                                    <span x-cloak x-show="sending">Sending…</span>
                                </button>
                                <p class="muted" style="margin-top:.75rem;font-size:.9rem">Confirmation goes to your inbox · reply within 24-48 hours</p>
                            </div>
                        </form>
                    @endif
                </div>
            @endif

            <div class="card-grid">
                <div class="ui-card">
                    <p class="eyebrow">Reach me directly</p>
                    <p><a href="{{ $portfolio['email_href'] }}">{{ $portfolio['email'] }}</a></p>
                    @if (! empty($portfolio['phone_href']))
                        <p style="margin-top:.5rem"><a href="{{ $portfolio['phone_href'] }}" target="_blank" rel="noopener noreferrer">WhatsApp</a></p>
                    @endif
                    <p style="margin-top:.5rem"><a href="{{ $portfolio['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer">LinkedIn</a></p>
                </div>
                <div class="ui-card">
                    <p class="eyebrow">{{ $portfolio['contact']['current_role']['duration'] }}</p>
                    <h3>{{ $portfolio['contact']['current_role']['role'] }}</h3>
                    <p style="color:var(--primary)">{{ $portfolio['contact']['current_role']['company'] }} · {{ $portfolio['location'] }}</p>
                    <p style="margin-top:.75rem">{{ $portfolio['contact']['availability'] }}</p>
                </div>
            </div>

            @if (! empty($seo['faqs']))
                <div>
                    <h2 class="section-title" style="font-size:1.35rem;margin-bottom:1rem">Frequently asked questions</h2>
                    <div class="card-grid">
                        @foreach ($seo['faqs'] as $faq)
                            <div class="ui-card">
                                <h3>{{ $faq['question'] }}</h3>
                                <p>{{ $faq['answer'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
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
            if (!this.turnstileToken) {
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
                    const response = await fetch(this.endpoint, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
                        body: JSON.stringify({
                            name: this.name,
                            email: this.email,
                            subject: this.subject || 'Portfolio contact',
                            message: this.message,
                            _subject: 'New portfolio contact from ' + this.name,
                            _template: 'table',
                            _autoresponse: this.autoresponse,
                            'cf-turnstile-response': this.turnstileToken,
                        }),
                    });
                    if (!response.ok) throw new Error('Unable to send right now.');
                    this.done = true;
                } else {
                    HTMLFormElement.prototype.submit.call(this.$el);
                    return;
                }
            } catch (e) {
                this.error = 'Sorry. The message could not be sent right now. Please email me directly or try again later.';
            } finally {
                this.sending = false;
            }
        },
    }));
});
</script>
@endpush
