@props([
    'href' => null,
    'variant' => 'solid',
    'external' => false,
    'type' => 'button',
])

@php
    $classes = 'btn-neon btn-neon--'.$variant;
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        @if ($external) target="_blank" rel="noopener noreferrer" @endif
        {{ $attributes->class($classes) }}
    >
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
