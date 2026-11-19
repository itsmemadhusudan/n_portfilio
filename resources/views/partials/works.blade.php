<section id="works" class="section section--light" aria-labelledby="works-title">
    <div class="container">
        <div class="works-head reveal">
            <p class="eyebrow">Portfolio</p>
            <h2 id="works-title" class="section-title">My Success Work</h2>
        </div>
        <div class="works-grid">
            @foreach (array_slice($featuredProjects ?? $portfolio['projects'], 0, 6) as $i => $project)
                @php
                    $stack = array_slice($project['stack'] ?? [], 0, 3);
                    $initials = collect(preg_split('/\s+/', $project['name'] ?? 'P'))
                        ->filter()
                        ->take(2)
                        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
                        ->implode('');
                @endphp
                <a
                    href="{{ route('projects.show', $project['slug']) }}"
                    class="work-card reveal-scale"
                    style="--reveal-delay: {{ min($i, 5) * 60 }}ms"
                >
                    <div class="work-card__media-wrap">
                        @if (! empty($project['image']))
                            <img
                                class="work-card__media"
                                src="{{ asset(ltrim($project['image'], '/')) }}"
                                alt="{{ $project['name'] }} project preview"
                                width="640"
                                height="360"
                                loading="lazy"
                                decoding="async"
                            >
                        @else
                            <div class="work-card__fallback" aria-hidden="true">
                                <span class="work-card__mark">{{ $initials }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="work-card__body">
                        <span class="work-card__tag">{{ $project['tag'] ?? 'Project' }}</span>
                        <span class="work-card__title">{{ $project['name'] }}</span>
                        @if ($stack)
                            <span class="work-card__stack">{{ implode(' · ', $stack) }}</span>
                        @endif
                        <span class="work-card__cta">View project</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="reveal" style="margin-top: 1.75rem; text-align: center">
            <a href="{{ route('projects') }}" class="btn btn--primary">View all projects</a>
        </div>
    </div>
</section>
