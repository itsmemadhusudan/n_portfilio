<section id="works" class="section section--light" aria-labelledby="works-title">
    <div class="container">
        <div class="works-head reveal">
            <p class="eyebrow">Portfolio</p>
            <h2 id="works-title" class="section-title">My Success Work</h2>
        </div>
        <div class="works-grid">
            @foreach (array_slice($featuredProjects ?? $portfolio['projects'], 0, 6) as $i => $project)
                <a
                    href="{{ route('projects.show', $project['slug']) }}"
                    class="work-card reveal-scale"
                    style="--reveal-delay: {{ min($i, 5) * 60 }}ms"
                >
                    @if (! empty($project['image']))
                        <img
                            class="work-card__media"
                            src="{{ asset(ltrim($project['image'], '/')) }}"
                            alt="{{ $project['name'] }} project preview"
                            width="640"
                            height="480"
                            loading="lazy"
                            decoding="async"
                        >
                    @else
                        <div class="work-card__fallback" aria-hidden="true">{{ $project['name'] }}</div>
                    @endif
                    <span class="work-card__overlay">
                        <span class="work-card__title">{{ $project['name'] }}</span>
                        <span class="work-card__meta">{{ $project['tag'] ?? 'Project' }} · View</span>
                    </span>
                </a>
            @endforeach
        </div>
        <div class="reveal" style="margin-top: 2rem; text-align: center">
            <a href="{{ route('projects') }}" class="btn btn--primary">View all projects</a>
        </div>
    </div>
</section>
