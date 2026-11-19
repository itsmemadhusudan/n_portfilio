@extends('layouts.app')

@section('content')
    <x-page-header
        eyebrow="Selected work"
        :title="$seo['h1']"
        subtitle="Developer portfolio case studies across APIs, databases, Laravel apps and modern UI."
    />

    <section class="page-body" x-data="projectFilters(@js($projects))" x-init="init()" data-project-filters>
        <div class="container">
            <div class="filter-bar">
                <div>
                    <p class="eyebrow">Filter by type</p>
                    <div class="chip-row">
                        <template x-for="opt in typeOptions" :key="opt.value">
                            <button type="button" class="chip" :class="type === opt.value && 'is-active'" @click="setType(opt.value)" x-text="opt.label"></button>
                        </template>
                    </div>
                </div>
                <div>
                    <p class="eyebrow">Filter by technology</p>
                    <div class="chip-row">
                        @foreach ($skills as $skill)
                            <button
                                type="button"
                                class="chip"
                                :class="tech.includes('{{ $skill['slug'] }}') && 'is-active'"
                                @click="toggleTech('{{ $skill['slug'] }}')"
                            >{{ $skill['name'] }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-grid card-grid--3">
                @foreach ($projects as $project)
                    <div x-show="matches(@js($project['type'] ?? ''), @js($project['tech'] ?? []))">
                        @include('portfolio.partials.project-card', ['project' => $project, 'skillMap' => $skillMap])
                    </div>
                @endforeach
            </div>
            <p class="muted" style="margin-top:1.25rem" x-show="visibleCount === 0" x-cloak>No projects match these filters.</p>
        </div>
    </section>
@endsection
