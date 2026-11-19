@php
    $skillMap = $skillMap ?? [];
    $tech = $project['tech'] ?? [];
@endphp
<article class="ui-card">
    <p class="eyebrow" style="margin-bottom:.35rem">{{ $project['tag'] ?? strtoupper($project['type'] ?? 'PROJECT') }}</p>
    <h3>
        <a href="{{ route('projects.show', $project['slug']) }}">{{ $project['name'] }}</a>
    </h3>
    <p style="margin:.45rem 0 .9rem">{{ $project['summary'] ?? $project['desc'] }}</p>
    <div class="chip-row" style="margin: .75rem 0 1rem">
        @foreach ($tech as $slug)
            @php $skill = $skillMap[$slug] ?? null; @endphp
            @if ($skill)
                <a href="{{ route('projects', ['tech' => $slug]) }}" class="chip">{{ $skill['name'] }}</a>
            @else
                <span class="chip">{{ $slug }}</span>
            @endif
        @endforeach
    </div>
    <a href="{{ route('projects.show', $project['slug']) }}" class="btn btn--primary" style="min-height:40px;padding:.45rem 1rem;font-size:.88rem">View project</a>
</article>
