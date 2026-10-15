@php
    $skillMap = $skillMap ?? [];
    $tech = $project['tech'] ?? [];
@endphp

<article
    class="project-card"
    data-type="{{ $project['type'] ?? '' }}"
    data-tech="{{ implode(',', $tech) }}"
>
    <div class="project-card__thumb" aria-hidden="true">
        {{ $project['tag'] ?? strtoupper($project['type'] ?? 'PROJECT') }}
    </div>
    <div class="project-card__body">
        <div class="flex flex-wrap items-center gap-2 mb-2">
            <span class="chip">{{ $project['type'] ?? 'project' }}</span>
            @if (! empty($project['period']))
                <span class="text-[11px]" style="color: var(--neon-cyan);">{{ $project['period'] }}</span>
            @endif
        </div>
        <h3 class="project-card__title">
            <a href="{{ route('projects.show', $project['slug']) }}" style="color: inherit; text-decoration: none;">
                {{ $project['name'] }}
            </a>
        </h3>
        <p class="project-card__desc">{{ $project['summary'] ?? $project['desc'] }}</p>
        <div class="flex flex-wrap gap-1.5">
            @foreach ($tech as $slug)
                @php $skill = $skillMap[$slug] ?? null; @endphp
                @if ($skill)
                    <a href="{{ route('projects', ['tech' => $slug]) }}" class="chip">{{ $skill['name'] }}</a>
                @else
                    <span class="chip">{{ $slug }}</span>
                @endif
            @endforeach
        </div>
        <div class="project-card__links">
            <a href="{{ route('projects.show', $project['slug']) }}" class="project-card__link">
                View Project <x-icon name="arrow-up-right" :size="12" class="inline" />
            </a>
            @if (! empty($project['repo_url']))
                <a href="{{ $project['repo_url'] }}" class="project-card__link" target="_blank" rel="noopener noreferrer">
                    Source <x-icon name="github" :size="12" class="inline" />
                </a>
            @endif
        </div>
    </div>
</article>
