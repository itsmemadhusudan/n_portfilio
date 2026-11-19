@props([
    'href' => null,
    'variant' => 'primary',
    'external' => false,
])
@php
    $class = match ($variant) {
        'ghost' => 'btn btn--ghost-dark',
        'solid', 'primary' => 'btn btn--primary',
        'accent' => 'btn btn--accent',
        'dark' => 'btn btn--dark',
        default => 'btn btn--primary',
    };
@endphp
@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => $class]) }}
        @if ($external) target="_blank" rel="noopener noreferrer" @endif
    >{{ $slot }}</a>
@else
    <button type="button" {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</button>
@endif
