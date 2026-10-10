@php
    $headline = $portfolio['headline'] ?? '';
    $words = preg_split('/\s+/', trim($headline)) ?: [];
    $mid = (int) ceil(count($words) / 2);
    $lineOne = implode(' ', array_slice($words, 0, $mid));
    $lineTwo = implode(' ', array_slice($words, $mid));
@endphp

<header class="hero page-wrap">
    <div class="hero-copy hero-enter">
        <p class="hero-kicker">{{ $portfolio['title'] }}</p>
        <h1 class="hero-headline">
            <span class="hero-headline__line">{{ $lineOne }}</span>
            @if ($lineTwo !== '')
                <span class="hero-headline__line text-gradient">{{ $lineTwo }}</span>
            @endif
        </h1>
        <p class="hero-bio">{{ $portfolio['bio'] }}</p>

        <div class="hero-actions">
            <x-button :href="route('contact')" variant="solid">Hire Me</x-button>
            @if (! empty($portfolio['cv']))
                <x-button :href="$portfolio['cv']" variant="ghost" :external="true">
                    <x-icon name="download" :size="16" />
                    Download CV
                </x-button>
            @endif
        </div>

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
            @if (! empty($portfolio['social']['github']))
                <a
                    href="{{ $portfolio['social']['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hero-social__link"
                    aria-label="GitHub profile"
                >
                    <x-icon name="github" :size="16" />
                </a>
            @endif
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

        @if (! empty($portfolio['badge']))
            <p class="hero-badge">
                <span class="hero-badge__dot" aria-hidden="true"></span>
                {{ $portfolio['badge'] }}
            </p>
        @endif
    </div>

    <div class="hero__visual hero-enter hero-enter--delay" aria-hidden="false">
        <div class="portrait-ring">
            <div class="portrait-ring__orbit" aria-hidden="true"></div>
            <div class="portrait-ring__text" aria-hidden="true">
                <svg viewBox="0 0 200 200">
                    <defs>
                        <path id="portrait-circle" d="M 100,100 m -78,0 a 78,78 0 1,1 156,0 a 78,78 0 1,1 -156,0" />
                    </defs>
                    <text>
                        <textPath href="#portrait-circle" startOffset="0%">
                            BACKEND · API · DATABASE · SYSTEMS · CODE ·
                        </textPath>
                    </text>
                </svg>
            </div>
            <div class="portrait-ring__img-wrap">
                <picture>
                    <source srcset="{{ asset('images/bgimage.webp') }}" type="image/webp">
                    <img
                        src="{{ asset('images/bgimage-avatar.jpg') }}"
                        alt="{{ $portfolio['full_name'] }}, Backend Developer at Smart Sarks"
                        title="{{ $portfolio['full_name'] }} — Backend Developer"
                        width="360"
                        height="360"
                        sizes="(min-width: 900px) 280px, 72vw"
                        fetchpriority="high"
                        decoding="async"
                        loading="eager"
                    >
                </picture>
            </div>
        </div>
    </div>
</header>
