@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Selected work"
        :title="$seo['h1']"
        subtitle="College products, production-minded builds and freelance-ready capabilities across Laravel backends, APIs, Flutter apps and databases."
        accent="var(--blue)"
    />

    <section class="page-wrap pb-6">
        <x-anim-card padding="p-6" class="mb-8">
            <h2 class="text-lg font-display mb-2" style="font-weight: 600; color: var(--text-primary);">Project overview</h2>
            <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">
                These builds cover marketplace flows, e-commerce with Laravel, mobile apps for real lifestyle problems and personal productivity tools.
                Together they show how I move between frontend, backend and database work — and how I apply the same approach to freelance client projects.
            </p>
        </x-anim-card>
    </section>

    @include('portfolio.partials.projects', ['standalone' => true])

    <section class="page-wrap pb-10">
        <h2 class="text-2xl font-display mb-3" style="font-weight: 600; color: var(--text-primary);">Freelance capabilities</h2>
        <p class="text-sm leading-relaxed mb-6 max-w-3xl" style="color: var(--text-secondary);">{{ $portfolio['freelance']['intro'] }}</p>
        <div class="grid sm:grid-cols-2 gap-3 mb-10">
            @foreach ($portfolio['freelance']['offers'] as $offer)
                <x-anim-card padding="px-4 py-3">
                    <div class="text-sm flex gap-2" style="color: var(--text-secondary);">
                        <span class="mt-1.5 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--mint);"></span>
                        <span>{{ $offer }}</span>
                    </div>
                </x-anim-card>
            @endforeach
        </div>

        <x-anim-card padding="p-8">
            <h3 class="text-xl font-display mb-2" style="font-weight: 600; color: var(--text-primary);">Want something similar built?</h3>
            <p class="text-sm mb-5 max-w-xl" style="color: var(--text-secondary);">Tell me about your website, Laravel app, or Flutter idea — I can help scope it and start building.</p>
            <x-anim-btn :href="route('contact')" variant="solid">Start a conversation</x-anim-btn>
        </x-anim-card>
    </section>
@endsection
