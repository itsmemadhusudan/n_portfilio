@extends('layouts.portfolio')

@section('content')
    @include('portfolio.partials.hero')

    <section class="page-wrap pb-12" style="content-visibility: auto; contain-intrinsic-size: 1px 2400px;">
        <p class="section-label">Tech stack</p>
        <div class="flex flex-wrap gap-2 mb-12">
            @foreach ($portfolio['backend_stack'] as $tech)
                <span class="chip">{{ $tech }}</span>
            @endforeach
        </div>

        <div class="mb-12">
            <p class="section-label">Focus</p>
            <h2 class="text-2xl font-display mb-3" style="font-weight: 600; color: var(--text-primary); letter-spacing: -0.03em;">What I focus on</h2>
            <p class="text-[15px] leading-relaxed max-w-3xl mb-6" style="color: var(--text-secondary);">
                {{ $portfolio['backend_intro'] }}
            </p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($portfolio['backend_highlights'] as $item)
                    <x-anim-card padding="p-5">
                        <h3 class="font-medium mb-1.5 text-sm" style="color: var(--text-primary);">{{ $item['title'] }}</h3>
                        <p class="text-[13px] leading-relaxed" style="color: var(--text-secondary);">{{ $item['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-3 mb-12">
            <x-anim-card :href="route('projects')" padding="p-5">
                <p class="section-label">Projects</p>
                <p class="font-display text-[17px]" style="font-weight: 600; color: var(--text-primary);">{{ count($portfolio['projects']) }} featured builds</p>
                <p class="text-[13px] mt-1.5 leading-relaxed" style="color: var(--text-secondary);">APIs, databases, Laravel apps and full product backends.</p>
            </x-anim-card>
            <x-anim-card :href="route('skills')" padding="p-5">
                <p class="section-label">Backend stack</p>
                <p class="font-display text-[17px]" style="font-weight: 600; color: var(--text-primary);">Laravel · Node · Python</p>
                <p class="text-[13px] mt-1.5 leading-relaxed" style="color: var(--text-secondary);">REST APIs, auth flows and database modeling.</p>
            </x-anim-card>
            <x-anim-card :href="route('education')" padding="p-5">
                <p class="section-label">Education</p>
                <p class="font-display text-[17px]" style="font-weight: 600; color: var(--text-primary);">BCIS · Apex College</p>
                <p class="text-[13px] mt-1.5 leading-relaxed" style="color: var(--text-secondary);">Leadership, mentoring and campus tech involvement.</p>
            </x-anim-card>
        </div>

        <div class="mb-12">
            <div class="flex items-end justify-between gap-4 mb-5">
                <div>
                    <p class="section-label">Services</p>
                    <h2 class="text-2xl font-display" style="font-weight: 600; color: var(--text-primary); letter-spacing: -0.03em;">Services & freelance work</h2>
                </div>
                <x-anim-btn :href="route('contact')" variant="ghost">Get in touch</x-anim-btn>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($portfolio['services'] as $service)
                    <x-anim-card padding="p-5">
                        <h3 class="font-medium mb-1.5 text-sm" style="color: var(--text-primary);">{{ $service['title'] }}</h3>
                        <p class="text-[13px] leading-relaxed" style="color: var(--text-secondary);">{{ $service['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="mb-12">
            <div class="flex items-end justify-between gap-4 mb-5">
                <div>
                    <p class="section-label">Selected work</p>
                    <h2 class="text-2xl font-display" style="font-weight: 600; color: var(--text-primary); letter-spacing: -0.03em;">Featured projects</h2>
                </div>
                <x-anim-btn :href="route('projects')" variant="ghost">View all</x-anim-btn>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach (array_slice($portfolio['projects'], 0, 3) as $project)
                    @php
                        $iconMap = ['FULL-STACK' => 'layout', 'LARAVEL' => 'server', 'MOBILE' => 'sparkles', 'FLUTTER' => 'database'];
                        $icon = $iconMap[$project['tag']] ?? 'server';
                    @endphp
                    <x-anim-card :href="route('projects')" padding="p-5">
                        <span style="color: var(--text-accent); display: inline-flex;">
                            <x-icon :name="$icon" :size="20" />
                        </span>
                        <div class="flex items-start justify-between gap-2 mb-1 mt-3">
                            <h3 class="font-medium text-sm" style="color: var(--text-primary);">{{ $project['name'] }}</h3>
                            <span class="chip">{{ $project['tag'] }}</span>
                        </div>
                        <p class="text-[13px] leading-relaxed" style="color: var(--text-secondary);">{{ $project['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="mb-12">
            <p class="section-label">Career</p>
            <h2 class="text-2xl font-display mb-5" style="font-weight: 600; color: var(--text-primary); letter-spacing: -0.03em;">Experience</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div>
                        <p class="text-sm font-medium m-0" style="color: var(--text-primary);">
                            {{ $portfolio['contact']['current_role']['role'] }}, {{ $portfolio['contact']['current_role']['company'] }}
                        </p>
                        <p class="text-[13px] mt-0.5" style="color: var(--text-secondary);">
                            {{ $portfolio['contact']['current_role']['duration'] }} · {{ $portfolio['location'] }}
                        </p>
                    </div>
                </div>
                @foreach ($portfolio['education'] as $item)
                    <div class="timeline-item">
                        <div class="timeline-dot timeline-dot--past"></div>
                        <div>
                            <p class="text-sm font-medium m-0" style="color: var(--text-primary);">
                                {{ $item['degree'] }}, {{ $item['school'] }}
                            </p>
                            <p class="text-[13px] mt-0.5" style="color: var(--text-secondary);">{{ $item['period'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-12">
            <p class="section-label">Process</p>
            <h2 class="text-2xl font-display mb-5" style="font-weight: 600; color: var(--text-primary); letter-spacing: -0.03em;">How I work</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
                @foreach ($portfolio['process'] as $step)
                    <x-anim-card padding="p-5">
                        <p class="text-[13px] mb-2" style="color: var(--text-accent);">{{ $step['step'] }}</p>
                        <h3 class="font-medium mb-1.5 text-sm" style="color: var(--text-primary);">{{ $step['title'] }}</h3>
                        <p class="text-[13px] leading-relaxed" style="color: var(--text-secondary);">{{ $step['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <x-anim-card padding="p-8 sm:p-10">
            <h2 class="text-2xl font-display mb-3" style="font-weight: 600; color: var(--text-primary); letter-spacing: -0.03em;">Ready to build something?</h2>
            <p class="text-[15px] max-w-2xl mb-6 leading-relaxed" style="color: var(--text-secondary);">
                {{ $portfolio['contact']['blurb'] }} Based in {{ $portfolio['location'] }} — open to remote and local collaboration.
            </p>
            <div class="flex flex-wrap gap-3">
                <x-anim-btn :href="route('about')" variant="ghost">More about me</x-anim-btn>
                <x-anim-btn :href="route('contact')" variant="solid">Get in touch</x-anim-btn>
            </div>
        </x-anim-card>
    </section>
@endsection
