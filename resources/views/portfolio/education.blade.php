@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Background"
        title="Education & highlights"
        subtitle="Academic path at Apex College and Advance Academy, plus leadership through SMART Program mentoring, judging and campus tech events."
        accent="var(--yellow)"
    />

    @include('portfolio.partials.education', ['standalone' => true])

    <section class="max-w-7xl mx-auto px-6 pb-16">
        <h2 class="text-2xl font-display mb-3" style="font-weight: 700; color: #F8FAFC;">Beyond the classroom</h2>
        <p class="text-sm leading-relaxed mb-6 max-w-3xl" style="color: #94A3B8;">
            Formal study is only part of the picture. Mentoring, organizing workshops and representing classmates taught me communication and ownership — the same habits I bring into freelance projects and team development work.
        </p>

        <div class="grid sm:grid-cols-3 gap-4 mb-10">
            <x-anim-card padding="p-5">
                <p class="text-3xl font-display mb-2" style="font-weight: 700; color: var(--coral);">42</p>
                <p class="text-sm" style="color: #94A3B8;">Students represented as class representative</p>
            </x-anim-card>
            <x-anim-card padding="p-5">
                <p class="text-3xl font-display mb-2" style="font-weight: 700; color: var(--blue);">2×</p>
                <p class="text-sm" style="color: #94A3B8;">Best Team recognition while mentoring SMART</p>
            </x-anim-card>
            <x-anim-card padding="p-5">
                <p class="text-3xl font-display mb-2" style="font-weight: 700; color: var(--yellow);">{{ count($portfolio['projects']) }}+</p>
                <p class="text-sm" style="color: #94A3B8;">Shipped college and personal development projects</p>
            </x-anim-card>
        </div>

        <x-anim-card padding="p-6 sm:p-8">
            <h3 class="text-lg font-display mb-3" style="font-weight: 600; color: #F8FAFC;">Continuous learning</h3>
            <p class="text-sm leading-relaxed mb-4" style="color: #94A3B8;">
                I keep strengthening web development and database fundamentals through self-study, then prove them in projects — Laravel apps, Flutter clients, React interfaces and Node/Python backend experiments.
            </p>
            <div class="flex flex-wrap gap-2">
                @foreach (['Laravel', 'Flutter', 'React', 'Node.js', 'Python', 'Database Design', 'Design Thinking'] as $topic)
                    <span class="text-xs px-2.5 py-1 rounded-md font-mono" style="background: var(--soft); color: #CBD5E1;">{{ $topic }}</span>
                @endforeach
            </div>
        </x-anim-card>
    </section>
@endsection
