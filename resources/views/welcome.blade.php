@php
    $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
@endphp

<x-layout :title="__('welcome.title')">
    <div class="min-h-screen welcome-animated-bg flex items-center justify-center p-4 sm:p-6 welcome-bg-shapes">
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
            <div class="welcome-bg-shape welcome-bg-shape--1"></div>
            <div class="welcome-bg-shape welcome-bg-shape--2"></div>
            <div class="welcome-bg-shape welcome-bg-shape--3"></div>
            <div class="welcome-bg-shape welcome-bg-shape--4"></div>
            <div class="welcome-bg-shape welcome-bg-shape--5"></div>
            <div class="welcome-bg-shape welcome-bg-shape--6"></div>
            <div class="welcome-bg-shape welcome-bg-shape--7"></div>
            <div class="welcome-bg-shape welcome-bg-shape--8"></div>
            <div class="welcome-sparkle welcome-sparkle--1"></div>
            <div class="welcome-sparkle welcome-sparkle--2"></div>
            <div class="welcome-sparkle welcome-sparkle--3"></div>
            <div class="welcome-sparkle welcome-sparkle--4"></div>
            <div class="welcome-sparkle welcome-sparkle--5"></div>
            <div class="welcome-sparkle welcome-sparkle--6"></div>

            {{-- Security-themed floating symbols --}}
            <x-security-symbols symbol="shield" size="24" class="absolute top-[10%] left-[8%] opacity-30" />
            <x-security-symbols symbol="lock" size="20" class="absolute top-[25%] right-[12%] opacity-25" />
            <x-security-symbols symbol="phone" size="18" class="absolute bottom-[20%] left-[15%] opacity-20" />
            <x-security-symbols symbol="globe" size="22" class="absolute top-[60%] right-[8%] opacity-25" />
            <x-security-symbols symbol="key" size="20" class="absolute bottom-[12%] right-[25%] opacity-30" />
        </div>
        <div class="text-center max-w-3xl mx-auto relative z-10">
            <x-mascot variant="default" class="w-28 h-28 sm:w-36 sm:h-36 md:w-48 md:h-48 mx-auto mb-4 sm:mb-8 drop-shadow-lg animate-gentle-float" />

            <h1 class="text-3xl sm:text-5xl md:text-7xl font-extrabold drop-shadow-md mb-3 sm:mb-6 leading-tight animate-fade-in-up animate-delay-200 animate-shimmer-text">
                {{ __('welcome.title') }}
            </h1>

            <p class="text-lg sm:text-2xl md:text-3xl text-white/90 mb-8 sm:mb-14 font-medium animate-fade-in-up animate-delay-400">
                {{ __('welcome.subtitle') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center">
                <a href="{{ $localePrefix }}/prezentacija"
                   class="inline-block bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-extrabold text-lg sm:text-2xl md:text-3xl px-6 py-3 sm:px-12 sm:py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 min-h-[44px] animate-fade-in-up animate-delay-600 animate-btn-fun animate-btn-yellow">
                    {{ __('welcome.presentation') }}
                </a>

                <a href="{{ $localePrefix }}/igra"
                   class="inline-block bg-emerald-400 hover:bg-emerald-300 text-gray-900 font-extrabold text-lg sm:text-2xl md:text-3xl px-6 py-3 sm:px-12 sm:py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 min-h-[44px] animate-fade-in-up animate-delay-800 animate-btn-fun animate-btn-green">
                    {{ __('welcome.game') }}
                </a>

                <a href="{{ $localePrefix }}/flajer"
                   class="inline-block bg-white hover:bg-gray-100 text-gray-900 font-extrabold text-lg sm:text-2xl md:text-3xl px-6 py-3 sm:px-12 sm:py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 min-h-[44px] animate-fade-in-up animate-delay-1000 animate-btn-fun animate-btn-white">
                    {{ __('welcome.flyer') }}
                </a>
            </div>

            <div class="mt-10 sm:mt-16 text-white/50 text-xs sm:text-sm space-y-1 animate-credits">
                <p>{{ __('welcome.developed_by') }}</p>
                <p>{{ __('welcome.credits') }}</p>
            </div>
        </div>
    </div>
</x-layout>
