@php
    $palette = $portfolio['palette'];
    $standalone = $standalone ?? false;
@endphp

<section class="max-w-7xl mx-auto px-6 {{ $standalone ? 'pb-10' : 'py-16' }}">
    @unless ($standalone)
        <div class="mb-10">
            <span class="text-xs uppercase tracking-wider font-mono" style="color: var(--coral); font-weight: 500;">
                Technical skills
            </span>
            <h2 class="text-3xl sm:text-4xl mt-2 font-display" style="font-weight: 700; color: #F8FAFC;">
                Tools and capabilities
            </h2>
        </div>
    @endunless

    <div class="grid sm:grid-cols-2 gap-5">
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
                        style="background: {{ $color }}; color: #042F2E;"
                    >
                        <x-icon :name="$layer['icon']" :size="20" :stroke="2" />
                    </div>

                    <h3 class="text-lg mb-1.5 font-display" style="color: #F8FAFC; font-weight: 600;">
                        {{ $layer['label'] }}
                    </h3>
                    <p class="text-sm mb-3 leading-relaxed" style="color: #94A3B8;">
                        {{ $layer['blurb'] }}
                    </p>
                    @if (! empty($layer['details']))
                        <p class="text-sm mb-4 leading-relaxed" style="color: #64748B;">
                            {{ $layer['details'] }}
                        </p>
                    @endif
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($layer['tools'] as $tool)
                            <span
                                class="text-xs px-2.5 py-1 rounded-md font-mono"
                                style="background: var(--soft); color: #CBD5E1; border: 1px solid rgba(148,163,184,0.15);"
                            >
                                {{ $tool }}
                            </span>
                        @endforeach
                    </div>
                </x-anim-card>
            </div>
        @endforeach
    </div>
</section>
