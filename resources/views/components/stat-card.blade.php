@props([
    'value',
    'label',
    'icon' => 'sparkles',
    'suffix' => null,
])

<div {{ $attributes->class('stat-card') }}>
    <span class="stat-card__icon" aria-hidden="true">
        <x-icon :name="$icon" :size="18" />
    </span>
    <span class="stat-card__value">
        {{ $value }}@if ($suffix)<span class="text-[0.65em] text-[var(--text-secondary)] font-medium"> {{ $suffix }}</span>@endif
    </span>
    <span class="stat-card__label">{{ $label }}</span>
</div>
