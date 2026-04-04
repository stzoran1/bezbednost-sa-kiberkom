<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        html, body {
            margin: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #0e7490;
        }
    </style>
</head>
<body>
    <x-language-switcher position="left" />
    {{ $slot }}

    @php
        $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
    @endphp
    <a href="{{ $localePrefix }}/" style="position:fixed;top:1rem;right:1rem;z-index:9999;padding:0.5rem 1rem;background:rgba(255,255,255,0.25);color:#fff;font-size:0.875rem;font-weight:600;border-radius:9999px;text-decoration:none;backdrop-filter:blur(8px);transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.45)'" onmouseout="this.style.background='rgba(255,255,255,0.25)'" title="{{ __('presentation.home_title') }}">
        &#8962; {{ __('presentation.home') }}
    </a>

    @livewireScripts
</body>
</html>
