@props([
    'padding' => 'p-5',
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->class('neon-card hover-lift') }}
>
    <div class="neon-card__inner {{ $padding }}">
        {{ $slot }}
    </div>
</{{ $tag }}>
