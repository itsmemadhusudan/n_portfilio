<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="K8Ai_OXXDW3Ph4PMbheHyoZ1G1vXbPonnIAcqas9Yh4" />
    <script>
        (() => {
            try {
                const saved = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (saved === 'dark' || (!saved && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (_) {}
        })();
    </script>
    @if ($pageKey === 'home')
        <link rel="preload" as="image" href="{{ asset('images/portrait.jpg') }}" type="image/jpeg" fetchpriority="high">
        <link rel="preload" as="image" href="{{ asset('images/bgimage.webp') }}" type="image/webp">
    @endif
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    @if (! empty($seo['keywords']))
        <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endif
    <meta name="author" content="{{ $portfolio['full_name'] }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="{{ $seo['theme_color'] }}">
    <meta name="color-scheme" content="light dark">
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

    <link rel="icon" href="{{ asset('images/logo/logo-icon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo-icon.svg') }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ $seo['site_url'] }}/sitemap.xml">

    @php
        $personId = $seo['site_url'].'/#person';
        $websiteId = $seo['site_url'].'/#website';
        $breadcrumbItems = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $seo['site_url'].'/'],
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
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => 'NP',
                    'addressLocality' => 'Lalitpur',
                    'addressRegion' => 'Bagmati',
                ],
                'areaServed' => array_map(function ($place) {
                    if ($place === 'Remote') {
                        return 'Remote';
                    }
                    if (in_array($place, ['Nepal'], true)) {
                        return ['@type' => 'Country', 'name' => $place];
                    }

                    return ['@type' => 'City', 'name' => $place];
                }, $seo['area_served'] ?? ['Lalitpur', 'Nepal', 'Remote']),
                'worksFor' => [
                    '@type' => 'Organization',
                    'name' => $portfolio['contact']['current_role']['company'],
                ],
                'alumniOf' => [
                    '@type' => 'CollegeOrUniversity',
                    'name' => 'Apex College',
                ],
                'knowsAbout' => $seo['knows_about'] ?? $portfolio['backend_stack'],
                'sameAs' => array_values(array_filter([
                    $portfolio['social']['linkedin'] ?? null,
                    $portfolio['social']['github'] ?? null,
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
        if (! empty($seo['faqs']) && ($pageKey === 'contact' || str_starts_with($seo['path'] ?? '', '/stack/'))) {
            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => $seo['canonical'].'#faq',
                'mainEntity' => array_map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
                ], $seo['faqs']),
            ];
        }
        if (str_starts_with($seo['path'] ?? '', '/stack/') && ! empty($seo['h1'])) {
            $graph[] = [
                '@type' => 'TechArticle',
                '@id' => $seo['canonical'].'#article',
                'headline' => $seo['h1'],
                'description' => $seo['description'],
                'author' => ['@id' => $personId],
                'publisher' => ['@id' => $personId],
                'mainEntityOfPage' => $seo['canonical'],
                'inLanguage' => 'en',
            ];
        }
        $jsonLd = ['@context' => 'https://schema.org', '@graph' => $graph];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

    @php($usingViteDev = file_exists(public_path('hot')))
    @if ($usingViteDev)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>{!! file_get_contents(resource_path('css/critical.css')) !!}</style>
        <link rel="preload" as="style" href="{{ Vite::asset('resources/css/app.css') }}" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}"></noscript>
        @vite(['resources/js/app.js'])
    @endif
</head>
<body data-page="{{ $pageKey }}">
    <a href="#main-content" class="sr-only focus:not-sr-only">Skip to content</a>
    @include('partials.header')
    <main id="main-content">
        @yield('content')
    </main>
    @include('partials.footer')
    <button type="button" class="back-top" data-back-top aria-label="Back to top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>
    <div class="search-overlay" data-search-overlay hidden>
        <div class="search-overlay__box" role="dialog" aria-modal="true" aria-label="Search">
            <label class="sr-only" for="site-search">Search</label>
            <input id="site-search" type="search" placeholder="Search pages, skills, projects…" autocomplete="off">
        </div>
    </div>
    @stack('scripts')
</body>
</html>
