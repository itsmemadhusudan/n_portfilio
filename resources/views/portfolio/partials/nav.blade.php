<header class="site-nav" x-data="{ open: false }">
    <div class="site-nav__bar">
        <a href="{{ route('home') }}" class="site-nav__brand">
            {{ $portfolio['brand_mark'] ?? 'MT' }}
        </a>

        <nav class="site-nav__links" aria-label="Main">
            @foreach ($portfolio['nav'] as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a
                    href="{{ route($item['route']) }}"
                    class="site-nav__link {{ $active ? 'is-active' : '' }}"
                    @if ($active) aria-current="page" @endif
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="site-nav__actions">
            <a href="{{ route('contact') }}" class="site-nav__cta">Hire Me</a>
            <button
                type="button"
                class="site-nav__toggle"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-label="Toggle navigation menu"
            >
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/>
                </svg>
                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak x-transition class="site-nav__mobile">
        <div class="site-nav__mobile-panel">
            @foreach ($portfolio['nav'] as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a
                    href="{{ route($item['route']) }}"
                    class="site-nav__link site-nav__link--block {{ $active ? 'is-active' : '' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('contact') }}" class="site-nav__cta site-nav__cta--block">Hire Me</a>
        </div>
    </div>
</header>
