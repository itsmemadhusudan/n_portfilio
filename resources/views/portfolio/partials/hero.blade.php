<header class="max-w-7xl mx-auto px-6 pt-10 pb-20 grid md:grid-cols-2 gap-12 items-center">
    <div
        class="hero-copy"
        x-data="{ shown: false }"
        x-intersect:enter.once="shown = true"
        :style="{
            opacity: shown ? 1 : 0,
            transform: shown ? 'translateY(0)' : 'translateY(20px)',
            transition: 'opacity 0.6s ease 0ms, transform 0.6s cubic-bezier(0.22,1,0.36,1) 0ms',
        }"
    >
        <p class="text-sm font-medium mb-3 tracking-wide uppercase" style="color: var(--coral); letter-spacing: 0.06em;">
            {{ $portfolio['title'] }}
        </p>

        <h1 class="text-4xl sm:text-5xl leading-[1.12] mb-4 font-display" style="font-weight: 700; color: #FFFFFF;">
            Hi, I’m {{ $portfolio['full_name'] }}.
            <span class="block mt-2" style="color: #F1F5F9; font-weight: 600;">
                {{ $portfolio['headline'] }}
            </span>
        </h1>

        <p class="hero-copy__bio text-base sm:text-lg mb-8 max-w-lg leading-relaxed">
            {{ $portfolio['bio'] }}
        </p>

        <div class="flex flex-wrap gap-3">
            <x-anim-btn :href="route('projects')" variant="solid">
                View projects <x-icon name="arrow-up-right" :size="16" />
            </x-anim-btn>
            <x-anim-btn :href="route('contact')" variant="ghost">
                Contact me
            </x-anim-btn>
        </div>
    </div>

    <div class="hero__visual">
        <div class="hero-photo-wrap">
            <img
                src="{{ asset('images/1738049302099.jpg') }}"
                alt="{{ $portfolio['full_name'] }}, Backend Developer at Smartsarka Pvt. Ltd."
                title="{{ $portfolio['full_name'] }} — Backend Developer"
                class="hero-photo"
                width="320"
                height="320"
                fetchpriority="high"
                decoding="async"
                loading="eager"
            >
        </div>
        <div class="hero-terminal">
            @include('portfolio.partials.terminal')
        </div>
    </div>
</header>
