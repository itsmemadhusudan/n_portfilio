@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Technical skills"
        :title="$seo['h1']"
        subtitle="Languages, frameworks, databases, APIs and tools from production work at Smart Sarks, academic projects and freelance delivery."
    />

    <section class="page-wrap pb-10">
        <x-section-title
            title="PHP, Laravel, React, Vue.js and Node.js developer skills"
            subtitle="Tap a skill to open related projects. Learning badges mark technologies I am actively building with."
        />
        @include('portfolio.partials.skills-tabs', [
            'skillsByCategory' => $skillsByCategory,
            'skillCategories' => $skillCategories,
        ])
    </section>

    <section class="page-wrap pb-10">
        <x-section-title title="Soft skills" />
        <div class="grid sm:grid-cols-2 gap-3 mb-10">
            @foreach ($portfolio['soft_skills'] as $skill)
                <x-card padding="px-4 py-3">
                    <div class="text-sm flex gap-2" style="color: var(--text-secondary);">
                        <span class="mt-1.5 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--neon-violet);"></span>
                        <span>{{ $skill }}</span>
                    </div>
                </x-card>
            @endforeach
        </div>

        <x-section-title
            title="Custom web development services"
            subtitle="Freelance web developer support for startups, student products and teams that need backend development, frontend development or API integration."
        />
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-10">
            @foreach ($portfolio['services'] as $service)
                <x-card padding="p-3.5">
                    <h3 class="font-medium mb-1 text-[13px] font-display" style="color: var(--text-primary);">{{ $service['title'] }}</h3>
                    <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $service['desc'] }}</p>
                </x-card>
            @endforeach
        </div>

        <x-section-title title="How I approach work" />
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3 pb-6">
            @foreach ($portfolio['process'] as $step)
                <x-card padding="p-3.5">
                    <p class="text-xs mb-2 font-display" style="color: var(--neon-cyan);">{{ $step['step'] }}</p>
                    <h3 class="font-medium mb-1 text-[13px] font-display" style="color: var(--text-primary);">{{ $step['title'] }}</h3>
                    <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $step['desc'] }}</p>
                </x-card>
            @endforeach
        </div>
    </section>
@endsection
