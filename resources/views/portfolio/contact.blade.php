@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Contact"
        :title="$seo['h1']"
        :subtitle="$portfolio['contact']['blurb']"
        accent="var(--mint)"
    />

    <section class="page-wrap pb-10">
        <div class="contact-layout mb-10">
            {{-- Primary: message form --}}
            <div class="contact-layout__main">
                @if (! empty($portfolio['contact']['form_enabled']))
                    <x-anim-card padding="p-6 sm:p-8" class="contact-form-card">
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
                                <a href="{{ route('contact') }}#contact-form" class="btn-pill btn-pill--ghost">
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
                                action="{{ route('contact.store') }}"
                                method="POST"
                                class="contact-form"
                                novalidate
                            >
                                @csrf

                                <div class="contact-form__honeypot" aria-hidden="true">
                                    <label for="website">Website</label>
                                    <input
                                        type="text"
                                        id="website"
                                        name="website"
                                        tabindex="-1"
                                        autocomplete="off"
                                        value="{{ old('website') }}"
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
                                        placeholder="Project idea, freelance work, collaboration…"
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
                                        placeholder="What are you building, and how can I help?"
                                    >{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="contact-form__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="contact-form__actions">
                                    <button type="submit" class="btn-pill btn-pill--solid">
                                        Send message
                                    </button>
                                    <p class="contact-form__note">
                                        Confirmation goes to your inbox · reply within 24–48 hours
                                    </p>
                                </div>
                            </form>
                        @endif
                    </x-anim-card>
                @endif
            </div>

            {{-- Side: reach me + role --}}
            <aside class="contact-layout__aside">
                <x-anim-card padding="p-5">
                    <p class="section-label mb-3">Reach me directly</p>
                    <div class="contact-channels">
                        <a
                            href="{{ $portfolio['email_href'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-channel"
                        >
                            <span class="contact-channel__icon" aria-hidden="true">
                                <x-icon name="mail" :size="16" />
                            </span>
                            <span>
                                <span class="contact-channel__label">Email</span>
                                <span class="contact-channel__value">{{ $portfolio['email'] }}</span>
                            </span>
                        </a>
                        <a
                            href="{{ $portfolio['phone_href'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-channel"
                        >
                            <span class="contact-channel__icon" aria-hidden="true">
                                <x-icon name="phone" :size="16" />
                            </span>
                            <span>
                                <span class="contact-channel__label">WhatsApp</span>
                                <span class="contact-channel__value">{{ $portfolio['phone'] }}</span>
                            </span>
                        </a>
                        <a
                            href="{{ $portfolio['social']['linkedin'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-channel"
                        >
                            <span class="contact-channel__icon" aria-hidden="true">
                                <x-icon name="linkedin" :size="16" />
                            </span>
                            <span>
                                <span class="contact-channel__label">LinkedIn</span>
                                <span class="contact-channel__value">madhusudan-timalsina</span>
                            </span>
                        </a>
                        @if (! empty($portfolio['social']['github']))
                            <a
                                href="{{ $portfolio['social']['github'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="contact-channel"
                            >
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
                </x-anim-card>

                <x-anim-card padding="p-5">
                    <p class="section-label">{{ $portfolio['contact']['current_role']['duration'] }}</p>
                    <p class="font-display text-lg mt-1" style="font-weight: 600; color: var(--text-primary);">
                        {{ $portfolio['contact']['current_role']['role'] }}
                    </p>
                    <p class="text-sm mt-1" style="color: var(--text-accent);">
                        {{ $portfolio['contact']['current_role']['company'] }} · {{ $portfolio['location'] }}
                    </p>
                    <p class="text-sm mt-3 leading-relaxed" style="color: var(--text-secondary);">
                        {{ $portfolio['contact']['availability'] }}
                    </p>
                </x-anim-card>

                <x-anim-card padding="p-5">
                    <h2 class="text-base font-display mb-3" style="font-weight: 600; color: var(--text-primary);">
                        Good conversation topics
                    </h2>
                    <ul class="space-y-2.5">
                        @foreach ($portfolio['contact']['topics'] as $item)
                            <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                                <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--blue);"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-anim-card>
            </aside>
        </div>

        @if (! empty($seo['faqs']))
            <div>
                <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">
                    Frequently asked questions
                </h2>
                <div class="grid sm:grid-cols-2 gap-3">
                    @foreach ($seo['faqs'] as $faq)
                        <x-anim-card padding="p-4">
                            <h3 class="font-medium mb-2 text-[13px]" style="color: var(--text-primary);">{{ $faq['question'] }}</h3>
                            <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $faq['answer'] }}</p>
                        </x-anim-card>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
