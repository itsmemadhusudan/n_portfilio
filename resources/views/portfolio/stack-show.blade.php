@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Technology"
        :title="$seo['h1']"
        :subtitle="'Projects tagged with '.$skill['name'].($skill['proficiency'] === 'learning' ? ' (currently learning)' : '').' from this developer portfolio.'"
    />

    <section class="page-wrap pb-10">
        <div class="mb-6">
            <x-skill-badge
                :name="$skill['name']"
                :slug="$skill['slug']"
                :proficiency="$skill['proficiency'] ?? 'proficient'"
                :icon="$skill['icon'] ?? 'code'"
            />
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
                    No public projects tagged with {{ $skill['name'] }} yet.
                </p>
            </x-card>
        @endif

        <div class="mt-8">
            <x-button :href="route('projects', ['tech' => $skill['slug']])" variant="ghost">Filter all projects</x-button>
            <x-button :href="route('skills')" variant="ghost">Back to skills</x-button>
        </div>
    </section>
@endsection
