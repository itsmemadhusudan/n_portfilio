@php $standalone = $standalone ?? false; @endphp

<section class="page-wrap {{ $standalone ? 'pb-10' : 'py-10' }}">
    @unless ($standalone)
        <div class="mb-6">
            <p class="section-label" style="color: var(--yellow);">Background</p>
            <h2 class="text-2xl sm:text-3xl mt-1 font-display" style="font-weight: 600; color: var(--text-primary);">
                Education & highlights
            </h2>
        </div>
    @endunless

    <div class="space-y-4 mb-10">
        @foreach ($portfolio['education'] as $item)
            <x-anim-card padding="p-6 sm:p-8">
                <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
                    <div>
                        <div class="flex items-center gap-2 mb-2" style="color: var(--text-accent);">
                            <x-icon name="graduation" :size="18" />
                            <span class="section-label" style="margin: 0; color: var(--text-accent);">Education</span>
                        </div>
                        <h3 class="text-xl font-display" style="font-weight: 600; color: var(--text-primary);">{{ $item['degree'] }}</h3>
                        <p class="text-sm mt-1" style="color: var(--text-secondary);">{{ $item['school'] }}</p>
                    </div>
                    <span class="chip">{{ $item['period'] }}</span>
                </div>
                @if (! empty($item['details']))
                    <p class="text-sm leading-relaxed mb-4" style="color: var(--text-secondary);">{{ $item['details'] }}</p>
                @endif
                @if (! empty($item['points']))
                    <ul class="space-y-2">
                        @foreach ($item['points'] as $point)
                            <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                                <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--fill-accent);"></span>
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </x-anim-card>
        @endforeach
    </div>

    <div class="mb-4 flex items-center gap-2" style="color: var(--blue);">
        <x-icon name="award" :size="20" />
        <h3 class="text-xl font-display" style="font-weight: 600; color: var(--text-primary);">Achievements & leadership</h3>
    </div>
    <div class="grid sm:grid-cols-2 gap-3">
        @foreach ($portfolio['achievements'] as $achievement)
            <x-anim-card padding="p-3.5">
                <h4 class="font-medium mb-1 text-[13px]" style="color: var(--text-primary);">{{ $achievement['title'] }}</h4>
                <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $achievement['desc'] }}</p>
            </x-anim-card>
        @endforeach
    </div>
</section>
