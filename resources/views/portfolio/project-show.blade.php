@extends('layouts.app')

@section('content')
    <x-page-header
        eyebrow="Case study"
        :title="$project['name']"
        :subtitle="$project['summary'] ?? $project['desc']"
    />

    <section class="page-body">
        <div class="container">
            <div class="chip-row" style="margin-bottom:1.5rem">
                <span class="chip">{{ $project['type'] ?? 'project' }}</span>
                @if (! empty($project['period']))
                    <span class="chip">{{ $project['period'] }}</span>
                @endif
            </div>

            <div class="card-grid card-grid--3" style="margin-bottom:1.5rem">
                <div class="ui-card">
                    <p class="eyebrow">Problem</p>
                    <p>{{ $project['problem'] ?? '—' }}</p>
                </div>
                <div class="ui-card">
                    <p class="eyebrow">Solution</p>
                    <p>{{ $project['solution'] ?? '—' }}</p>
                </div>
                <div class="ui-card">
                    <p class="eyebrow">Result</p>
                    <p>{{ $project['result'] ?? '—' }}</p>
                </div>
            </div>

            <div class="ui-card prose-block" style="margin-bottom:1.5rem">
                <p>{{ $project['long_desc'] ?? $project['desc'] }}</p>
                @if (! empty($project['highlights']))
                    <ul>
                        @foreach ($project['highlights'] as $highlight)
                            <li>{{ $highlight }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <h2 class="section-title" style="font-size:1.35rem">Tech stack</h2>
            <div class="chip-row" style="margin: .85rem 0 1.5rem">
                @foreach ($project['tech'] ?? [] as $slug)
                    @php $skill = $skillMap[$slug] ?? null; @endphp
                    @if ($skill)
                        <x-skill-badge
                            :name="$skill['name']"
                            :slug="$skill['slug']"
                            :proficiency="$skill['proficiency'] ?? 'proficient'"
                        />
                    @endif
                @endforeach
            </div>

            <div class="about-actions">
                <x-button :href="route('projects')" variant="ghost">All projects</x-button>
                @if (! empty($project['live_url']))
                    <x-button :href="$project['live_url']" variant="primary" :external="true">Live site</x-button>
                @endif
                @if (! empty($project['repo_url']))
                    <x-button :href="$project['repo_url']" variant="ghost" :external="true">Source</x-button>
                @endif
            </div>
        </div>
    </section>
@endsection
