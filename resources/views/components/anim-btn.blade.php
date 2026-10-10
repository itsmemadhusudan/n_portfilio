@props([
    'href' => '#',
    'variant' => 'solid',
    'external' => false,
])

<x-button :href="$href" :variant="$variant" :external="$external" {{ $attributes }}>
    {{ $slot }}
</x-button>
