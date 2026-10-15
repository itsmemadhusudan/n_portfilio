@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Case study"
        :title="$project['name']"
        :subtitle="$project['summary'] ?? $project['desc']"
    />

    <section class="page-wrap pb-10">
        <div class="flex flex-wrap gap-2 mb-6">
            <span class="chip">{{ $project['type'] ?? 'project' }}</span>
            @if (! empty($project['period']))
                <span class="chip">{{ $project['period'] }}</span>
            @endif
        </div>

        <div class="grid lg:grid-cols-3 gap-4 mb-8">
            <x-card padding="p-5">
                <p class="section-label">Problem</p>
                <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">{{ $project['problem'] ?? '—' }}</p>
            </x-card>
            <x-card padding="p-5">
                <p class="section-label">Solution</p>
                <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">{{ $project['solution'] ?? '—' }}</p>
            </x-card>
            <x-card padding="p-5">
                <p class="section-label">Result</p>
                <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">{{ $project['result'] ?? '—' }}</p>
            </x-card>
        </div>

        <x-card padding="p-6 mb-8">
            <p class="text-[15px] leading-relaxed" style="color: var(--text-secondary);">
                {{ $project['long_desc'] ?? $project['desc'] }}
            </p>
            @if (! empty($project['highlights']))
                <ul class="mt-4 space-y-2">
                    @foreach ($project['highlights'] as $highlight)
                        <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                            <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--neon-cyan);"></span>
                            <span>{{ $highlight }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-card>

        <h2 class="section-title text-xl mb-4">Tech stack</h2>
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach ($project['tech'] ?? [] as $slug)
                @php $skill = $skillMap[$slug] ?? null; @endphp
                @if ($skill)
                    <x-skill-badge
                        :name="$skill['name']"
                        :slug="$skill['slug']"
                        :proficiency="$skill['proficiency'] ?? 'proficient'"
                        :icon="$skill['icon'] ?? 'code'"
                        :href="route('projects', ['tech' => $skill['slug']])"
                    />
                @endif
            @endforeach
        </div>

        <div class="flex flex-wrap gap-3">
            <x-button :href="route('projects')" variant="ghost">All projects</x-button>
            @if (! empty($project['live_url']))
                <x-button :href="$project['live_url']" variant="solid" :external="true">Live site</x-button>
            @endif
            @if (! empty($project['repo_url']))
                <x-button :href="$project['repo_url']" variant="ghost" :external="true">Source</x-button>
            @endif
        </div>
    </section>
@endsection
