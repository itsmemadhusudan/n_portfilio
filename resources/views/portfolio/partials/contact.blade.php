@php $standalone = $standalone ?? false; @endphp

<section class="max-w-5xl mx-auto px-6 {{ $standalone ? 'pb-4' : 'py-20' }}">
    <x-anim-card padding="p-10 sm:p-14">
        <div class="text-center">
            <h2 class="text-3xl sm:text-4xl mb-3 font-display" style="font-weight: 700; color: #F8FAFC;">
                {{ $portfolio['contact']['title'] }}
            </h2>

            <p class="text-sm sm:text-base mb-8 max-w-lg mx-auto" style="color: #94A3B8;">
                {{ $portfolio['contact']['blurb'] }}
            </p>

            <div class="flex items-center justify-center gap-3 flex-wrap">
                <x-anim-btn
                    :href="$portfolio['email_href']"
                    variant="solid"
                    :external="true"
                    aria-label="Send an email via Gmail"
                >
                    <x-icon name="mail" :size="16" />
                    Email
                </x-anim-btn>

                <x-anim-btn
                    :href="$portfolio['phone_href']"
                    variant="ghost"
                    :external="true"
                    aria-label="Chat on WhatsApp"
                >
                    <x-icon name="phone" :size="16" />
                    WhatsApp
                </x-anim-btn>

                <x-anim-btn :href="$portfolio['social']['linkedin']" variant="ghost" :external="true">
                    <x-icon name="linkedin" :size="16" />
                    LinkedIn
                </x-anim-btn>
            </div>
        </div>
    </x-anim-card>
</section>
