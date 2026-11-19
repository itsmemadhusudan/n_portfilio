@extends('layouts.app')

@section('content')
    <x-page-header
        eyebrow="Background"
        :title="$seo['h1']"
        subtitle="BCIS at Apex College, leadership through the SMART Program, and continuous learning."
    />

    <section class="page-body">
        <div class="container">
            <div class="card-grid" style="margin-bottom:2rem">
                @foreach ($portfolio['education'] as $item)
                    <article class="ui-card reveal">
                        <p class="eyebrow">{{ $item['period'] }}</p>
                        <h2 class="section-title" style="font-size:1.25rem">{{ $item['degree'] }}</h2>
                        <p style="color:var(--primary);margin:.25rem 0 .75rem">{{ $item['school'] }}</p>
                        <p class="muted">{{ $item['details'] }}</p>
                        @if (! empty($item['points']))
                            <ul style="margin:1rem 0 0;padding-left:1.1rem;color:var(--text-muted)">
                                @foreach ($item['points'] as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </article>
                @endforeach
            </div>

            <h2 class="section-title" style="font-size:1.35rem;margin-bottom:1rem">Achievements</h2>
            <div class="card-grid card-grid--3">
                @foreach ($portfolio['achievements'] as $item)
                    <article class="ui-card reveal">
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
