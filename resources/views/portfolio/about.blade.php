@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="About"
        title="Who I am"
        :subtitle="$portfolio['about_intro']"
        accent="var(--coral)"
    />

    <section class="max-w-5xl mx-auto px-6 pb-10">
        <div class="grid lg:grid-cols-5 gap-8 mb-12">
            <div class="lg:col-span-3 space-y-4">
                <x-anim-card padding="p-6 sm:p-8">
                    <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: #F8FAFC;">My story</h2>
                    @foreach ($portfolio['about_story'] as $paragraph)
                        <p class="text-base leading-relaxed mb-4 last:mb-0" style="color: #94A3B8;">{{ $paragraph }}</p>
                    @endforeach
                </x-anim-card>

                <x-anim-card padding="p-6 sm:p-8">
                    <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: #F8FAFC;">Profile summary</h2>
                    <p class="text-base leading-relaxed" style="color: #94A3B8;">{{ $portfolio['bio'] }}</p>
                </x-anim-card>
            </div>

            <div class="lg:col-span-2 space-y-4">
                <x-anim-card padding="p-6">
                    <p class="text-xs font-mono uppercase tracking-wider mb-2" style="color: #64748B;">Currently</p>
                    <p class="font-display text-lg" style="font-weight: 600; color: #F8FAFC;">{{ $portfolio['badge'] }}</p>
                    <p class="text-sm mt-2" style="color: #94A3B8;">{{ $portfolio['title'] }} · {{ $portfolio['location'] }}</p>
                    <div class="mt-5 flex items-center gap-3">
                        <a
                            href="{{ $portfolio['email_href'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-chip"
                            aria-label="Send an email via Gmail"
                            title="Email"
                        >
                            <x-icon name="mail" :size="18" />
                        </a>
                        <a
                            href="{{ $portfolio['phone_href'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-chip"
                            aria-label="Chat on WhatsApp"
                            title="WhatsApp"
                        >
                            <x-icon name="phone" :size="18" />
                        </a>
                        <a
                            href="{{ $portfolio['social']['linkedin'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-chip"
                            aria-label="LinkedIn profile"
                            title="LinkedIn"
                        >
                            <x-icon name="linkedin" :size="18" />
                        </a>
                    </div>
                </x-anim-card>

                <x-anim-card padding="p-6">
                    <h2 class="text-lg font-display mb-4" style="font-weight: 600; color: #F8FAFC;">Focus areas</h2>
                    <ul class="space-y-3">
                        @foreach ($portfolio['about_focus'] as $item)
                            <li class="text-sm leading-relaxed flex gap-2" style="color: #94A3B8;">
                                <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--coral);"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-anim-card>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-display mb-6" style="font-weight: 700; color: #F8FAFC;">What I value</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach ($portfolio['values'] as $value)
                    <x-anim-card padding="p-5">
                        <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $value['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $value['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-display mb-3" style="font-weight: 700; color: #F8FAFC;">Freelance & collaboration</h2>
            <p class="text-base leading-relaxed mb-6 max-w-3xl" style="color: #94A3B8;">{{ $portfolio['freelance']['intro'] }}</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($portfolio['freelance']['offers'] as $offer)
                    <x-anim-card padding="px-4 py-3">
                        <p class="text-sm" style="color: #CBD5E1;">{{ $offer }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="flex flex-wrap gap-3 pb-10">
            <x-anim-btn :href="route('projects')" variant="solid">See projects</x-anim-btn>
            <x-anim-btn :href="route('contact')" variant="ghost">Contact me</x-anim-btn>
        </div>
    </section>
@endsection
