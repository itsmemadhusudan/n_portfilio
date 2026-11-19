<section class="hero" aria-labelledby="hero-heading">
    <div class="hero__bg" aria-hidden="true">
        <div class="hero__glow"></div>
    </div>

    <div class="hero__inner">
        <div class="hero__copy hero-enter">
            <p class="hero__hello">Hi, I'm {{ $portfolio['name'] }},</p>
            <h1 id="hero-heading" class="hero__role">{{ $portfolio['hero_role'] ?? $portfolio['title'] }}</h1>
            <p class="hero__desc">
                {{ $portfolio['headline'] }}. {{ $portfolio['tagline'] }}
            </p>
            <div class="hero__actions">
                <a href="{{ route('contact') }}" class="btn btn--primary">Hire Me</a>
                <a href="{{ route('projects') }}" class="btn btn--ghost">My Portfolio</a>
            </div>
        </div>

        <div class="hero__visual hero-enter hero-enter--delay">
            <div class="hero-photo reveal-scale">
                <img
                    src="{{ asset(ltrim($portfolio['photo_cutout'] ?? '/images/portrait.jpg', '/')) }}"
                    alt="{{ $portfolio['full_name'] }}, {{ $portfolio['title'] }}"
                    width="420"
                    height="525"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
        </div>
    </div>
</section>
