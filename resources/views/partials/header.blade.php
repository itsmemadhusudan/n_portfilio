@php
    $headerNav = $portfolio['header_nav'] ?? [];
@endphp
<header class="site-header {{ $pageKey === 'home' ? '' : 'is-solid' }}" data-site-header>
    <div class="container site-header__inner">
        <a href="{{ route('home') }}" class="brand" aria-label="{{ $portfolio['full_name'] }} home">
            <img
                class="brand__logo brand__logo--full"
                src="{{ asset(ltrim($portfolio['logo'] ?? '/images/logo/logo-light.svg', '/')) }}"
                alt="{{ $portfolio['full_name'] }}"
                width="240"
                height="40"
            >
            <img
                class="brand__logo brand__logo--icon"
                src="{{ asset(ltrim($portfolio['logo_icon'] ?? '/images/logo/logo-icon.svg', '/')) }}"
                alt="{{ $portfolio['full_name'] }}"
                width="40"
                height="40"
            >
        </a>

        <nav class="nav-desktop" aria-label="Primary">
            @foreach ($headerNav as $item)
                @if (($item['type'] ?? '') === 'dropdown')
                    <div class="nav-item" data-dropdown>
                        <button type="button" class="nav-link" aria-expanded="false" aria-haspopup="true">
                            {{ $item['label'] }}
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        <div class="nav-item__menu" role="menu">
                            @foreach ($item['children'] ?? [] as $child)
                                <a role="menuitem" href="{{ route($child['route'], $child['params'] ?? []) }}">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @elseif (($item['type'] ?? '') === 'anchor')
                    <a class="nav-link {{ ($item['route'] ?? null) && $pageKey === ($item['route'] ?? '') ? 'is-active' : '' }}" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                @else
                    <a class="nav-link {{ $pageKey === str_replace('.show', '', $item['route'] ?? '') || ($item['route'] ?? '') === $pageKey || (($item['route'] ?? '') === 'home' && $pageKey === 'home') ? 'is-active' : '' }}" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
                @endif
            @endforeach
        </nav>

        <div class="header-actions">
            <a href="{{ route('contact') }}" class="btn btn--primary btn--hire">Hire Me</a>
            <button type="button" class="icon-btn" data-search-open aria-label="Open search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            </button>
            <button type="button" class="icon-btn" data-theme-toggle aria-label="Toggle dark mode">
                <svg data-icon-moon viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 14.5A8.5 8.5 0 1 1 9.5 3 7 7 0 0 0 21 14.5z"/></svg>
                <svg data-icon-sun viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" hidden><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
            </button>
            <button type="button" class="icon-btn nav-toggle" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Open menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
    </div>
</header>

<div id="mobile-nav" class="mobile-panel" data-mobile-panel hidden>
    @foreach ($headerNav as $item)
        @if (($item['type'] ?? '') === 'dropdown')
            <button type="button" class="mobile-acc" data-mobile-acc aria-expanded="false">
                {{ $item['label'] }}
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div class="mobile-panel__sub">
                @foreach ($item['children'] ?? [] as $child)
                    <a href="{{ route($child['route'], $child['params'] ?? []) }}">{{ $child['label'] }}</a>
                @endforeach
            </div>
        @elseif (($item['type'] ?? '') === 'anchor')
            <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
        @else
            <a href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
        @endif
    @endforeach
    <div style="margin-top: 1.25rem">
        <a href="{{ route('contact') }}" class="btn btn--primary" style="width:100%">Hire Me</a>
    </div>
</div>
