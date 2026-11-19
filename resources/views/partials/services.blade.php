@php
    $serviceIcons = [
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 20h8"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3 4 7v5c0 4.5 3.4 8.4 8 9 4.6-.6 8-4.5 8-9V7l-8-4z"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3-3"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19V7a2 2 0 0 1 2-2h7l5 5v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M13 5v5h5"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18"/></svg>',
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 16.5 12 4l8 12.5H4z"/><path d="M9.5 13h5"/></svg>',
    ];
@endphp
<section id="services" class="section section--light" aria-labelledby="services-title">
    <div class="container services-layout">
        <div>
            <p class="eyebrow reveal">What I Do</p>
            <h2 id="services-title" class="section-title reveal">Services</h2>
            <div class="services-grid">
                @foreach ($portfolio['services'] as $i => $service)
                    <article class="service-item reveal" style="--reveal-delay: {{ min($i, 5) * 60 }}ms">
                        <div class="service-item__icon" aria-hidden="true">{!! $serviceIcons[$i % count($serviceIcons)] !!}</div>
                        <div>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['desc'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="services-photo reveal" style="--reveal-delay: 120ms">
            <img
                src="{{ asset(ltrim($portfolio['photo_cutout'] ?? $portfolio['photo'] ?? '/images/portrait.jpg', '/')) }}"
                alt="{{ $portfolio['full_name'] }} at work"
                width="360"
                height="480"
                loading="lazy"
                decoding="async"
            >
        </div>
    </div>
</section>
