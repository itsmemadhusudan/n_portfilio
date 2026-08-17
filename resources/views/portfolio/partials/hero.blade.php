<header class="hero page-wrap">
    <div
        class="hero-copy"
        x-data="{ shown: false }"
        x-intersect:enter.once="shown = true"
        :style="{
            opacity: shown ? 1 : 0,
            transform: shown ? 'translateY(0)' : 'translateY(16px)',
            transition: 'opacity 0.55s ease 0ms, transform 0.55s cubic-bezier(0.22,1,0.36,1) 0ms',
        }"
    >
        <div class="hero-photo-wrap">
            <img
                src="{{ asset('images/1738049302099.jpg') }}"
                alt="{{ $portfolio['full_name'] }}, Backend Developer at Smartsarka Pvt. Ltd."
                title="{{ $portfolio['full_name'] }} — Backend Developer"
                class="hero-photo"
                width="104"
                height="104"
                fetchpriority="high"
                decoding="async"
                loading="eager"
            >
        </div>

        <h1 class="text-3xl sm:text-[2.35rem] leading-[1.15] font-display" style="font-weight: 600; color: var(--text-primary); margin: 0 0 8px; letter-spacing: -0.03em;">
            {{ $portfolio['full_name'] }}
        </h1>

        <p class="hero-role">
            {{ $portfolio['contact']['current_role']['role'] }} · {{ $portfolio['contact']['current_role']['company'] }}
        </p>

        <p class="hero-copy__bio">
            {{ $portfolio['bio'] }}
        </p>

        <div class="flex flex-wrap gap-2.5 justify-center">
            <x-anim-btn :href="route('contact')" variant="solid">
                <x-icon name="mail" :size="16" />
                Contact me
            </x-anim-btn>
            <x-anim-btn :href="route('projects')" variant="ghost">
                <x-icon name="arrow-up-right" :size="16" />
                View projects
            </x-anim-btn>
        </div>
    </div>

    <div class="hero__visual">
        <div class="hero-terminal">
            @include('portfolio.partials.terminal')
        </div>
    </div>
</header>
