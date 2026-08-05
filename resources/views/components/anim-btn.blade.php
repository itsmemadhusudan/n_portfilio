@props([
    'href' => '#',
    'variant' => 'solid',
    'external' => false,
])

<a
    href="{{ $href }}"
    @if ($external) target="_blank" rel="noopener noreferrer" @endif
    {{ $attributes->class('anim-btn anim-btn--'.$variant) }}
>
    <span class="anim-btn__glow" aria-hidden="true"></span>
    <span class="anim-btn__inner">
        {{ $slot }}
    </span>
</a>
