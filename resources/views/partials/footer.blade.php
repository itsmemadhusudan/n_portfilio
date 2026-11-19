<footer class="site-footer" role="contentinfo">
    <div class="site-footer__top">
        <a href="{{ route('home') }}" class="site-footer__brand">
            <img
                class="brand__logo brand__logo--full"
                src="{{ asset(ltrim($portfolio['logo'] ?? '/images/logo/logo-light.svg', '/')) }}"
                alt="{{ $portfolio['full_name'] }}"
                width="320"
                height="56"
            >
        </a>
        <div class="site-footer__contact">
            @if (! empty($portfolio['phone_href']))
                <a class="site-footer__contact-item" href="{{ $portfolio['phone_href'] }}" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.5 3.5A11 11 0 0 0 2.1 17.8L1 23l5.3-1.1A11 11 0 1 0 20.5 3.5zM12 20.2a9.1 9.1 0 0 1-4.6-1.3l-.3-.2-3.2.7.7-3.1-.2-.3A9.1 9.1 0 1 1 12 20.2zm5.2-6.8c-.3-.1-1.7-.8-1.9-.9s-.5-.1-.6.1-.7.9-.9 1.1-.3.2-.6.1a7.4 7.4 0 0 1-2.2-1.4 8.2 8.2 0 0 1-1.5-1.9c-.2-.3 0-.4.1-.6l.4-.5.3-.4c.1-.2 0-.3 0-.5l-.9-2.1c-.2-.6-.5-.5-.6-.5h-.5c-.2 0-.5.1-.7.3s-1 1-1 2.4 1 2.8 1.2 3c.1.2 2 3.1 4.9 4.3 1.8.7 2.2.7 3 .6.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.4 0-.1-.3-.2-.6-.4z"/></svg>
                    Chat on WhatsApp
                </a>
            @endif
            <a class="site-footer__contact-item" href="{{ $portfolio['email_href'] }}" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                {{ $portfolio['email'] }}
            </a>
            <span class="site-footer__contact-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                {{ $portfolio['location'] }}
            </span>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container site-footer__bottom-inner">
            <p>© {{ date('Y') }} {{ $portfolio['full_name'] }}. All Rights Reserved.</p>
            <div class="footer-socials">
                @if (! empty($portfolio['social']['linkedin']))
                    <a href="{{ $portfolio['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.9 8.7H3.8V20h3.1V8.7zM5.4 4A1.8 1.8 0 1 0 5.4 7.6 1.8 1.8 0 0 0 5.4 4zM20.2 20h-3.1v-5.5c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9V20H10V8.7h3v1.5h.1c.4-.8 1.5-1.7 3-1.7 3.2 0 3.8 2.1 3.8 4.9V20z"/></svg>
                    </a>
                @endif
                @if (! empty($portfolio['social']['github']))
                    <a href="{{ $portfolio['social']['github'] }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-3.2 19.5c.5.1.7-.2.7-.5v-1.7c-2.8.6-3.4-1.2-3.4-1.2-.5-1.1-1.1-1.4-1.1-1.4-.9-.6.1-.6.1-.6 1 .1 1.5 1 1.5 1 .9 1.5 2.4 1.1 3 .8.1-.7.4-1.1.7-1.4-2.3-.3-4.7-1.1-4.7-5a3.9 3.9 0 0 1 1-2.7c-.1-.3-.4-1.3.1-2.7 0 0 .8-.3 2.8 1a9.7 9.7 0 0 1 5 0c2-1.3 2.8-1 2.8-1 .5 1.4.2 2.4.1 2.7a3.9 3.9 0 0 1 1 2.7c0 3.9-2.4 4.7-4.7 5 .4.3.7.9.7 1.9v2.8c0 .3.2.6.7.5A10 10 0 0 0 12 2z"/></svg>
                    </a>
                @endif
                <a href="{{ $portfolio['email_href'] }}" target="_blank" rel="noopener noreferrer" aria-label="Email">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
