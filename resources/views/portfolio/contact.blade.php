@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Contact"
        :title="$seo['h1']"
        :subtitle="$portfolio['contact']['blurb']"
        accent="var(--mint)"
    />

    <section class="page-wrap pb-10">
        <p class="text-sm mb-8 max-w-2xl" style="color: var(--text-secondary);">
            {{ $portfolio['contact']['availability'] }}
        </p>

        <div class="grid sm:grid-cols-3 gap-3 mb-10">
            <x-anim-card
                :href="$portfolio['email_href']"
                padding="p-6"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Send an email via Gmail"
            >
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: var(--bg-accent); color: var(--text-accent);">
                    <x-icon name="mail" :size="18" />
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-primary);">Email</p>
                <p class="text-sm" style="color: var(--text-secondary);">Opens Gmail compose</p>
            </x-anim-card>

            <x-anim-card
                :href="$portfolio['phone_href']"
                padding="p-6"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Chat on WhatsApp"
            >
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: var(--bg-accent); color: var(--text-accent);">
                    <x-icon name="phone" :size="18" />
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-primary);">WhatsApp</p>
                <p class="text-sm" style="color: var(--text-secondary);">{{ $portfolio['phone'] }}</p>
            </x-anim-card>

            <x-anim-card :href="$portfolio['social']['linkedin']" padding="p-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: var(--bg-accent); color: var(--text-accent);">
                    <x-icon name="linkedin" :size="18" />
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-primary);">LinkedIn</p>
                <p class="text-sm" style="color: var(--text-secondary);">madhusudan-timalsina</p>
            </x-anim-card>
        </div>

        <div class="grid lg:grid-cols-2 gap-3 mb-10">
            <x-anim-card padding="p-6 sm:p-8">
                <p class="section-label">
                    {{ $portfolio['contact']['current_role']['duration'] }}
                </p>
                <h2 class="text-xl font-display mb-2" style="font-weight: 600; color: var(--text-primary);">
                    {{ $portfolio['contact']['current_role']['title'] }}
                </h2>
                <p class="text-sm mb-1" style="color: var(--text-accent);">
                    {{ $portfolio['contact']['current_role']['role'] }} · {{ $portfolio['contact']['current_role']['company'] }}
                </p>
                <p class="text-sm leading-relaxed mb-5" style="color: var(--text-secondary);">
                    {{ $portfolio['contact']['current_role']['summary'] }}
                </p>
                <ul class="space-y-3">
                    @foreach ($portfolio['contact']['current_role']['highlights'] as $item)
                        <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                            <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--fill-accent);"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-anim-card>
            <x-anim-card padding="p-6 sm:p-8">
                <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Good conversation topics</h2>
                <ul class="space-y-3">
                    @foreach ($portfolio['contact']['topics'] as $item)
                        <li class="text-sm flex gap-2" style="color: var(--text-secondary);">
                            <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--blue);"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-anim-card>
        </div>

        <div class="mb-10">
            <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Freelance services</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($portfolio['services'] as $service)
                    <x-anim-card padding="p-3.5">
                        <h3 class="font-medium mb-1 text-[13px]" style="color: var(--text-primary);">{{ $service['title'] }}</h3>
                        <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $service['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        @if (! empty($seo['faqs']))
            <div class="mb-10">
                <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: var(--text-primary);">Frequently asked questions</h2>
                <div class="space-y-3">
                    @foreach ($seo['faqs'] as $faq)
                        <x-anim-card padding="p-3.5">
                            <h3 class="font-medium mb-2 text-[13px]" style="color: var(--text-primary);">{{ $faq['question'] }}</h3>
                            <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">{{ $faq['answer'] }}</p>
                        </x-anim-card>
                    @endforeach
                </div>
            </div>
        @endif

        @include('portfolio.partials.contact', ['standalone' => true])
    </section>
@endsection
