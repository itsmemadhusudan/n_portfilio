@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Selected work"
        :title="$seo['h1']"
        subtitle="Developer portfolio case studies across APIs, databases, Laravel apps, e-commerce development and modern UI."
    />

    <section
        class="page-wrap pb-10"
        x-data="projectFilters(@js($projects))"
        x-init="init()"
        data-project-filters
    >
        <div class="project-filters mb-6">
            <p class="section-label mb-3">Filter by type</p>
            <div class="flex flex-wrap gap-2 mb-5">
                <template x-for="opt in typeOptions" :key="opt.value">
                    <button
                        type="button"
                        class="skills-tabs__btn"
                        :class="type === opt.value && 'is-active'"
                        @click="setType(opt.value)"
                        x-text="opt.label"
                    ></button>
                </template>
            </div>

            <p class="section-label mb-3">Filter by technology</p>
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach ($skills as $skill)
                    <button
                        type="button"
                        class="chip"
                        data-tech-toggle="{{ $skill['slug'] }}"
                        :class="tech.includes('{{ $skill['slug'] }}') && 'is-active-chip'"
                        @click="toggleTech('{{ $skill['slug'] }}')"
                    >
                        {{ $skill['name'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="project-grid">
            @foreach ($projects as $project)
                <div
                    class="project-filter-item"
                    x-show="matches(@js($project['type'] ?? ''), @js($project['tech'] ?? []))"
                >
                    @include('portfolio.partials.project-card', ['project' => $project, 'skillMap' => $skillMap])
                </div>
            @endforeach
        </div>

        <p class="text-sm mt-6" style="color: var(--text-secondary);" x-show="visibleCount === 0" x-cloak>
            No projects match these filters.
        </p>
    </section>
@endsection
