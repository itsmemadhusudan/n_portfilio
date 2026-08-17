@php
    $palette = $portfolio['palette'];
    $standalone = $standalone ?? false;
@endphp

<section class="page-wrap {{ $standalone ? 'pb-10' : 'py-10' }}">
    @unless ($standalone)
        <div class="mb-6">
            <p class="section-label" style="color: var(--blue);">Selected work</p>
            <h2 class="text-2xl sm:text-3xl mt-1 font-display" style="font-weight: 600; color: var(--text-primary);">
                College projects
            </h2>
        </div>
    @endunless

    <div class="grid gap-4">
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
                                        class="chip"
                                        style="background: {{ $color }}; color: var(--text-primary); border: 0; font-size: 11px; padding: 4px 8px;"
                                    >
                                        {{ $project['tag'] }}
                                    </span>
                                    @if (! empty($project['type']))
                                        <span class="text-[11px]" style="color: var(--text-secondary);">{{ $project['type'] }}</span>
                                    @endif
                                </div>
                                <h3 class="text-2xl font-display" style="color: var(--text-primary); font-weight: 600;">
                                    {{ $project['name'] }}
                                </h3>
                                @if (! empty($project['period']))
                                    <p class="text-xs mt-1" style="color: var(--text-secondary);">{{ $project['period'] }}</p>
                                @endif
                            </div>
                        </div>

                        <p class="text-sm sm:text-base mb-4 leading-relaxed" style="color: var(--text-secondary);">
                            {{ $project['long_desc'] ?? $project['desc'] }}
                        </p>

                        @if (! empty($project['highlights']))
                            <ul class="grid sm:grid-cols-2 gap-2 mb-5">
                                @foreach ($project['highlights'] as $highlight)
                                    <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                                        <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: {{ $color }};"></span>
                                        <span>{{ $highlight }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($project['stack'] as $tech)
                                <span class="chip">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
