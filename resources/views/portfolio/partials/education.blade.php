@php
    $standalone = $standalone ?? false;
    $timelineOnly = $timelineOnly ?? false;
@endphp

<section class="page-wrap {{ $standalone ? 'pb-4' : 'py-10' }}">
    @unless ($standalone)
        <x-section-title
            eyebrow="Background"
            title="Education & highlights"
        />
    @endunless

    <ol class="timeline mb-10">
        @foreach ($portfolio['education'] as $index => $item)
            <li
                class="timeline-item reveal"
                style="--reveal-delay: {{ $index * 80 }}ms"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <div class="timeline-dot {{ $index > 0 ? 'timeline-dot--past' : '' }}" aria-hidden="true"></div>
                <x-card padding="p-5 sm:p-6">
                    <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
                        <div>
                            <div class="flex items-center gap-2 mb-2" style="color: var(--neon-cyan);">
                                <x-icon name="graduation" :size="18" />
                                <span class="section-label" style="margin: 0;">Education</span>
                            </div>
                            <h3 class="text-xl font-display" style="font-weight: 600; color: var(--text-primary);">{{ $item['degree'] }}</h3>
                            <p class="text-sm mt-1" style="color: var(--neon-cyan);">{{ $item['school'] }}</p>
                        </div>
                        <span class="chip">{{ $item['period'] }}</span>
                    </div>
                    @if (! empty($item['details']))
                        <p class="text-sm leading-relaxed mb-4" style="color: var(--text-secondary);">{{ $item['details'] }}</p>
                    @endif
                    @if (! empty($item['points']) && ! $timelineOnly)
                        <ul class="space-y-2">
                            @foreach ($item['points'] as $point)
                                <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                                    <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--fill-accent);"></span>
                                    <span>{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-card>
            </li>
        @endforeach
    </ol>

    @unless ($timelineOnly)
        <div class="mb-4 flex items-center gap-2" style="color: var(--neon-violet);">
            <x-icon name="award" :size="20" />
            <h3 class="text-xl font-display" style="font-weight: 600; color: var(--text-primary);">Achievements & leadership</h3>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            @foreach ($portfolio['achievements'] as $achievement)
                <x-card padding="p-3.5">
                    <h4 class="font-medium mb-1 text-[13px] font-display" style="color: var(--text-primary);">{{ $achievement['title'] }}</h4>
                    <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $achievement['desc'] }}</p>
                </x-card>
            @endforeach
        </div>
    @endunless
</section>
