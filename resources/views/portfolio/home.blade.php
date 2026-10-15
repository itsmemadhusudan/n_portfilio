@extends('layouts.portfolio')

@section('content')
    @include('portfolio.partials.hero')
    @include('portfolio.partials.stats-code')

    <section class="page-section page-section--alt" aria-labelledby="home-about-title">
        <div class="page-wrap about-grid">
            <div
                class="reveal"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <h2 id="home-about-title" class="section-label">About</h2>
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
                        alt="{{ $portfolio['full_name'] }}, {{ $portfolio['title'] }}"
                        width="320"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" aria-labelledby="home-skills-title">
        <div class="page-wrap">
            <x-section-title
                eyebrow="Skills"
                title="Languages, frameworks & tools"
                :subtitle="$portfolio['backend_intro']"
            />
            <h2 id="home-skills-title" class="sr-only">Skills</h2>
            @include('portfolio.partials.skills-tabs', [
                'skillsByCategory' => $skillsByCategory,
                'skillCategories' => $portfolio['skill_categories'] ?? [],
            ])
            <div class="mt-6">
                <x-button :href="route('skills')" variant="ghost">View all skills</x-button>
            </div>
        </div>
    </section>

    <section class="page-section page-section--alt" aria-labelledby="home-projects-title">
        <div class="page-wrap mb-6 flex flex-wrap items-end justify-between gap-4">
            <x-section-title
                class="mb-0"
                eyebrow="Projects"
                title="Featured builds"
            />
            <h2 id="home-projects-title" class="sr-only">Featured builds</h2>
            <x-button :href="route('projects')" variant="ghost">View all</x-button>
        </div>
        <div class="page-wrap project-grid">
            @foreach ($featuredProjects as $project)
                @include('portfolio.partials.project-card', ['project' => $project, 'skillMap' => $skillMap])
            @endforeach
        </div>
    </section>

    <section class="page-section" aria-labelledby="home-built-title">
        <div class="page-wrap">
            <x-section-title
                eyebrow="Stack"
                title="How this site is built"
            />
            <h2 id="home-built-title" class="sr-only">How this site is built</h2>
            <ul class="grid sm:grid-cols-2 gap-3">
                @foreach ($portfolio['how_built'] ?? [] as $item)
                    <li>
                        <x-card padding="px-4 py-3">
                            <p class="text-sm" style="color: var(--text-secondary);">{{ $item }}</p>
                        </x-card>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="page-section page-section--alt" aria-labelledby="home-education-title">
        <div class="page-wrap">
            <x-section-title
                eyebrow="Education"
                title="Learning path"
            />
            <h2 id="home-education-title" class="sr-only">Education</h2>
        </div>
        @include('portfolio.partials.education', ['standalone' => true, 'timelineOnly' => true])
        <div class="page-wrap mt-6">
            <x-button :href="route('education')" variant="ghost">Full education & leadership</x-button>
        </div>
    </section>

    <section class="page-section" aria-labelledby="home-contact-title">
        <div class="page-wrap">
            <x-card padding="p-8 sm:p-10">
                <p class="section-label">Hire a developer</p>
                <h2 id="home-contact-title" class="section-title mb-3">{{ $portfolio['contact']['title'] }}</h2>
                <p class="text-[15px] max-w-2xl mb-6 leading-relaxed" style="color: var(--text-secondary);">
                    {{ $portfolio['contact']['blurb'] }} Based in {{ $portfolio['location'] }}, open to remote developer and local collaboration.
                </p>
                <div class="flex flex-wrap gap-3">
                    <x-button :href="route('contact')" variant="solid">Hire a web developer</x-button>
                    <x-button :href="$portfolio['email_href']" variant="ghost" :external="true">Email me</x-button>
                </div>
            </x-card>
        </div>
    </section>
@endsection
