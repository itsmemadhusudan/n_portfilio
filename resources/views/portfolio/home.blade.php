@extends('layouts.portfolio')

@section('content')
    @include('portfolio.partials.hero')

    <section class="max-w-5xl mx-auto px-6 pb-16">
        <div class="mb-14">
            <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--coral);">Backend Developer</p>
            <h2 class="text-2xl sm:text-3xl font-display mb-4" style="font-weight: 700; color: #F8FAFC;">What I focus on</h2>
            <p class="text-sm sm:text-base leading-relaxed max-w-3xl mb-6" style="color: #94A3B8;">
                {{ $portfolio['backend_intro'] }}
            </p>
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach ($portfolio['backend_stack'] as $tech)
                    <span class="text-xs px-2.5 py-1 rounded-md font-mono" style="background: var(--soft); color: #CBD5E1; border: 1px solid rgba(148,163,184,0.15);">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($portfolio['backend_highlights'] as $item)
                    <x-anim-card padding="p-5">
                        <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $item['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $item['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4 mb-14">
            <x-anim-card :href="route('projects')" padding="p-5">
                <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--blue);">Projects</p>
                <p class="font-display text-lg" style="font-weight: 600; color: #F8FAFC;">{{ count($portfolio['projects']) }} featured builds</p>
                <p class="text-sm mt-2" style="color: #94A3B8;">APIs, databases, Laravel apps and full product backends.</p>
            </x-anim-card>
            <x-anim-card :href="route('skills')" padding="p-5">
                <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--coral);">Backend stack</p>
                <p class="font-display text-lg" style="font-weight: 600; color: #F8FAFC;">Laravel · Node · Python</p>
                <p class="text-sm mt-2" style="color: #94A3B8;">REST APIs, auth flows and database modeling.</p>
            </x-anim-card>
            <x-anim-card :href="route('education')" padding="p-5">
                <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--yellow);">Education</p>
                <p class="font-display text-lg" style="font-weight: 600; color: #F8FAFC;">BCIS · Apex College</p>
                <p class="text-sm mt-2" style="color: #94A3B8;">Leadership, mentoring and campus tech involvement.</p>
            </x-anim-card>
        </div>

        <div class="mb-14">
            <div class="flex items-end justify-between gap-4 mb-6">
                <div>
                    <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--coral);">What I do</p>
                    <h2 class="text-2xl sm:text-3xl font-display" style="font-weight: 700; color: #F8FAFC;">Services & freelance work</h2>
                </div>
                <x-anim-btn :href="route('contact')" variant="ghost">Hire me →</x-anim-btn>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($portfolio['services'] as $service)
                    <x-anim-card padding="p-5">
                        <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $service['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $service['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="mb-14">
            <div class="flex items-end justify-between gap-4 mb-6">
                <div>
                    <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--blue);">Selected work</p>
                    <h2 class="text-2xl sm:text-3xl font-display" style="font-weight: 700; color: #F8FAFC;">Recent projects</h2>
                </div>
                <x-anim-btn :href="route('projects')" variant="ghost">View all →</x-anim-btn>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach (array_slice($portfolio['projects'], 0, 4) as $project)
                    @php $color = $portfolio['palette'][$project['color']]; @endphp
                    <x-anim-card :href="route('projects')" padding="p-5">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h3 class="font-display text-lg" style="font-weight: 600; color: #F8FAFC;">{{ $project['name'] }}</h3>
                            <span class="text-[10px] px-2 py-0.5 rounded font-mono" style="background: {{ $color }}; color: #042F2E;">{{ $project['tag'] }}</span>
                        </div>
                        <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $project['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="mb-14">
            <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: var(--yellow);">How I work</p>
            <h2 class="text-2xl sm:text-3xl font-display mb-6" style="font-weight: 700; color: #F8FAFC;">Simple delivery process</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($portfolio['process'] as $step)
                    <x-anim-card padding="p-5">
                        <p class="text-xs font-mono mb-3" style="color: var(--coral);">{{ $step['step'] }}</p>
                        <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $step['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $step['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <x-anim-card padding="p-8 sm:p-10">
            <h2 class="text-2xl font-display mb-3" style="font-weight: 700; color: #F8FAFC;">Ready to build something?</h2>
            <p class="text-sm sm:text-base max-w-2xl mb-6" style="color: #94A3B8;">
                {{ $portfolio['contact']['blurb'] }} Based in {{ $portfolio['location'] }} — open to remote and local collaboration.
            </p>
            <div class="flex flex-wrap gap-3">
                <x-anim-btn :href="route('about')" variant="ghost">More about me</x-anim-btn>
                <x-anim-btn :href="route('contact')" variant="solid">Get in touch</x-anim-btn>
            </div>
        </x-anim-card>
    </section>
@endsection
