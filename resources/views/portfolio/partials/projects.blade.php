@php
    $palette = $portfolio['palette'];
    $standalone = $standalone ?? false;
@endphp

<section class="max-w-5xl mx-auto px-6 {{ $standalone ? 'pb-10' : 'py-16' }}">
    @unless ($standalone)
        <div class="mb-10">
            <span class="text-xs uppercase tracking-wider font-mono" style="color: var(--blue); font-weight: 500;">
                Selected work
            </span>
            <h2 class="text-3xl sm:text-4xl mt-2 font-display" style="font-weight: 700; color: #F8FAFC;">
                College projects
            </h2>
        </div>
    @endunless

    <div class="grid gap-6">
        @foreach ($portfolio['projects'] as $index => $project)
            @php $color = $palette[$project['color']]; @endphp
            <div
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :style="{
                    opacity: shown ? 1 : 0,
                    transform: shown ? 'translateY(0)' : 'translateY(20px)',
                    transition: 'opacity 0.6s ease {{ $index * 80 }}ms, transform 0.6s ease {{ $index * 80 }}ms',
                }"
            >
                <div class="project-card">
                    <div class="project-card__glow" aria-hidden="true"></div>
                    <div class="project-card__inner p-6 sm:p-8">
                        <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span
                                        class="text-[11px] px-2 py-1 rounded-md font-medium font-mono"
                                        style="background: {{ $color }}; color: #042F2E;"
                                    >
                                        {{ $project['tag'] }}
                                    </span>
                                    @if (! empty($project['type']))
                                        <span class="text-[11px] font-mono" style="color: #64748B;">{{ $project['type'] }}</span>
                                    @endif
                                </div>
                                <h3 class="text-2xl font-display" style="color: #F8FAFC; font-weight: 600;">
                                    {{ $project['name'] }}
                                </h3>
                                @if (! empty($project['period']))
                                    <p class="text-xs mt-1 font-mono" style="color: #64748B;">{{ $project['period'] }}</p>
                                @endif
                            </div>
                        </div>

                        <p class="text-sm sm:text-base mb-4 leading-relaxed" style="color: #94A3B8;">
                            {{ $project['long_desc'] ?? $project['desc'] }}
                        </p>

                        @if (! empty($project['highlights']))
                            <ul class="grid sm:grid-cols-2 gap-2 mb-5">
                                @foreach ($project['highlights'] as $highlight)
                                    <li class="text-sm flex gap-2" style="color: #CBD5E1;">
                                        <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: {{ $color }};"></span>
                                        <span>{{ $highlight }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($project['stack'] as $tech)
                                <span
                                    class="text-xs px-2.5 py-1 rounded-md font-mono"
                                    style="background: var(--soft); color: #CBD5E1; border: 1px solid rgba(148,163,184,0.15);"
                                >
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
