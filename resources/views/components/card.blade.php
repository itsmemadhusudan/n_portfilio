@props(['padding' => ''])
<div {{ $attributes->merge(['class' => 'ui-card '.($padding ?: '')]) }}>
    {{ $slot }}
</div>
