@props([
    'name',
    'slug' => null,
    'proficiency' => 'proficient',
    'icon' => 'code',
])
@if ($slug)
    <a href="{{ route('stack.show', $slug) }}" class="chip" {{ $attributes }}>
        {{ $name }}
        @if ($proficiency === 'learning')
            <span style="opacity:.7"> · learning</span>
        @endif
    </a>
@else
    <span class="chip" {{ $attributes }}>{{ $name }}</span>
@endif
