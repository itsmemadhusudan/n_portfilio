@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Background"
        :title="$seo['h1']"
        subtitle="BCIS at Apex College, leadership through the SMART Program, and continuous learning that supports professional backend development."
        accent="var(--yellow)"
    />

    @include('portfolio.partials.education', ['standalone' => true])

    <section class="page-wrap pb-10">
        <h2 class="text-2xl font-display mb-3" style="font-weight: 600; color: var(--text-primary);">Beyond the classroom</h2>
        <p class="text-sm leading-relaxed mb-6 max-w-3xl" style="color: var(--text-secondary);">
            Formal study is only part of the picture. Mentoring, organizing workshops and representing classmates taught me communication and ownership — the same habits I bring into freelance projects and team development work.
        </p>

        <div class="grid sm:grid-cols-3 gap-3 mb-10">
            <x-anim-card padding="p-3.5">
                <p class="text-3xl font-display mb-2" style="font-weight: 700; color: var(--text-accent);">42</p>
                <p class="text-sm" style="color: var(--text-secondary);">Students represented as class representative</p>
            </x-anim-card>
            <x-anim-card padding="p-3.5">
                <p class="text-3xl font-display mb-2" style="font-weight: 700; color: var(--blue);">2×</p>
                <p class="text-sm" style="color: var(--text-secondary);">Best Team recognition while mentoring SMART</p>
            </x-anim-card>
            <x-anim-card padding="p-3.5">
                <p class="text-3xl font-display mb-2" style="font-weight: 700; color: var(--yellow);">{{ count($portfolio['projects']) }}+</p>
                <p class="text-sm" style="color: var(--text-secondary);">Shipped college and personal development projects</p>
            </x-anim-card>
        </div>

        <x-anim-card padding="p-6 sm:p-8">
            <h3 class="text-lg font-display mb-3" style="font-weight: 600; color: var(--text-primary);">Continuous learning</h3>
            <p class="text-sm leading-relaxed mb-4" style="color: var(--text-secondary);">
                I keep strengthening web development and database fundamentals through self-study, then prove them in projects — Laravel apps, Flutter clients, React interfaces and Node/Python backend experiments.
            </p>
            <div class="flex flex-wrap gap-2">
                @foreach (['Laravel', 'Flutter', 'React', 'Node.js', 'Python', 'Database Design', 'Design Thinking'] as $topic)
                    <span class="chip">{{ $topic }}</span>
                @endforeach
            </div>
        </x-anim-card>
    </section>
@endsection
