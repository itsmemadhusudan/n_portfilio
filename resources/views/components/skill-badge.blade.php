@props([
    'name',
    'slug' => null,
    'proficiency' => 'proficient',
    'icon' => 'code',
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'span';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->class('skill-badge') }}
>
    <span class="skill-badge__icon" aria-hidden="true">
        <x-icon :name="$icon" :size="14" />
    </span>
    <span class="skill-badge__name">{{ $name }}</span>
    @if ($proficiency === 'learning')
        <span class="skill-badge__learning">Learning</span>
    @endif
</{{ $tag }}>
