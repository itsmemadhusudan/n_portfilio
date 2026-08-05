@php $standalone = $standalone ?? false; @endphp

<section class="max-w-5xl mx-auto px-6 {{ $standalone ? 'pb-10' : 'py-16' }}">
    @unless ($standalone)
        <div class="mb-10">
            <span class="text-xs uppercase tracking-wider font-mono" style="color: var(--yellow); font-weight: 500;">
                Background
            </span>
            <h2 class="text-3xl sm:text-4xl mt-2 font-display" style="font-weight: 700; color: #F8FAFC;">
                Education & highlights
            </h2>
        </div>
    @endunless

    <div class="space-y-6 mb-10">
        @foreach ($portfolio['education'] as $item)
            <x-anim-card padding="p-6 sm:p-8">
                <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
                    <div>
                        <div class="flex items-center gap-2 mb-2" style="color: var(--coral);">
                            <x-icon name="graduation" :size="18" />
                            <span class="text-xs font-mono uppercase tracking-wider">Education</span>
                        </div>
                        <h3 class="text-xl font-display" style="font-weight: 600; color: #F8FAFC;">{{ $item['degree'] }}</h3>
                        <p class="text-sm mt-1" style="color: #94A3B8;">{{ $item['school'] }}</p>
                    </div>
                    <span class="text-xs font-mono px-2.5 py-1 rounded-md" style="background: var(--soft); color: #CBD5E1;">
                        {{ $item['period'] }}
                    </span>
                </div>
                @if (! empty($item['details']))
                    <p class="text-sm leading-relaxed mb-4" style="color: #94A3B8;">{{ $item['details'] }}</p>
                @endif
                @if (! empty($item['points']))
                    <ul class="space-y-2">
                        @foreach ($item['points'] as $point)
                            <li class="text-sm flex gap-2" style="color: #CBD5E1;">
                                <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--coral);"></span>
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
        <h3 class="text-xl font-display" style="font-weight: 600; color: #F8FAFC;">Achievements & leadership</h3>
    </div>
    <div class="grid sm:grid-cols-2 gap-4">
        @foreach ($portfolio['achievements'] as $achievement)
            <x-anim-card padding="p-5">
                <h4 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $achievement['title'] }}</h4>
                <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $achievement['desc'] }}</p>
            </x-anim-card>
        @endforeach
    </div>
</section>
