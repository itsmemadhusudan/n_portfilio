@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
])
<div {{ $attributes }}>
    @if ($eyebrow)
        <p class="eyebrow">{{ $eyebrow }}</p>
    @endif
    <h2 class="section-title">{{ $title }}</h2>
    @if ($subtitle)
        <p class="muted" style="max-width:42rem;margin:0 0 1.5rem">{{ $subtitle }}</p>
    @endif
</div>
