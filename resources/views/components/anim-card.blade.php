@props([
    'padding' => 'p-5',
    'href' => null,
])

<x-card :padding="$padding" :href="$href" {{ $attributes }}>
    {{ $slot }}
</x-card>
