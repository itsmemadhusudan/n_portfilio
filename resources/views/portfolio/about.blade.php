@extends('layouts.app')

@section('content')
    <x-page-header eyebrow="About" :title="$seo['h1']" :subtitle="$portfolio['about_intro']" />

    <section class="page-body">
        <div class="container about-grid">
            <div class="prose-block reveal">
                @foreach ($portfolio['about_story'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
                <p>{{ $portfolio['bio'] }}</p>

                <h2 class="section-title" style="font-size:1.35rem;margin-top:2rem">Work history</h2>
                <div class="ui-card" style="margin-top:1rem">
                    <h3>{{ $portfolio['contact']['current_role']['role'] }}</h3>
                    <p style="color:var(--primary);margin-bottom:.5rem">
                        {{ $portfolio['contact']['current_role']['company'] }} · {{ $portfolio['contact']['current_role']['duration'] }}
                    </p>
                    <p>{{ $portfolio['contact']['current_role']['summary'] }}</p>
                </div>

                <h2 class="section-title" style="font-size:1.35rem;margin-top:2rem">Focus</h2>
                <ul class="card-grid" style="margin-top:1rem;list-style:none;padding:0">
                    @foreach ($portfolio['about_focus'] as $item)
                        <li class="ui-card"><p>{{ $item }}</p></li>
                    @endforeach
                </ul>

                <div style="margin-top:1.75rem" class="about-actions">
                    <a href="{{ route('contact') }}" class="btn btn--primary">Hire me</a>
                    <a href="{{ route('projects') }}" class="btn btn--ghost-dark">View projects</a>
                </div>
            </div>
            <div class="about-photo reveal">
                <img
                    src="{{ asset(ltrim($portfolio['about_photo'] ?? '/images/madhusudan2.png', '/')) }}"
                    alt="{{ $portfolio['full_name'] }}"
                    width="420"
                    height="560"
                    loading="lazy"
                >
            </div>
        </div>
    </section>
@endsection
