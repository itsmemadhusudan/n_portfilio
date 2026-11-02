@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="{{ $guide['eyebrow'] ?? 'Technology' }}"
        :title="$seo['h1']"
        :subtitle="$guide['subtitle'] ?? ('Projects and notes tagged with '.$skill['name'].($skill['proficiency'] === 'learning' ? ' (currently learning)' : '').'.')"
    />

    <section class="page-wrap pb-10 stack-guide">
        <div class="mb-6 flex flex-wrap items-center gap-3">
            <x-skill-badge
                :name="$skill['name']"
                :slug="$skill['slug']"
                :proficiency="$skill['proficiency'] ?? 'proficient'"
                :icon="$skill['icon'] ?? 'code'"
            />
            <p class="text-sm" style="color: var(--text-secondary);">
                Proficiency: <strong style="color: var(--text-primary);">{{ ucfirst($skill['proficiency'] ?? 'proficient') }}</strong>
                · Category: {{ $portfolio['skill_categories'][$skill['category']] ?? $skill['category'] }}
            </p>
        </div>

        @if (! empty($guide))
            <article class="stack-guide__article neon-card mb-8">
                <div class="neon-card__inner p-6 sm:p-8">
                    @if (! empty($guide['intro']))
                        <p class="stack-guide__lead">{{ $guide['intro'] }}</p>
                    @endif

                    @foreach ($guide['sections'] ?? [] as $section)
                        <section class="stack-guide__section">
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
                                <div class="stack-guide__frameworks">
                                    @foreach ($section['frameworks'] as $framework)
                                        <div class="stack-guide__framework">
                                            <div class="stack-guide__framework-top">
                                                @if (! empty($framework['slug']))
                                                    <a href="{{ route('stack.show', $framework['slug']) }}" class="stack-guide__framework-name">
                                                        {{ $framework['name'] }}
                                                    </a>
                                                @else
                                                    <span class="stack-guide__framework-name">{{ $framework['name'] }}</span>
                                                @endif
                                                @if (! empty($framework['level']))
                                                    <span class="stack-guide__framework-level">{{ $framework['level'] }}</span>
                                                @endif
                                            </div>
                                            <p>{{ $framework['desc'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </section>
                    @endforeach
                </div>
            </article>

            @if (! empty($relatedSkills))
                <div class="mb-8">
                    <h2 class="section-label mb-3">Related stack</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($relatedSkills as $related)
                            <x-skill-badge
                                :name="$related['name']"
                                :slug="$related['slug']"
                                :proficiency="$related['proficiency'] ?? 'proficient'"
                                :icon="$related['icon'] ?? 'code'"
                                :href="route('stack.show', $related['slug'])"
                            />
                        @endforeach
                    </div>
                </div>
            @endif

            @if (! empty($guide['faqs']))
                <div class="mb-10">
                    <h2 class="section-label mb-4">{{ $skill['name'] }} FAQ</h2>
                    <div class="stack-guide__faqs">
                        @foreach ($guide['faqs'] as $faq)
                            <details class="stack-guide__faq neon-card">
                                <summary>{{ $faq['question'] }}</summary>
                                <p>{{ $faq['answer'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <div class="mb-4">
            <h2 class="section-label mb-2">{{ $skill['name'] }} projects</h2>
            <p class="text-sm mb-4" style="color: var(--text-secondary);">
                Real work tagged with {{ $skill['name'] }} from this portfolio.
            </p>
        </div>

        @if (count($projects))
            <div class="project-grid">
                @foreach ($projects as $project)
                    @include('portfolio.partials.project-card', ['project' => $project, 'skillMap' => $skillMap])
                @endforeach
            </div>
        @else
            <x-card padding="p-6">
                <p class="text-sm" style="color: var(--text-secondary);">
                    No public projects tagged with {{ $skill['name'] }} yet — the guide above still covers how I approach this technology.
                </p>
            </x-card>
        @endif

        <div class="mt-8 flex flex-wrap gap-3">
            <x-button :href="route('contact')" variant="solid">{{ $guide['cta_label'] ?? ('Hire a '.$skill['name'].' developer') }}</x-button>
            <x-button :href="route('projects', ['tech' => $skill['slug']])" variant="ghost">Filter all projects</x-button>
            <x-button :href="route('skills')" variant="ghost">Back to skills</x-button>
        </div>
    </section>
@endsection
