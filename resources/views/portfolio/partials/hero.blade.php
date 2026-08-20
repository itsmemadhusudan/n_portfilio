<header class="hero page-wrap">
    <div class="hero-copy">
        <p class="hero-kicker">Hi I am</p>
        <h1 class="hero-name">{{ $portfolio['full_name'] }}</h1>
        <p class="hero-role">{{ $portfolio['title'] }}</p>

        <div class="hero-social" aria-label="Social links">
            <a
                href="{{ $portfolio['social']['linkedin'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="hero-social__link"
                aria-label="LinkedIn profile"
            >
                <x-icon name="linkedin" :size="16" />
            </a>
            <a
                href="{{ $portfolio['email_href'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="hero-social__link"
                aria-label="Send an email via Gmail"
            >
                <x-icon name="mail" :size="16" />
            </a>
            <a
                href="{{ $portfolio['phone_href'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="hero-social__link"
                aria-label="Chat on WhatsApp"
            >
                <x-icon name="phone" :size="16" />
            </a>
        </div>

        <div class="hero-actions">
            <a href="{{ route('contact') }}" class="btn-pill btn-pill--solid">Hire Me</a>
            @if (! empty($portfolio['cv']))
                <a href="{{ $portfolio['cv'] }}" class="btn-pill btn-pill--ghost" download>Download CV</a>
            @else
                <a href="{{ route('about') }}" class="btn-pill btn-pill--ghost">Download CV</a>
            @endif
        </div>

        <div class="hero-stats" aria-label="Career highlights">
            @foreach ($portfolio['stats'] as $stat)
                <div class="hero-stats__item">
                    <span class="hero-stats__value">{{ $stat['value'] }}</span>
                    <span class="hero-stats__label">{{ $stat['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="hero__visual">
        <div class="hero-portrait">
            <img
                src="{{ asset('images/bgimage.png') }}"
                alt="{{ $portfolio['full_name'] }}, Backend Developer at Smartsarka Pvt. Ltd."
                title="{{ $portfolio['full_name'] }} — Backend Developer"
                class="hero-portrait__img"
                width="360"
                height="360"
                fetchpriority="high"
                decoding="async"
                loading="eager"
            >
        </div>
    </div>
</header>
