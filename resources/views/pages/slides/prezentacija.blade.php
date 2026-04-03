<?php

use Livewire\Component;

new class extends Component {
    //
}; ?>

<x-slidewire::deck theme="aurora">
    {{-- Slide 1: Title slide --}}
    <x-slidewire::slide>
        <div class="flex flex-col items-center justify-center h-full space-y-10">
            <x-mascot variant="default" class="w-44 h-44" />
            <h1 class="text-8xl font-bold text-white leading-tight">Digitalna bezbednost sa Kiberkom</h1>
            <p class="text-4xl text-cyan-50">Naučimo zajedno kako da budemo bezbedni na internetu!</p>
        </div>
    </x-slidewire::slide>

    {{-- Slide 2: Šta je internet? --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="default" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Šta je internet?</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-10">
                <p class="text-4xl text-white">
                    Internet je kao jedno veliko <strong class="text-yellow-300">digitalno igralište</strong> gde ljudi iz celog sveta mogu da se igraju, uče i razgovaraju! 🌍
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-10">
                <p class="text-4xl text-white">
                    Možemo da gledamo crtane filmove, igramo igrice i učimo nove stvari.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2">
                <p class="text-4xl text-white">
                    Ali, baš kao i na pravom igralištu, moramo da znamo <strong class="text-yellow-300">pravila bezbednosti</strong>!
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 3: Lični podaci su tajna --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="warning" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Lični podaci su tajna!</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-8">
                <p class="text-4xl text-white">Nikada ne deli sa nepoznatim osobama na internetu:</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-6">
                <p class="text-4xl text-red-300">&#10060; Tvoje <strong>ime i prezime</strong></p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-6">
                <p class="text-4xl text-red-300">&#10060; Gde <strong>živiš</strong> (adresu)</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-6">
                <p class="text-4xl text-red-300">&#10060; U koju <strong>školu</strong> ideš</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4" class="mb-6">
                <p class="text-4xl text-red-300">&#10060; Broj <strong>telefona</strong></p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="5" class="mb-6">
                <p class="text-4xl text-red-300">&#10060; Tvoje <strong>fotografije</strong></p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="6" class="mb-8">
                <p class="text-4xl text-red-300">&#10060; Fotografije tvoje <strong>porodice</strong></p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="7">
                <p class="text-3xl text-yellow-300 font-bold">Tvoji lični podaci su samo za tebe i tvoju porodicu!</p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 4: Lozinke su ključevi --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="thumbsup" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Lozinke su ključevi!</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-10">
                <p class="text-4xl text-white">
                    Zamisli da je tvoja lozinka kao <strong class="text-yellow-300">ključ od tvoje kuće</strong>. 🔑
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-10">
                <p class="text-4xl text-white">
                    Da li bi dao ključ od kuće nekom koga ne poznaješ? <strong class="text-red-300">Naravno da ne!</strong>
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-10">
                <p class="text-4xl text-white">
                    Isto tako, svoju lozinku <strong class="text-yellow-300">nikada ne deli</strong> ni sa kim osim sa roditeljima.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3">
                <p class="text-4xl text-white">
                    Dobra lozinka je kao jak katanac — neka bude <strong class="text-lime-300">duga i tajna</strong>! 🔒
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 5: Društvene mreže --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="warning" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Društvene mreže</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-10">
                <p class="text-4xl text-white">
                    Društvene mreže su mesta na internetu gde ljudi dele slike, poruke i priče.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-10">
                <p class="text-4xl text-white">
                    Ali pažnja! Na internetu <strong class="text-red-300">svako može da se pretvara da je neko drugi</strong>.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-10">
                <p class="text-4xl text-white">
                    Neko ko kaže da je dete može zapravo biti <strong class="text-red-300">odrasla osoba</strong> koja se predstavlja lažno.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3">
                <p class="text-3xl text-yellow-300 font-bold">
                    Nikada ne veruj nepoznatim osobama na internetu, čak i ako deluju prijateljski!
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 6: Online igre i razgovori --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="warning" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Online igre i razgovori</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-10">
                <p class="text-4xl text-white">
                    Mnoge igrice imaju <strong class="text-yellow-300">chat</strong> gde možeš da pričaš sa drugim igračima.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-10">
                <p class="text-4xl text-white">
                    Budi oprezan! <strong class="text-red-300">Ne deli lične podatke</strong> u chatu igrica.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-10">
                <p class="text-4xl text-red-300 font-bold">
                    &#9888; Nikada se ne nalazi uživo sa nekim koga si upoznao na internetu!
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3">
                <p class="text-4xl text-white">
                    Ako želiš da se vidiš sa online prijateljem, <strong class="text-yellow-300">uvek povedi roditelja</strong> sa sobom.
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 7: Prepoznaj opasnost --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="warning" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Prepoznaj opasnost</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-8">
                <p class="text-4xl text-white">Obrati pažnju ako neko na internetu:</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-6">
                <p class="text-4xl text-red-300">&#9888; Traži od tebe da pošalješ <strong>svoju sliku</strong></p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-6">
                <p class="text-4xl text-red-300">&#9888; Pita te <strong>gde živiš</strong> ili u koju školu ideš</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-6">
                <p class="text-4xl text-red-300">&#9888; Kaže ti da <strong>čuvaš tajnu</strong> od roditelja</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4" class="mb-8">
                <p class="text-4xl text-red-300">&#9888; Želi da se <strong>nađete nasamo</strong></p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="5">
                <p class="text-3xl text-yellow-300 font-bold">
                    Ovo su znakovi upozorenja — odmah reci odrasloj osobi!
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 8: Šta raditi? --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="thumbsup" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Šta raditi?</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-10">
                <p class="text-4xl text-lime-300 font-bold">
                    &#9989; Uvek reci roditelju, učitelju ili odrasloj osobi od poverenja!
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-10">
                <p class="text-4xl text-white">
                    Ako te nešto na internetu uplaši ili ti bude neprijatno — <strong class="text-yellow-300">to nije tvoja krivica</strong>.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-10">
                <p class="text-4xl text-white">
                    <strong class="text-lime-300">Nećeš biti u nevolji</strong> ako pričaš o tome sa odraslima.
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-10">
                <p class="text-4xl text-white">
                    Odrasli su tu da te <strong class="text-yellow-300">zaštite</strong> i pomognu ti!
                </p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4">
                <p class="text-4xl text-lime-300 font-bold">
                    Zapamti: ti si hrabar/hrabra kad tražiš pomoć! 💪
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 9: Kiberkov savet — recap of the 4 golden rules --}}
    <x-slidewire::slide>
        <div class="mx-auto max-w-6xl">
            <div class="flex items-center gap-5 mb-14">
                <x-mascot variant="default" class="w-32 h-32" />
                <h2 class="text-6xl font-bold text-white">Kiberkov savet</h2>
            </div>

            <x-slidewire::fragment :index="0" class="mb-8">
                <p class="text-4xl text-white">Zapamti ova <strong class="text-yellow-300">4 zlatna pravila</strong>:</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="1" class="mb-6">
                <p class="text-4xl text-lime-300">&#9989; <strong>Ne deli lične podatke</strong> sa nepoznatim osobama</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="2" class="mb-6">
                <p class="text-4xl text-lime-300">&#9989; <strong>Čuvaj lozinke u tajnosti</strong> — deli ih samo sa roditeljima</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="3" class="mb-6">
                <p class="text-4xl text-lime-300">&#9989; <strong>Reci odrasloj osobi</strong> ako te nešto uplaši ili bude neprijatno</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="4" class="mb-8">
                <p class="text-4xl text-lime-300">&#9989; <strong>Budi ljubazan na internetu</strong> — reci lepe reči, ne ružne</p>
            </x-slidewire::fragment>

            <x-slidewire::fragment :index="5">
                <p class="text-3xl text-yellow-300 font-bold">
                    Sa ovim pravilima, internet će biti zabavno i bezbedno mesto!
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>

    {{-- Slide 10: Hvala! — thank you with mascot and game teaser --}}
    <x-slidewire::slide>
        <div class="flex flex-col items-center justify-center h-full space-y-10">
            <x-mascot variant="default" class="w-52 h-52" />
            <h1 class="text-8xl font-bold text-white">Hvala!</h1>
            <p class="text-4xl text-cyan-50">
                Kiberko je ponosan na vas što ste naučili kako da budete bezbedni na internetu!
            </p>
            <x-slidewire::fragment :index="0">
                <p class="text-5xl text-yellow-300 font-bold">
                    A sada... vreme je za igru! 🎮
                </p>
            </x-slidewire::fragment>
        </div>
    </x-slidewire::slide>
</x-slidewire::deck>
