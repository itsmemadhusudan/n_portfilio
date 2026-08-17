@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Technical skills"
        :title="$seo['h1']"
        subtitle="Laravel, Node.js, Python, REST APIs, database design and collaboration skills from production work at Smartsarka, academic projects and freelance backend delivery."
        accent="var(--text-accent)"
    />

    @include('portfolio.partials.stack', ['standalone' => true])

    <section class="page-wrap pb-10">
        <h2 class="text-2xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Languages & frameworks</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-10">
            @foreach ($portfolio['languages'] as $lang)
                <x-anim-card padding="p-3.5">
                    <h3 class="font-medium mb-1 text-[13px]" style="color: var(--text-primary);">{{ $lang['name'] }}</h3>
                    <p class="text-xs mb-2" style="color: var(--text-accent);">{{ $lang['level'] }}</p>
                    <p class="text-xs" style="color: var(--text-secondary);">{{ $lang['note'] }}</p>
                </x-anim-card>
            @endforeach
        </div>

        <h2 class="text-2xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Soft skills</h2>
        <div class="grid sm:grid-cols-2 gap-3 mb-10">
            @foreach ($portfolio['soft_skills'] as $skill)
                <x-anim-card padding="px-4 py-3">
                    <div class="text-sm flex gap-2" style="color: var(--text-secondary);">
                        <span class="mt-1.5 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--yellow);"></span>
                        <span>{{ $skill }}</span>
                    </div>
                </x-anim-card>
            @endforeach
        </div>

        <h2 class="text-2xl font-display mb-3" style="font-weight: 600; color: var(--text-primary);">Services I can help with</h2>
        <p class="text-sm mb-6 max-w-2xl" style="color: var(--text-secondary);">Useful for freelance clients, student startups and teams that need an extra pair of hands on web or mobile work.</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-10">
            @foreach ($portfolio['services'] as $service)
                <x-anim-card padding="p-3.5">
                    <h3 class="font-medium mb-1 text-[13px]" style="color: var(--text-primary);">{{ $service['title'] }}</h3>
                    <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $service['desc'] }}</p>
                </x-anim-card>
            @endforeach
        </div>

        <h2 class="text-2xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">How I approach work</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3 pb-6">
            @foreach ($portfolio['process'] as $step)
                <x-anim-card padding="p-3.5">
                    <p class="text-xs mb-2" style="color: var(--text-accent);">{{ $step['step'] }}</p>
                    <h3 class="font-medium mb-1 text-[13px]" style="color: var(--text-primary);">{{ $step['title'] }}</h3>
                    <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $step['desc'] }}</p>
                </x-anim-card>
            @endforeach
        </div>
    </section>
@endsection
