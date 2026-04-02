<?php

use Livewire\Component;

new class extends Component {
    //
}; ?>

<x-slidewire::deck theme="aurora">
    {{-- Slide 1: Title slide --}}
    <x-slidewire::slide>
        <div class="flex flex-col items-center justify-center h-full space-y-6">
            <x-mascot variant="default" class="w-40 h-40" />
            <h1 class="text-5xl font-bold text-emerald-50">Digitalna bezbednost sa Kiberkom</h1>
            <p class="text-2xl text-cyan-200">Naucimo zajedno kako da budemo bezbedni na internetu!</p>
        </div>
    </x-slidewire::slide>

    {{-- Slide 2: Sta je internet? --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-4xl space-y-8">
            <div class="flex items-center gap-4">
                <x-mascot variant="default" class="w-24 h-24" />
                <h2 class="text-4xl font-bold text-emerald-50">Sta je internet?</h2>
            </div>

            <x-slidewire::fragment :index="1">
                <p class="text-2xl text-cyan-100">
                    Internet je kao jedno veliko <strong class="text-yellow-300">digitalno igraliste</strong> gde ljudi iz celog sveta mogu da se igraju, uce i razgovaraju! 🌍
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2">
                <p class="text-2xl text-cyan-100">
                    Mozemo da gledamo crtane filmove, igramo igrice i ucimo nove stvari.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3">
                <p class="text-2xl text-cyan-100">
                    Ali, bas kao i na pravom igralistu, moramo da znamo <strong class="text-yellow-300">pravila bezbednosti</strong>!
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 3: Licni podaci su tajna --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-4xl space-y-8">
            <div class="flex items-center gap-4">
                <x-mascot variant="warning" class="w-24 h-24" />
                <h2 class="text-4xl font-bold text-emerald-50">Licni podaci su tajna!</h2>
            </div>

            <x-slidewire::fragment :index="1">
                <p class="text-2xl text-cyan-100">Nikada ne deli sa nepoznatim osobama na internetu:</p>
            </x-slidewire::fragment>

            <div class="space-y-4 text-2xl">
                <x-slidewire::fragment :index="2">
                    <p class="text-red-300">&#10060; Tvoje <strong>ime i prezime</strong></p>
                </x-slidewire::fragment>

                <x-slidewire::fragment :index="3">
                    <p class="text-red-300">&#10060; Gde <strong>zivis</strong> (adresu)</p>
                </x-slidewire::fragment>

                <x-slidewire::fragment :index="4">
                    <p class="text-red-300">&#10060; U koju <strong>skolu</strong> ides</p>
                </x-slidewire::fragment>

                <x-slidewire::fragment :index="5">
                    <p class="text-red-300">&#10060; Broj <strong>telefona</strong></p>
                </x-slidewire::fragment>
            </div>

            <x-slidewire::fragment :index="6">
                <p class="text-xl text-yellow-300 font-bold">Tvoji licni podaci su samo za tebe i tvoju porodicu!</p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 4: Lozinke su kljucevi --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-4xl space-y-8">
            <div class="flex items-center gap-4">
                <x-mascot variant="thumbsup" class="w-24 h-24" />
                <h2 class="text-4xl font-bold text-emerald-50">Lozinke su kljucevi!</h2>
            </div>

            <x-slidewire::fragment :index="1">
                <p class="text-2xl text-cyan-100">
                    Zamisli da tvoja lozinka je kao <strong class="text-yellow-300">kljuc od tvoje kuce</strong>. 🔑
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2">
                <p class="text-2xl text-cyan-100">
                    Da li bi dao kljuc od kuce nekom koga nepoznajes? <strong class="text-red-300">Naravno da ne!</strong>
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3">
                <p class="text-2xl text-cyan-100">
                    Isto tako, svoju lozinku <strong class="text-yellow-300">nikada ne deli</strong> ni sa kim osim sa roditeljima.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4">
                <p class="text-2xl text-cyan-100">
                    Dobra lozinka je kao jak katanac — neka bude <strong class="text-emerald-300">duga i tajna</strong>! 🔒
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>
</x-slidewire::deck>
