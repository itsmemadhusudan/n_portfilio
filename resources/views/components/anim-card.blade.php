@props([
    'padding' => 'p-5',
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->class('anim-border') }}
>
    <div class="anim-border__glow" aria-hidden="true"></div>
    <div class="anim-border__inner {{ $padding }}">
        {{ $slot }}
    </div>
</{{ $tag }}>
