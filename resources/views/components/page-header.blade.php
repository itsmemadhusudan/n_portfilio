@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'accent' => 'var(--neon-cyan)',
])

<header class="page-wrap pt-12 pb-6">
    @if ($eyebrow)
        <span class="section-label" style="color: {{ $accent }}; display: block;">
            {{ $eyebrow }}
        </span>
    @endif
    <h1 class="section-title text-3xl sm:text-4xl">
        {{ $title }}
    </h1>
    @if ($subtitle)
        <p class="section-title__sub">
            {{ $subtitle }}
        </p>
    @endif
</header>
