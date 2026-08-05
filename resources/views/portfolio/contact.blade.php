@extends('layouts.portfolio')

@section('content')
    <x-page-header
        eyebrow="Contact"
        title="Let’s work together"
        :subtitle="$portfolio['contact']['blurb']"
        accent="var(--mint)"
    />

    <section class="max-w-5xl mx-auto px-6 pb-20">
        <p class="text-sm mb-8 max-w-2xl" style="color: #94A3B8;">
            {{ $portfolio['contact']['availability'] }}
        </p>

        <div class="grid sm:grid-cols-3 gap-4 mb-12">
            <x-anim-card
                :href="$portfolio['email_href']"
                padding="p-6"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Send an email via Gmail"
            >
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: var(--soft); color: var(--coral);">
                    <x-icon name="mail" :size="18" />
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #F8FAFC;">Email</p>
                <p class="text-sm" style="color: #94A3B8;">Opens Gmail compose</p>
            </x-anim-card>

            <x-anim-card
                :href="$portfolio['phone_href']"
                padding="p-6"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Chat on WhatsApp"
            >
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: var(--soft); color: var(--coral);">
                    <x-icon name="phone" :size="18" />
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #F8FAFC;">WhatsApp</p>
                <p class="text-sm" style="color: #94A3B8;">{{ $portfolio['phone'] }}</p>
            </x-anim-card>

            <x-anim-card :href="$portfolio['social']['linkedin']" padding="p-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: var(--soft); color: var(--coral);">
                    <x-icon name="linkedin" :size="18" />
                </div>
                <p class="text-sm font-semibold mb-1" style="color: #F8FAFC;">LinkedIn</p>
                <p class="text-sm" style="color: #94A3B8;">madhusudan-timalsina</p>
            </x-anim-card>
        </div>

        <div class="grid lg:grid-cols-2 gap-6 mb-12">
            <x-anim-card padding="p-6 sm:p-8">
                <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: #F8FAFC;">Open to</h2>
                <ul class="space-y-3">
                    @foreach ($portfolio['contact']['looking_for'] as $item)
                        <li class="text-sm flex gap-2" style="color: #CBD5E1;">
                            <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--coral);"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-anim-card>
            <x-anim-card padding="p-6 sm:p-8">
                <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: #F8FAFC;">Good conversation topics</h2>
                <ul class="space-y-3">
                    @foreach ($portfolio['contact']['topics'] as $item)
                        <li class="text-sm flex gap-2" style="color: #CBD5E1;">
                            <span class="mt-2 shrink-0 w-1.5 h-1.5 rounded-full" style="background: var(--blue);"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-anim-card>
        </div>

        <div class="mb-12">
            <h2 class="text-xl font-display mb-4" style="font-weight: 600; color: #F8FAFC;">Freelance services</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($portfolio['services'] as $service)
                    <x-anim-card padding="p-5">
                        <h3 class="font-semibold mb-2" style="color: #F1F5F9;">{{ $service['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: #94A3B8;">{{ $service['desc'] }}</p>
                    </x-anim-card>
                @endforeach
            </div>
        </div>

        @include('portfolio.partials.contact', ['standalone' => true])
    </section>
@endsection
