@php
    $standalone = $standalone ?? false;
    $limit = $limit ?? null;
    $projects = $limit ? array_slice($portfolio['projects'], 0, $limit) : $portfolio['projects'];
@endphp

<section class="page-wrap {{ $standalone ? 'pb-4' : 'py-10' }}">
    @unless ($standalone)
        <x-section-title
            eyebrow="Selected work"
            title="College projects"
        />
    @endunless

    <div class="project-grid">
        @foreach ($projects as $index => $project)
            <article
                class="project-card reveal"
                style="--reveal-delay: {{ $index * 70 }}ms"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <div class="project-card__thumb" aria-hidden="true">
                    {{ $project['tag'] }}
                </div>
                <div class="project-card__body">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        @if (! empty($project['type']))
                            <span class="text-[11px]" style="color: var(--text-secondary);">{{ $project['type'] }}</span>
                        @endif
                        @if (! empty($project['period']))
                            <span class="text-[11px]" style="color: var(--neon-cyan);">{{ $project['period'] }}</span>
                        @endif
                    </div>
                    <h3 class="project-card__title">{{ $project['name'] }}</h3>
                    <p class="project-card__desc">
                        {{ $standalone && $limit ? $project['desc'] : ($project['long_desc'] ?? $project['desc']) }}
                    </p>

                    @if (! empty($project['highlights']) && ! ($standalone && $limit))
                        <ul class="grid gap-2 mb-4">
                            @foreach (array_slice($project['highlights'], 0, 3) as $highlight)
                                <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                                    <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--neon-cyan);"></span>
                                    <span>{{ $highlight }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($project['stack'] as $tech)
                            <span class="chip">{{ $tech }}</span>
                        @endforeach
                    </div>

                    <div class="project-card__links">
                        @if (! empty($project['url']) && $project['url'] !== '#')
                            <a href="{{ $project['url'] }}" class="project-card__link" target="_blank" rel="noopener noreferrer">
                                View Project <x-icon name="external-link" :size="12" class="inline" />
                            </a>
                        @else
                            <a href="{{ route('projects') }}" class="project-card__link">
                                View Project <x-icon name="arrow-up-right" :size="12" class="inline" />
                            </a>
                        @endif
                        @if (! empty($project['source']))
                            <a href="{{ $project['source'] }}" class="project-card__link" target="_blank" rel="noopener noreferrer">
                                Source <x-icon name="github" :size="12" class="inline" />
                            </a>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
