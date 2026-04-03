<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
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
    {{ $slot }}

    <a href="/" style="position:fixed;top:1rem;right:1rem;z-index:9999;padding:0.5rem 1rem;background:rgba(255,255,255,0.25);color:#fff;font-size:0.875rem;font-weight:600;border-radius:9999px;text-decoration:none;backdrop-filter:blur(8px);transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.45)'" onmouseout="this.style.background='rgba(255,255,255,0.25)'" title="Početna strana">
        &#8962; Početna
    </a>

    @livewireScripts
</body>
</html>
