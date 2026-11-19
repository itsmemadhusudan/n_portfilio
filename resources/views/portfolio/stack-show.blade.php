@extends('layouts.app')

@section('content')
    <x-page-header
        :eyebrow="$guide['eyebrow'] ?? 'Technology'"
        :title="$seo['h1']"
        :subtitle="$guide['subtitle'] ?? ('Projects and notes tagged with '.$skill['name'].($skill['proficiency'] === 'learning' ? ' (currently learning)' : '').'.')"
    />

    <section class="page-body stack-guide">
        <div class="container">
            <div class="chip-row" style="margin-bottom:1.25rem">
                <x-skill-badge
                    :name="$skill['name']"
                    :slug="$skill['slug']"
                    :proficiency="$skill['proficiency'] ?? 'proficient'"
                />
                <span class="muted">
                    Proficiency: <strong style="color:var(--text-dark)">{{ ucfirst($skill['proficiency'] ?? 'proficient') }}</strong>
                    · {{ $portfolio['skill_categories'][$skill['category']] ?? $skill['category'] }}
                </span>
            </div>

            @if (! empty($guide))
                <article class="ui-card" style="margin-bottom:1.5rem">
                    @if (! empty($guide['intro']))
                        <p class="muted" style="font-size:1.05rem">{{ $guide['intro'] }}</p>
                    @endif

                    @foreach ($guide['sections'] ?? [] as $section)
                        <section>
                            <h2>{{ $section['heading'] }}</h2>
                            @foreach ($section['body'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                            @if (! empty($section['bullets']))
                                <ul>
                                    @foreach ($section['bullets'] as $bullet)
                                        <li>{{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (! empty($section['frameworks']))
                                <div class="card-grid" style="margin-top:1rem">
                                    @foreach ($section['frameworks'] as $framework)
                                        <div class="ui-card">
                                            <h3>
                                                @if (! empty($framework['slug']))
                                                    <a href="{{ route('stack.show', $framework['slug']) }}">{{ $framework['name'] }}</a>
                                                @else
                                                    {{ $framework['name'] }}
                                                @endif
                                            </h3>
                                            @if (! empty($framework['level']))
                                                <p class="eyebrow">{{ $framework['level'] }}</p>
                                            @endif
                                            <p>{{ $framework['desc'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </section>
                    @endforeach
                </article>

                @if (! empty($relatedSkills))
                    <div style="margin-bottom:1.5rem">
                        <h2 class="section-title" style="font-size:1.2rem">Related stack</h2>
                        <div class="chip-row" style="margin-top:.75rem">
                            @foreach ($relatedSkills as $related)
                                <x-skill-badge
                                    :name="$related['name']"
                                    :slug="$related['slug']"
                                    :proficiency="$related['proficiency'] ?? 'proficient'"
                                />
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (! empty($guide['faqs']))
                    <div style="margin-bottom:2rem">
                        <h2 class="section-title" style="font-size:1.2rem">{{ $skill['name'] }} FAQ</h2>
                        <div class="card-grid" style="margin-top:1rem">
                            @foreach ($guide['faqs'] as $faq)
                                <details class="ui-card">
                                    <summary style="cursor:pointer;font-weight:700">{{ $faq['question'] }}</summary>
                                    <p style="margin-top:.75rem">{{ $faq['answer'] }}</p>
                                </details>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <h2 class="section-title" style="font-size:1.2rem">{{ $skill['name'] }} projects</h2>
            <p class="muted" style="margin:.5rem 0 1rem">Real work tagged with {{ $skill['name'] }} from this portfolio.</p>

            @if (count($projects))
                <div class="card-grid card-grid--3">
                    @foreach ($projects as $project)
                        @include('portfolio.partials.project-card', ['project' => $project, 'skillMap' => $skillMap])
                    @endforeach
                </div>
            @else
                <div class="ui-card">
                    <p>No public projects tagged with {{ $skill['name'] }} yet — the guide above still covers how I approach this technology.</p>
                </div>
            @endif

            <div class="about-actions" style="margin-top:1.75rem">
                <x-button :href="route('contact')" variant="primary">{{ $guide['cta_label'] ?? ('Hire a '.$skill['name'].' developer') }}</x-button>
                <x-button :href="route('projects', ['tech' => $skill['slug']])" variant="ghost">Filter all projects</x-button>
                <x-button :href="route('skills')" variant="ghost">Back to skills</x-button>
            </div>
        </div>
    </section>
@endsection
