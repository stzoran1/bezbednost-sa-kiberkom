<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('flyer.title') }}</title>
    <meta property="og:title" content="{{ __('flyer.title') }}">
    <meta property="og:description" content="{{ __('welcome.subtitle') }}">
    <meta property="og:image" content="{{ url('/og-image.png') }}">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flajer.js'])
    <style>
        @media print {
            @page { margin: 0; size: A4; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
            #flajer { width: 210mm; }
            #flajer-back { width: 210mm; break-before: page; }
            .print-grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
    </style>
</head>
<body class="bg-gray-100">

@php
    $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
@endphp

{{-- Toolbar --}}
<div class="no-print sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-200 py-3 px-4 md:px-6 flex items-center justify-between gap-2">
    <a href="{{ $localePrefix }}/" class="inline-flex items-center gap-2 text-gray-700 hover:text-gray-900 font-semibold transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        {{ __('flyer.back') }}
    </a>
    <button
        id="download-pdf"
        class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2 md:px-6 md:py-2.5 rounded-xl shadow hover:shadow-md transition-all text-sm md:text-base min-h-[44px]"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        {{ __('flyer.download_pdf') }}
    </button>
</div>

{{-- Flyer content --}}
<div id="flajer" class="w-full md:w-[210mm] min-h-[297mm] mx-auto my-0 md:my-8 print:my-0 bg-gradient-to-b from-teal-600 via-cyan-500 to-sky-600 p-4 md:p-8 print:p-8 shadow-2xl print:shadow-none">

    {{-- Header --}}
    <div class="text-center mb-6">
        <x-mascot variant="default" class="w-28 h-28 mx-auto mb-3" />
        <h1 class="text-4xl font-extrabold text-white tracking-tight">
            {{ __('flyer.header.title') }}
        </h1>
        <p class="text-lg text-white mt-1">{{ __('flyer.header.subtitle') }}</p>
    </div>

    {{-- 4 Golden Rules --}}
    <div class="bg-white rounded-2xl p-6 mb-4 border border-white/50">
        <h2 class="text-center text-xl font-bold text-teal-700 mb-5 pb-3 border-b-2 border-teal-200">
            {!! __('flyer.rules.heading') !!}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 print-grid-cols-2 gap-4">
            @foreach([1, 2, 3, 4] as $num)
            <div class="flex gap-3 items-start rounded-xl p-4 border border-gray-300">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg">{{ $num }}</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm leading-tight">{{ __("flyer.rules.$num.title") }}</h3>
                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">{{ __("flyer.rules.$num.text") }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Two columns: Danger + Action --}}
    <div class="grid grid-cols-1 md:grid-cols-2 print-grid-cols-2 gap-4 mb-4">

        {{-- Danger Box --}}
        <div class="bg-white rounded-2xl p-5 border border-white/50 border-l-4 border-l-red-500">
            <div class="flex items-center gap-2 mb-3">
                <x-mascot variant="warning" class="w-12 h-12" />
                <h2 class="text-lg font-bold text-red-600">{{ __('flyer.danger.heading') }}</h2>
            </div>
            <div class="space-y-1.5">
                @foreach(__('flyer.danger.signs') as $sign)
                <p class="text-xs text-gray-700 flex items-start gap-1.5">
                    <span class="text-red-500 font-bold text-sm leading-none mt-px">&#10007;</span>
                    {{ $sign }}
                </p>
                @endforeach
                <p class="text-xs text-red-600 font-bold flex items-start gap-1.5 mt-1.5 pt-1.5 border-t border-red-200">
                    <span class="text-sm leading-none mt-px">&#10007;</span>
                    {{ __('flyer.danger.warning') }}
                </p>
            </div>
        </div>

        {{-- Action Box --}}
        <div class="bg-white rounded-2xl p-5 border border-white/50 border-l-4 border-l-emerald-500">
            <div class="flex items-center gap-2 mb-3">
                <x-mascot variant="thumbsup" class="w-12 h-12" />
                <h2 class="text-lg font-bold text-emerald-600">{{ __('flyer.action.heading') }}</h2>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-700 leading-relaxed">
                    {!! __('flyer.action.tell') !!}
                </p>
                <p class="text-xs text-gray-700 leading-relaxed">
                    {!! __('flyer.action.protect') !!}
                </p>
                <p class="text-xs text-gray-700 leading-relaxed">
                    {!! __('flyer.action.hotline') !!}
                </p>
                <p class="text-xs text-gray-700 leading-relaxed">
                    {!! __('flyer.action.report_in_app') !!}
                </p>
                <p class="text-xs text-gray-700 leading-relaxed">
                    {!! __('flyer.action.block') !!}
                </p>
                <div class="bg-emerald-100 rounded-xl p-2.5 mt-1">
                    <p class="text-xs text-emerald-800 font-bold text-center">
                        {!! __('flyer.action.brave') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-4">
        <p class="text-xl font-extrabold text-yellow-200">
            {{ __('flyer.footer.message') }}
        </p>
        <p class="text-sm text-white mt-1">{!! __('flyer.footer.tagline') !!}</p>
    </div>
</div>

{{-- Back page --}}
<div id="flajer-back" class="w-full md:w-[210mm] min-h-[297mm] mx-auto my-0 md:my-8 print:my-0 bg-gradient-to-b from-teal-600 via-cyan-500 to-sky-600 p-4 md:p-8 print:p-8 shadow-2xl print:shadow-none flex flex-col items-center justify-center text-center">

    <x-mascot variant="default" class="w-20 h-20 mb-6" />

    <h2 class="text-3xl font-extrabold text-white mb-8">
        {{ __('flyer.back_page.heading') }}
    </h2>

    <p class="text-sm font-semibold text-white/80 uppercase tracking-wider mb-2">
        {{ __('flyer.back_page.url_label') }}
    </p>

    <a href="{{ __('flyer.back_page.url') }}" class="text-2xl font-bold text-yellow-200 hover:text-yellow-100 underline underline-offset-4 transition-colors mb-10 break-all">
        {{ __('flyer.back_page.url') }}
    </a>

    <div class="bg-white rounded-2xl p-6 inline-block mb-6">
        {!! QrCode::format('svg')->size(300)->generate(__('flyer.back_page.url')) !!}
    </div>

    <p class="text-lg font-semibold text-white">
        {{ __('flyer.back_page.scan_qr') }}
    </p>
</div>

</body>
</html>
