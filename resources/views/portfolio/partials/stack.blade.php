@php
    $standalone = $standalone ?? false;
    $limitGroups = $limitGroups ?? false;
    $layers = $portfolio['stack'];
    if ($limitGroups) {
        $preferred = ['Backend', 'Database', 'Practices'];
        $layers = collect($layers)
            ->filter(fn ($layer) => in_array($layer['label'], $preferred, true))
            ->values()
            ->all();
    }
    $labelMap = [
        'Practices' => 'DevOps / Tools',
    ];
@endphp

<section class="page-wrap {{ $standalone ? 'pb-4' : 'py-10' }}">
    @unless ($standalone)
        <x-section-title
            eyebrow="Technical skills"
            title="Tools and capabilities"
        />
    @endunless

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach ($layers as $index => $layer)
            <div
                class="reveal"
                style="--reveal-delay: {{ $index * 70 }}ms"
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :class="shown && 'is-revealed'"
            >
                <x-card padding="p-6">
                    <div
                        class="w-10 h-10 rounded-[6px] flex items-center justify-center mb-4"
                        style="background: rgba(139, 61, 255, 0.18); color: var(--neon-cyan); border: 1px solid var(--border);"
                    >
                        <x-icon :name="$layer['icon']" :size="20" :stroke="2" />
                    </div>

                    <h3 class="text-lg mb-1.5 font-display" style="color: var(--text-primary); font-weight: 600;">
                        {{ $labelMap[$layer['label']] ?? $layer['label'] }}
                    </h3>
                    <p class="text-sm mb-3 leading-relaxed" style="color: var(--text-secondary);">
                        {{ $layer['blurb'] }}
                    </p>
                    @if (! empty($layer['details']) && ! $limitGroups)
                        <p class="text-sm mb-4 leading-relaxed" style="color: var(--text-secondary); opacity: 0.85;">
                            {{ $layer['details'] }}
                        </p>
                    @endif
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($layer['tools'] as $tool)
                            <span class="chip">{{ $tool }}</span>
                        @endforeach
                    </div>
                </x-card>
            </div>
        @endforeach
    </div>
</section>
