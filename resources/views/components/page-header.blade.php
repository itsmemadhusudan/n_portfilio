@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
])
<section class="page-hero">
    <div class="container">
        @if ($eyebrow)
            <p class="eyebrow" style="color: rgba(255,255,255,0.7)">{{ $eyebrow }}</p>
        @endif
        <h1>{{ $title }}</h1>
        @if ($subtitle)
            <p>{{ $subtitle }}</p>
        @endif
    </div>
</section>
