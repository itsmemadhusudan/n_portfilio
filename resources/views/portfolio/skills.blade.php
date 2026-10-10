@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Technical skills"
        :title="$seo['h1']"
        subtitle="Laravel, Node.js, Python, REST APIs, database design and collaboration skills from production work at Smart Sarks, academic projects and freelance backend delivery."
    />

    @include('portfolio.partials.stack', ['standalone' => true])

    <section class="page-wrap pb-10">
        <x-section-title title="Languages & frameworks" />
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-10">
            @foreach ($portfolio['languages'] as $lang)
                @php
                    $levelMap = [
                        'Strong project experience' => 90,
                        'Applied on projects' => 72,
                        'Working knowledge' => 58,
                        'Project exposure' => 48,
                    ];
                    $pct = $levelMap[$lang['level']] ?? 65;
                @endphp
                <x-card padding="p-3.5">
                    <h3 class="font-medium mb-1 text-[13px] font-display" style="color: var(--text-primary);">{{ $lang['name'] }}</h3>
                    <p class="text-xs mb-2" style="color: var(--neon-cyan);">{{ $lang['level'] }}</p>
                    <p class="text-xs mb-3" style="color: var(--text-secondary);">{{ $lang['note'] }}</p>
                    <div class="skill-progress" aria-hidden="true">
                        <div class="skill-progress__bar">
                            <div class="skill-progress__fill" style="--level: {{ $pct }}%;"></div>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>

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
            title="Services I can help with"
            subtitle="Useful for freelance clients, student startups and teams that need an extra pair of hands on web or mobile work."
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
