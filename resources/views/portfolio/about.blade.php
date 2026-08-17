@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="About"
        :title="$seo['h1']"
        :subtitle="$portfolio['about_intro']"
        accent="var(--text-accent)"
    />

    <section class="page-wrap pb-10">
        <div class="grid lg:grid-cols-5 gap-4 mb-10">
            <div class="lg:col-span-3 space-y-3">
                <x-anim-card padding="p-6 sm:p-8">
                    <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Professional background</h2>
                    @foreach ($portfolio['about_story'] as $paragraph)
                        <p class="text-[15px] leading-relaxed mb-4 last:mb-0" style="color: var(--text-secondary);">{{ $paragraph }}</p>
                    @endforeach
                </x-anim-card>

                <x-anim-card padding="p-6 sm:p-8">
                    <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Profile summary</h2>
                    <p class="text-[15px] leading-relaxed" style="color: var(--text-secondary);">{{ $portfolio['bio'] }}</p>
                </x-anim-card>
            </div>

            <div class="lg:col-span-2 space-y-3">
                <x-anim-card padding="p-6">
                    <p class="section-label">Currently</p>
                    <p class="font-display text-lg" style="font-weight: 600; color: var(--text-primary);">{{ $portfolio['contact']['current_role']['role'] }}</p>
                    <p class="text-sm mt-1" style="color: var(--text-primary);">{{ $portfolio['contact']['current_role']['company'] }}</p>
                    <p class="text-sm mt-2" style="color: var(--text-secondary);">{{ $portfolio['contact']['current_role']['duration'] }} · {{ $portfolio['location'] }}</p>
                    <p class="text-sm mt-3 leading-relaxed" style="color: var(--text-secondary);">{{ $portfolio['contact']['current_role']['summary'] }}</p>
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
                    <h2 class="text-lg font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Focus areas</h2>
                    <ul class="space-y-3">
                        @foreach ($portfolio['about_focus'] as $item)
                            <li class="text-sm leading-relaxed flex gap-2" style="color: var(--text-secondary);">
                                <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--fill-accent);"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-anim-card>
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-2xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">What I value</h2>
            <div class="grid sm:grid-cols-2 gap-3">
                @foreach ($portfolio['values'] as $value)
                    <x-anim-card padding="p-3.5">
                        <h3 class="font-medium mb-1 text-[13px]" style="color: var(--text-primary);">{{ $value['title'] }}</h3>
                        <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $value['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="mb-10">
            <h2 class="text-2xl font-display mb-3" style="font-weight: 600; color: var(--text-primary);">Freelance & collaboration</h2>
            <p class="text-[15px] leading-relaxed mb-6 max-w-3xl" style="color: var(--text-secondary);">{{ $portfolio['freelance']['intro'] }}</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($portfolio['freelance']['offers'] as $offer)
                    <x-anim-card padding="px-4 py-3">
                        <p class="text-sm" style="color: var(--text-primary);">{{ $offer }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        <div class="flex flex-wrap gap-3 pb-6">
            <x-anim-btn :href="route('projects')" variant="solid">See projects</x-anim-btn>
            <x-anim-btn :href="route('contact')" variant="ghost">Contact me</x-anim-btn>
        </div>
    </section>
@endsection
