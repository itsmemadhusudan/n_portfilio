@php
    $palette = $portfolio['palette'];
    $standalone = $standalone ?? false;
@endphp

<section class="page-wrap {{ $standalone ? 'pb-10' : 'py-10' }}">
    @unless ($standalone)
        <div class="mb-6">
            <p class="section-label" style="color: var(--text-accent);">Technical skills</p>
            <h2 class="text-2xl sm:text-3xl mt-1 font-display" style="font-weight: 600; color: var(--text-primary);">
                Tools and capabilities
            </h2>
        </div>
    @endunless

    <div class="grid sm:grid-cols-2 gap-3">
        @foreach ($portfolio['stack'] as $index => $layer)
            @php $color = $palette[$layer['color']]; @endphp
            <div
                x-data="{ shown: false }"
                x-intersect:enter.once="shown = true"
                :style="{
                    opacity: shown ? 1 : 0,
                    transform: shown ? 'translateY(0)' : 'translateY(20px)',
                    transition: 'opacity 0.6s ease {{ $index * 80 }}ms, transform 0.6s ease {{ $index * 80 }}ms',
                }"
            >
                <x-anim-card padding="p-6">
                    <div
                        class="w-10 h-10 rounded-lg flex items-center justify-center mb-4"
                        style="background: {{ $color }}; color: var(--text-primary);"
                    >
                        <x-icon :name="$layer['icon']" :size="20" :stroke="2" />
                    </div>

                    <h3 class="text-lg mb-1.5 font-display" style="color: var(--text-primary); font-weight: 600;">
                        {{ $layer['label'] }}
                    </h3>
                    <p class="text-sm mb-3 leading-relaxed" style="color: var(--text-secondary);">
                        {{ $layer['blurb'] }}
                    </p>
                    @if (! empty($layer['details']))
                        <p class="text-sm mb-4 leading-relaxed" style="color: var(--text-secondary); opacity: 0.85;">
                            {{ $layer['details'] }}
                        </p>
                    @endif
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($layer['tools'] as $tool)
                            <span class="chip">{{ $tool }}</span>
                        @endforeach
                    </div>
                </x-anim-card>
            </div>
        @endforeach
    </div>
</section>
