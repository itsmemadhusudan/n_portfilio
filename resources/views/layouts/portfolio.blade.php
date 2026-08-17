<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    @if (! empty($seo['keywords']))
        <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endif
    <meta name="author" content="{{ $portfolio['full_name'] }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="theme-color" content="{{ $seo['theme_color'] }}">
    <meta name="color-scheme" content="light">
    <link rel="canonical" href="{{ $seo['canonical'] }}">

    <meta property="og:type" content="{{ $pageKey === 'home' ? 'website' : 'profile' }}">
    <meta property="og:site_name" content="{{ $seo['site_name'] }}">
    <meta property="og:locale" content="{{ $seo['locale'] }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ $seo['og_image'] }}">
    <meta property="og:image:alt" content="{{ $seo['og_image_alt'] }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ $seo['og_image'] }}">
    <meta name="twitter:image:alt" content="{{ $seo['og_image_alt'] }}">
    @if (! empty($seo['twitter']))
        <meta name="twitter:site" content="{{ $seo['twitter'] }}">
        <meta name="twitter:creator" content="{{ $seo['twitter'] }}">
    @endif

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ $seo['site_url'] }}/sitemap.xml">

    @php
        $personId = $seo['site_url'].'/#person';
        $websiteId = $seo['site_url'].'/#website';
        $breadcrumbItems = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $seo['site_url'].'/',
            ],
        ];
        if ($pageKey !== 'home') {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $seo['h1'] ?? ucfirst($pageKey),
                'item' => $seo['canonical'],
            ];
        }

        $graph = [
            [
                '@type' => 'Person',
                '@id' => $personId,
                'name' => $portfolio['full_name'],
                'url' => $seo['site_url'].'/',
                'image' => $seo['og_image'],
                'jobTitle' => $portfolio['title'],
                'description' => $portfolio['bio'],
                'email' => 'mailto:'.$portfolio['email'],
                'telephone' => $portfolio['phone'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => 'NP',
                    'addressLocality' => $portfolio['location'],
                ],
                'worksFor' => [
                    '@type' => 'Organization',
                    'name' => $portfolio['contact']['current_role']['company'],
                ],
                'alumniOf' => [
                    '@type' => 'CollegeOrUniversity',
                    'name' => 'Apex College',
                ],
                'knowsAbout' => $portfolio['backend_stack'],
                'sameAs' => array_values(array_filter([
                    $portfolio['social']['linkedin'] ?? null,
                ])),
            ],
            [
                '@type' => 'WebSite',
                '@id' => $websiteId,
                'url' => $seo['site_url'].'/',
                'name' => $seo['site_name'],
                'description' => $seo['description'],
                'publisher' => ['@id' => $personId],
                'inLanguage' => 'en',
            ],
            [
                '@type' => 'WebPage',
                '@id' => $seo['canonical'].'#webpage',
                'url' => $seo['canonical'],
                'name' => $seo['title'],
                'description' => $seo['description'],
                'isPartOf' => ['@id' => $websiteId],
                'about' => ['@id' => $personId],
                'inLanguage' => 'en',
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $seo['canonical'].'#breadcrumb',
                'itemListElement' => $breadcrumbItems,
            ],
        ];

        if ($pageKey === 'contact' && ! empty($seo['faqs'])) {
            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => $seo['canonical'].'#faq',
                'mainEntity' => array_map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ], $seo['faqs']),
            ];
        }

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="min-h-screen w-full antialiased"
    style="background: var(--surface-2); font-family: 'Plus Jakarta Sans', sans-serif; color: var(--text-primary);"
>
    <div class="site-frame">
        <div class="site-panel">
            @include('portfolio.partials.nav')

            <main id="main-content">
                @yield('content')
            </main>

            <footer class="site-footer" role="contentinfo">
                <div class="site-footer__inner">
                    <div class="site-footer__social">
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
                    </div>
                    <p class="site-footer__copy">{{ $portfolio['footer'] }}</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
