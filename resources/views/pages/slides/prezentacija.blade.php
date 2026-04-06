<?php

use Livewire\Component;

new class extends Component {
    //
}; ?>

<x-slidewire::deck theme="aurora">
    {{-- Slide 1: Title slide --}}
    <x-slidewire::slide>
        <div class="flex flex-col items-center justify-center h-full space-y-4 md:space-y-10">
            <x-mascot variant="default" class="w-24 h-24 md:w-44 md:h-44" />
            <h1 class="text-3xl md:text-8xl font-bold text-white leading-tight text-center">{!! __('presentation.slide1.title') !!}</h1>
            <p class="text-lg md:text-4xl text-cyan-50 text-center">{!! __('presentation.slide1.subtitle') !!}</p>
        </div>
    </x-slidewire::slide>

    {{-- Slide 2: Šta je internet? --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-5 mb-6 md:mb-14">
                <x-mascot variant="default" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide2.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide2.paragraph1') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide2.paragraph2') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide2.paragraph3') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 3: Lični podaci su tajna --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-5 mb-6 md:mb-14">
                <x-mascot variant="warning" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide3.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-4 md:mb-8">
                <p class="text-lg md:text-4xl text-white">{!! __('presentation.slide3.intro') !!}</p>
            </x-slidewire::fragment>

            @foreach(__('presentation.slide3.items') as $index => $item)
            <x-slidewire::fragment :index="$index + 1" class="mb-3 md:mb-6">
                <p class="text-lg md:text-4xl text-red-300">{!! $item !!}</p>
            </x-slidewire::fragment>
            @endforeach

            <x-slidewire::fragment :index="7">
                <p class="text-base md:text-3xl text-yellow-300 font-bold">{!! __('presentation.slide3.conclusion') !!}</p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 4: Lozinke su ključevi --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-5 mb-6 md:mb-14">
                <x-mascot variant="thumbsup" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide4.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide4.paragraph1') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide4.paragraph2') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-red-300 font-bold animate-scale-up-shake">
                    {!! __('presentation.slide4.paragraph3') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide4.paragraph4') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide4.paragraph5') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="5">
                <p class="text-base md:text-3xl text-yellow-300 font-bold mb-2 md:mb-4">{!! __('presentation.slide4.tips_title') !!}</p>
                <p class="text-base md:text-3xl text-white mb-2 md:mb-3">{!! __('presentation.slide4.tips_bad') !!}</p>
                <p class="text-base md:text-3xl text-white">{!! __('presentation.slide4.tips_good') !!}</p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 5: Društvene mreže --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-5 mb-6 md:mb-14">
                <x-mascot variant="warning" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide5.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-4 md:mb-8">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide5.paragraph1') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-4 md:mb-8">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide5.paragraph2') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-4 md:mb-8">
                <p class="text-base md:text-3xl text-white text-center">
                    {!! __('presentation.slide5.paragraph3') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-4 md:mb-8">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide5.paragraph4') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4">
                <p class="text-base md:text-3xl text-yellow-300 font-bold">
                    {!! __('presentation.slide5.conclusion') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 6: Online igre i razgovori --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-5 mb-6 md:mb-14">
                <x-mascot variant="warning" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide6.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide6.paragraph1') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide6.paragraph2') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-4 md:mb-10">
                <p class="text-lg md:text-4xl text-red-300 font-bold">
                    {!! __('presentation.slide6.paragraph3') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3">
                <p class="text-lg md:text-4xl text-white">
                    {!! __('presentation.slide6.paragraph4') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 7: Prepoznaj opasnost (deo 1) --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center gap-3 md:gap-5 mb-5 md:mb-10">
                <x-mascot variant="warning" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide7.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide7.intro') !!}
                </p>
            </x-slidewire::fragment>

            @foreach(__('presentation.slide7.items') as $index => $item)
            <x-slidewire::fragment :index="$index + 1" class="mb-3 md:mb-5">
                <p class="text-base md:text-3xl text-red-300 slide-attention">{!! $item !!}</p>
            </x-slidewire::fragment>
            @endforeach

            <x-slidewire::fragment :index="5">
                <p class="text-base md:text-3xl text-yellow-300 font-bold">
                    {!! __('presentation.slide7.conclusion') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 8: Prepoznaj opasnost (deo 2) --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center gap-3 md:gap-5 mb-5 md:mb-10">
                <x-mascot variant="warning" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide8.title') !!}</h2>
            </div>

            @foreach(__('presentation.slide8.items') as $index => $item)
            <x-slidewire::fragment :index="$index" class="mb-3 md:mb-5">
                <p class="text-base md:text-3xl text-red-300 slide-attention">{!! $item !!}</p>
            </x-slidewire::fragment>
            @endforeach

            <x-slidewire::fragment :index="4">
                <p class="text-base md:text-3xl text-yellow-300 font-bold">
                    {!! __('presentation.slide8.conclusion') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 9: Šta raditi? --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center gap-3 md:gap-5 mb-5 md:mb-10">
                <x-mascot variant="thumbsup" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide9.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-lime-300 font-bold">
                    {!! __('presentation.slide9.paragraph1') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph2') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph3') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph4') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph5') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="5" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph6') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="6" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph7') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="7" class="mb-3 md:mb-6">
                <p class="text-base md:text-3xl text-white">
                    {!! __('presentation.slide9.paragraph8') !!}
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="8">
                <p class="text-base md:text-3xl text-lime-300 font-bold slide-highlight">
                    {!! __('presentation.slide9.paragraph9') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 10: Kiberkov savet — recap of the 4 golden rules --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-5 mb-6 md:mb-14">
                <x-mascot variant="default" class="w-20 h-20 md:w-32 md:h-32" />
                <h2 class="text-2xl md:text-6xl font-bold text-white text-center">{!! __('presentation.slide10.title') !!}</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-4 md:mb-8">
                <p class="text-lg md:text-4xl text-white">{!! __('presentation.slide10.intro') !!}</p>
            </x-slidewire::fragment>

            @foreach(__('presentation.slide10.rules') as $index => $rule)
            <x-slidewire::fragment :index="$index + 1" class="mb-3 md:mb-6">
                <p class="text-lg md:text-4xl text-lime-300 slide-highlight">{!! $rule !!}</p>
            </x-slidewire::fragment>
            @endforeach

            <x-slidewire::fragment :index="5">
                <p class="text-base md:text-3xl text-yellow-300 font-bold">
                    {!! __('presentation.slide10.conclusion') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 11: Hvala! — thank you with mascot and game teaser --}}
    <x-slidewire::slide>
        <div class="flex flex-col items-center justify-center h-full space-y-4 md:space-y-10">
            <x-mascot variant="default" class="w-28 h-28 md:w-52 md:h-52" />
            <h1 class="text-3xl md:text-8xl font-bold text-white">{!! __('presentation.slide11.title') !!}</h1>
            <p class="text-lg md:text-4xl text-cyan-50">
                {!! __('presentation.slide11.subtitle') !!}
            </p>
            <x-slidewire::fragment :index="0">
                <p class="text-xl md:text-5xl text-yellow-300 font-bold">
                    {!! __('presentation.slide11.game_teaser') !!}
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>
</x-slidewire::deck>
