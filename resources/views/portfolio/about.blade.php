@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="About"
        :title="$seo['h1']"
        :subtitle="$portfolio['about_intro']"
    />

    <section class="page-wrap pb-10">
        <div class="about-grid mb-10">
            <div
                class="reveal"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <h2 class="about-name">{{ $portfolio['full_name'] }}</h2>
                @foreach ($portfolio['about_story'] as $paragraph)
                    <p class="text-[15px] leading-relaxed mb-4 last:mb-0" style="color: var(--text-secondary);">{{ $paragraph }}</p>
                @endforeach

                <p class="text-[15px] leading-relaxed mt-6" style="color: var(--text-secondary);">{{ $portfolio['bio'] }}</p>

                <h3 class="section-label mt-8 mb-3">Work History</h3>
                <ul class="work-history">
                    <li class="work-history__item">
                        <p class="work-history__role">{{ $portfolio['contact']['current_role']['role'] }}</p>
                        <p class="work-history__company">{{ $portfolio['contact']['current_role']['company'] }}</p>
                        <p class="work-history__dates">{{ $portfolio['contact']['current_role']['duration'] }} · {{ $portfolio['location'] }}</p>
                        <p class="text-sm mt-2 leading-relaxed" style="color: var(--text-secondary);">
                            {{ $portfolio['contact']['current_role']['summary'] }}
                        </p>
                    </li>
                </ul>

                <div class="mt-6 flex items-center gap-3">
                    <a href="{{ $portfolio['email_href'] }}" target="_blank" rel="noopener noreferrer" class="contact-chip" aria-label="Send an email via Gmail">
                        <x-icon name="mail" :size="18" />
                    </a>
                    <a href="{{ $portfolio['phone_href'] }}" target="_blank" rel="noopener noreferrer" class="contact-chip" aria-label="Chat on WhatsApp">
                        <x-icon name="phone" :size="18" />
                    </a>
                    <a href="{{ $portfolio['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="contact-chip" aria-label="LinkedIn profile">
                        <x-icon name="linkedin" :size="18" />
                    </a>
                    @if (! empty($portfolio['social']['github']))
                        <a href="{{ $portfolio['social']['github'] }}" target="_blank" rel="noopener noreferrer" class="contact-chip" aria-label="GitHub profile">
                            <x-icon name="github" :size="18" />
                        </a>
                    @endif
                </div>
            </div>

            <div
                class="about-photo reveal"
                style="--reveal-delay: 80ms"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <div class="about-photo__frame">
                    <img
                        class="about-photo__img"
                        src="{{ asset('images/about.jpg') }}"
                        alt="{{ $portfolio['full_name'] }}, Backend Developer"
                        width="320"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="about-photo__badge">
                    <span class="about-photo__badge-role">TECH DEPARTMENT</span>
                </div>
            </div>
        </div>

        <div class="mb-10">
            <x-section-title title="Focus areas" />
            <ul class="grid sm:grid-cols-2 gap-3">
                @foreach ($portfolio['about_focus'] as $item)
                    <li>
                        <x-card padding="px-4 py-3">
                            <div class="text-sm flex gap-2" style="color: var(--text-secondary);">
                                <span class="mt-1.5 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--neon-cyan);"></span>
                                <span>{{ $item }}</span>
                            </div>
                        </x-card>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mb-10">
            <x-section-title title="What I value" />
            <div class="grid sm:grid-cols-2 gap-3">
                @foreach ($portfolio['values'] as $value)
                    <x-card padding="p-3.5">
                        <h3 class="font-medium mb-1 text-[13px] font-display" style="color: var(--text-primary);">{{ $value['title'] }}</h3>
                        <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $value['desc'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>

        <div class="mb-10">
            <x-section-title title="Freelance & collaboration" :subtitle="$portfolio['freelance']['intro']" />
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($portfolio['freelance']['offers'] as $offer)
                    <x-card padding="px-4 py-3">
                        <p class="text-sm" style="color: var(--text-primary);">{{ $offer }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>

        <div class="flex flex-wrap gap-3 pb-6">
            <x-button :href="route('projects')" variant="solid">See projects</x-button>
            <x-button :href="route('contact')" variant="ghost">Contact me</x-button>
        </div>
    </section>
@endsection
