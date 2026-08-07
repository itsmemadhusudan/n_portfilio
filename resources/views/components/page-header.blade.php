@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'accent' => 'var(--coral)',
])

<div class="max-w-7xl mx-auto px-6 pt-10 pb-8">
    @if ($eyebrow)
        <span class="text-xs uppercase tracking-wider font-mono" style="color: {{ $accent }}; font-weight: 500;">
            {{ $eyebrow }}
        </span>
    @endif
    <h1 class="text-3xl sm:text-4xl mt-2 font-display" style="font-weight: 700; color: #F8FAFC;">
        {{ $title }}
    </h1>
    @if ($subtitle)
        <p class="mt-3 max-w-2xl text-base leading-relaxed" style="color: #CBD5E1;">
            {{ $subtitle }}
        </p>
    @endif
</div>
