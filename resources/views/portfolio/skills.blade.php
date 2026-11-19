@extends('layouts.app')

@section('content')
    <x-page-header
        eyebrow="Skills"
        :title="$seo['h1']"
        subtitle="Languages, frameworks and tools I use across backend, frontend and databases."
    />

    <section class="page-body">
        <div class="container">
            @foreach ($skillCategories as $key => $label)
                @php $items = $skillsByCategory[$key] ?? []; @endphp
                @if (count($items))
                    <div class="reveal" style="margin-bottom:2rem">
                        <h2 class="section-title" style="font-size:1.35rem">{{ $label }}</h2>
                        <div class="chip-row" style="margin-top:.85rem">
                            @foreach ($items as $skill)
                                <x-skill-badge
                                    :name="$skill['name']"
                                    :slug="$skill['slug']"
                                    :proficiency="$skill['proficiency'] ?? 'proficient'"
                                />
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
