<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $portfolio['bio'] }}">
    <title>
        @isset($pageTitle)
            {{ $pageTitle }} — {{ $portfolio['brand'] }}
        @else
            {{ $portfolio['brand'] }} — {{ $portfolio['title'] }}
        @endisset
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="min-h-screen w-full antialiased flex flex-col"
    style="background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; color: var(--ink);"
>
    @include('portfolio.partials.background')

    @include('portfolio.partials.nav')

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="text-center py-10 text-xs" style="color: #64748B;">
        {{ $portfolio['footer'] }}
    </footer>
</body>
</html>
