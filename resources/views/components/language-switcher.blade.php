@props(['position' => 'right'])

@php
    $supportedLocales = config('locales.supported');
    $currentLocale = app()->getLocale();
    $fallbackLocale = config('app.fallback_locale');

    // Strip existing locale prefix from current path to get the base path.
    $path = request()->getPathInfo();
    $basePath = $path;
    foreach (array_keys($supportedLocales) as $loc) {
        if ($loc !== $fallbackLocale && str_starts_with($path, '/' . $loc)) {
            $basePath = substr($path, strlen('/' . $loc)) ?: '/';
            break;
        }
    }
@endphp

<div class="language-switcher fixed top-3 {{ $position === 'left' ? 'left-3' : 'right-3' }} z-[9999] flex gap-1 rounded-full bg-white/20 backdrop-blur-md p-1 shadow-lg no-print">
    @foreach ($supportedLocales as $locale => $label)
        @php
            $url = $locale === $fallbackLocale
                ? $basePath
                : '/' . $locale . ($basePath === '/' ? '' : $basePath);

            $isActive = $currentLocale === $locale;

            $flag = match ($locale) {
                'sr-Latn' => 'SR',
                'sr-Cyrl' => 'СР',
                'ru' => 'RU',
                default => strtoupper(substr($locale, 0, 2)),
            };

            $shortLabel = match ($locale) {
                'sr-Latn' => 'Lat',
                'sr-Cyrl' => 'Ћир',
                'ru' => 'Рус',
                default => $label,
            };
        @endphp
        <a
            href="{{ $url }}"
            aria-label="{{ $label }}"
            @if ($isActive) aria-current="true" @endif
            class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-full text-xs font-bold transition-all duration-200
                {{ $isActive
                    ? 'bg-white text-gray-900 shadow-md scale-105'
                    : 'text-white/90 hover:bg-white/30 hover:text-white' }}"
        >
            <span class="text-sm leading-none">{{ $flag }}</span>
            <span class="hidden sm:inline">{{ $shortLabel }}</span>
        </a>
    @endforeach
</div>
