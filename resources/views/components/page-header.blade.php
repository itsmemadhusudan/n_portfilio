@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'accent' => 'var(--text-accent)',
])

<div class="page-wrap pt-12 pb-6">
    @if ($eyebrow)
        <span class="section-label" style="color: {{ $accent }}; display: block;">
            {{ $eyebrow }}
        </span>
    @endif
    <h1 class="text-3xl sm:text-4xl mt-1 font-display" style="font-weight: 600; color: var(--text-primary);">
        {{ $title }}
    </h1>
    @if ($subtitle)
        <p class="mt-3 max-w-2xl text-[15px] leading-relaxed" style="color: var(--text-secondary);">
            {{ $subtitle }}
        </p>
    @endif
</div>
