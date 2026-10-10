@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
])

<div {{ $attributes->class('mb-6') }}>
    @if ($eyebrow)
        <p class="section-label">{{ $eyebrow }}</p>
    @endif
    <h2 class="section-title">{{ $title }}</h2>
    @if ($subtitle)
        <p class="section-title__sub">{{ $subtitle }}</p>
    @endif
</div>
