@extends('layouts.portfolio')

@section('content')
    @include('portfolio.partials.hero')
    @include('portfolio.partials.stats-code')

    {{-- About teaser --}}
    <section class="page-section page-section--alt" aria-labelledby="home-about-title">
        <div class="page-wrap about-grid">
            <div
                class="reveal"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <p class="section-label">About</p>
                <h2 id="home-about-title" class="about-name">{{ $portfolio['full_name'] }}</h2>
                <p class="text-[15px] leading-relaxed mb-4" style="color: var(--text-secondary);">
                    {{ $portfolio['about_intro'] }}
                </p>
                @foreach (array_slice($portfolio['about_story'], 0, 2) as $paragraph)
                    <p class="text-[15px] leading-relaxed mb-4 last:mb-0" style="color: var(--text-secondary);">
                        {{ $paragraph }}
                    </p>
                @endforeach

                <h3 class="section-label mt-8 mb-3">Work History</h3>
                <ul class="work-history">
                    <li class="work-history__item">
                        <p class="work-history__role">{{ $portfolio['contact']['current_role']['role'] }}</p>
                        <p class="work-history__company">{{ $portfolio['contact']['current_role']['company'] }}</p>
                        <p class="work-history__dates">{{ $portfolio['contact']['current_role']['duration'] }} · {{ $portfolio['location'] }}</p>
                    </li>
                </ul>

                <div class="mt-6">
                    <x-button :href="route('about')" variant="ghost">More about me</x-button>
                </div>
            </div>

            <div
                class="about-frame reveal"
                style="--reveal-delay: 80ms"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <picture>
                    <source srcset="{{ asset('images/bgimage.webp') }}" type="image/webp">
                    <img
                        src="{{ asset('images/bgimage-avatar.jpg') }}"
                        alt="{{ $portfolio['full_name'] }} — backend development workspace portrait"
                        width="640"
                        height="800"
                        loading="lazy"
                        decoding="async"
                    >
                </picture>
            </div>
        </div>
    </section>

    {{-- Skills --}}
    <section class="page-section" aria-labelledby="home-skills-title">
        <div class="page-wrap">
            <x-section-title
                eyebrow="Skills"
                title="Backend, data & tooling"
                :subtitle="$portfolio['backend_intro']"
            />
        </div>
        @include('portfolio.partials.stack', ['standalone' => true, 'limitGroups' => true])
        <div class="page-wrap mt-6">
            <x-button :href="route('skills')" variant="ghost">View all skills</x-button>
        </div>
    </section>

    {{-- Projects --}}
    <section class="page-section page-section--alt" aria-labelledby="home-projects-title">
        <div class="page-wrap mb-6 flex flex-wrap items-end justify-between gap-4">
            <x-section-title
                class="mb-0"
                eyebrow="Projects"
                title="Featured builds"
            />
            <x-button :href="route('projects')" variant="ghost">View all</x-button>
        </div>
        @include('portfolio.partials.projects', ['standalone' => true, 'limit' => 4])
    </section>

    {{-- Education --}}
    <section class="page-section" aria-labelledby="home-education-title">
        <div class="page-wrap">
            <x-section-title
                id="home-education-title"
                eyebrow="Education"
                title="Learning path"
            />
        </div>
        @include('portfolio.partials.education', ['standalone' => true, 'timelineOnly' => true])
        <div class="page-wrap mt-6">
            <x-button :href="route('education')" variant="ghost">Full education & leadership</x-button>
        </div>
    </section>

    {{-- Contact CTA --}}
    <section class="page-section page-section--alt" aria-labelledby="home-contact-title">
        <div class="page-wrap">
            <x-card padding="p-8 sm:p-10">
                <p class="section-label">Contact</p>
                <h2 id="home-contact-title" class="section-title mb-3">{{ $portfolio['contact']['title'] }}</h2>
                <p class="text-[15px] max-w-2xl mb-6 leading-relaxed" style="color: var(--text-secondary);">
                    {{ $portfolio['contact']['blurb'] }} Based in {{ $portfolio['location'] }} — open to remote and local collaboration.
                </p>
                <div class="flex flex-wrap gap-3">
                    <x-button :href="route('contact')" variant="solid">Hire Me</x-button>
                    <x-button :href="$portfolio['email_href']" variant="ghost" :external="true">Email me</x-button>
                </div>
            </x-card>
        </div>
    </section>
@endsection
