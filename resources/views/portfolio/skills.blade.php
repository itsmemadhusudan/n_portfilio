@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Technical skills"
        title="Tools and capabilities"
        subtitle="A practical mix of frontend, backend, database and collaboration skills from coursework, college projects and freelance work."
        accent="var(--coral)"
    />

    @include('portfolio.partials.stack', ['standalone' => true])

    <section class="max-w-7xl mx-auto px-6 pb-10">
        <h2 class="text-2xl font-display mb-6" style="font-weight: 700; color: #F8FAFC;">Languages & frameworks</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
            @foreach ($portfolio['languages'] as $lang)
                <x-anim-card padding="p-5">
                    <h3 class="font-semibold mb-1" style="color: #F8FAFC;">{{ $lang['name'] }}</h3>
                    <p class="text-xs font-mono mb-2" style="color: var(--coral);">{{ $lang['level'] }}</p>
                    <p class="text-sm" style="color: #94A3B8;">{{ $lang['note'] }}</p>
                </x-anim-card>
            @endforeach
        </div>

        <h2 class="text-2xl font-display mb-6" style="font-weight: 700; color: #F8FAFC;">Soft skills</h2>
        <div class="grid sm:grid-cols-2 gap-3 mb-12">
            @foreach ($portfolio['soft_skills'] as $skill)
                <x-anim-card padding="px-4 py-3">
                    <div class="text-sm flex gap-2" style="color: #CBD5E1;">
                        <span class="mt-1.5 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--yellow);"></span>
                        <span>{{ $skill }}</span>
                    </div>
                </x-anim-card>
            @endforeach
        </div>

        <h2 class="text-2xl font-display mb-3" style="font-weight: 700; color: #F8FAFC;">Services I can help with</h2>
        <p class="text-sm mb-6 max-w-2xl" style="color: #94A3B8;">Useful for freelance clients, student startups and teams that need an extra pair of hands on web or mobile work.</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
            @foreach ($portfolio['services'] as $service)
                <x-anim-card padding="p-5">
                    <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $service['title'] }}</h3>
                    <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $service['desc'] }}</p>
                </x-anim-card>
            @endforeach
        </div>

        <h2 class="text-2xl font-display mb-6" style="font-weight: 700; color: #F8FAFC;">How I approach work</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 pb-10">
            @foreach ($portfolio['process'] as $step)
                <x-anim-card padding="p-5">
                    <p class="text-xs font-mono mb-3" style="color: var(--coral);">{{ $step['step'] }}</p>
                    <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $step['title'] }}</h3>
                    <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $step['desc'] }}</p>
                </x-anim-card>
            @endforeach
        </div>
    </section>
@endsection
