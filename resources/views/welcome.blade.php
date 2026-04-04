@php
    $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
@endphp

<x-layout :title="__('welcome.title')">
    <div class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-500 to-cyan-400 flex items-center justify-center p-6">
        <div class="text-center max-w-3xl mx-auto">
            <x-mascot variant="default" class="w-48 h-48 mx-auto mb-8 drop-shadow-lg" />

            <h1 class="text-5xl md:text-7xl font-extrabold text-white drop-shadow-md mb-6 leading-tight">
                {{ __('welcome.title') }}
            </h1>

            <p class="text-2xl md:text-3xl text-white/90 mb-14 font-medium">
                {{ __('welcome.subtitle') }}
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ $localePrefix }}/prezentacija"
                   class="inline-block bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-extrabold text-2xl md:text-3xl px-12 py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                    {{ __('welcome.presentation') }}
                </a>

                <a href="{{ $localePrefix }}/igra"
                   class="inline-block bg-emerald-400 hover:bg-emerald-300 text-gray-900 font-extrabold text-2xl md:text-3xl px-12 py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                    {{ __('welcome.game') }}
                </a>

                <a href="{{ $localePrefix }}/flajer"
                   class="inline-block bg-white hover:bg-gray-100 text-gray-900 font-extrabold text-2xl md:text-3xl px-12 py-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                    {{ __('welcome.flyer') }}
                </a>
            </div>
        </div>
    </div>
</x-layout>
