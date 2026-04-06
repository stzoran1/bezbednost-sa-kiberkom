@php
    $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
@endphp

<x-layout :title="__('welcome.title')">
    <div class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-500 to-cyan-400 flex items-center justify-center p-4 sm:p-6">
        <div class="text-center max-w-3xl mx-auto">
            <x-mascot variant="default" class="w-28 h-28 sm:w-36 sm:h-36 md:w-48 md:h-48 mx-auto mb-4 sm:mb-8 drop-shadow-lg animate-gentle-float" />

            <h1 class="text-3xl sm:text-5xl md:text-7xl font-extrabold text-white drop-shadow-md mb-3 sm:mb-6 leading-tight animate-fade-in-up animate-delay-200">
                {{ __('welcome.title') }}
            </h1>

            <p class="text-lg sm:text-2xl md:text-3xl text-white/90 mb-8 sm:mb-14 font-medium animate-fade-in-up animate-delay-400">
                {{ __('welcome.subtitle') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center">
                <a href="{{ $localePrefix }}/prezentacija"
                   class="inline-block bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-extrabold text-lg sm:text-2xl md:text-3xl px-6 py-3 sm:px-12 sm:py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 min-h-[44px] animate-fade-in-up animate-delay-600">
                    {{ __('welcome.presentation') }}
                </a>

                <a href="{{ $localePrefix }}/igra"
                   class="inline-block bg-emerald-400 hover:bg-emerald-300 text-gray-900 font-extrabold text-lg sm:text-2xl md:text-3xl px-6 py-3 sm:px-12 sm:py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 min-h-[44px] animate-fade-in-up animate-delay-800">
                    {{ __('welcome.game') }}
                </a>

                <a href="{{ $localePrefix }}/flajer"
                   class="inline-block bg-white hover:bg-gray-100 text-gray-900 font-extrabold text-lg sm:text-2xl md:text-3xl px-6 py-3 sm:px-12 sm:py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 min-h-[44px] animate-fade-in-up animate-delay-1000">
                    {{ __('welcome.flyer') }}
                </a>
            </div>
        </div>
    </div>
</x-layout>
