<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kiberkov flajer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/flajer.js'])
    <style>
        @media print {
            @page { margin: 0; size: A4; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100">

{{-- Toolbar --}}
<div class="no-print sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-200 py-3 px-6 flex items-center justify-between">
    <a href="/" class="inline-flex items-center gap-2 text-gray-700 hover:text-gray-900 font-semibold transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
        Nazad na početnu
    </a>
    <button
        id="download-pdf"
        class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl shadow hover:shadow-md transition-all"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        Skini PDF
    </button>
</div>

{{-- Flyer content --}}
<div id="flajer" class="w-[210mm] min-h-[297mm] mx-auto my-8 print:my-0 bg-gradient-to-b from-teal-600 via-cyan-500 to-sky-600 p-8 print:p-8 shadow-2xl print:shadow-none">

    {{-- Header --}}
    <div class="text-center mb-6">
        <x-mascot variant="default" class="w-28 h-28 mx-auto mb-3" />
        <h1 class="text-4xl font-extrabold text-white tracking-tight">
            Kiberkov vodič za bezbednost
        </h1>
        <p class="text-lg text-white mt-1">Saveti za pametne i bezbedne korisnike interneta</p>
    </div>

    {{-- 4 Golden Rules --}}
    <div class="bg-white rounded-2xl p-6 mb-4 border border-white/50">
        <h2 class="text-center text-xl font-bold text-teal-700 mb-5 pb-3 border-b-2 border-teal-200">
            &#11088; 4 zlatna pravila &#11088;
        </h2>

        <div class="grid grid-cols-2 gap-4">
            {{-- Rule 1 --}}
            <div class="flex gap-3 items-start rounded-xl p-4 border border-gray-300">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg">1</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm leading-tight">Ne deli lične podatke sa nepoznatim osobama</h3>
                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">Tvoje ime, adresa, škola i broj telefona su samo za tebe i tvoju porodicu.</p>
                </div>
            </div>

            {{-- Rule 2 --}}
            <div class="flex gap-3 items-start rounded-xl p-4 border border-gray-300">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg">2</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm leading-tight">Čuvaj lozinke u tajnosti</h3>
                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">Lozinka je kao ključ od tvoje kuće. Deli je samo sa roditeljima. Neka bude duga i tajna!</p>
                </div>
            </div>

            {{-- Rule 3 --}}
            <div class="flex gap-3 items-start rounded-xl p-4 border border-gray-300">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg">3</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm leading-tight">Reci odrasloj osobi ako te nešto uplaši</h3>
                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">To nije tvoja krivica. Nećeš biti u nevolji ako pričaš o tome sa odraslima.</p>
                </div>
            </div>

            {{-- Rule 4 --}}
            <div class="flex gap-3 items-start rounded-xl p-4 border border-gray-300">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg">4</div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm leading-tight">Budi ljubazan na internetu</h3>
                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">Reci lepe reči, ne ružne. Budi prema drugima onakav kakav želiš da drugi budu prema tebi.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Two columns: Danger + Action --}}
    <div class="grid grid-cols-2 gap-4 mb-4">

        {{-- Danger Box --}}
        <div class="bg-white rounded-2xl p-5 border border-white/50 border-l-4 border-l-red-500">
            <div class="flex items-center gap-2 mb-3">
                <x-mascot variant="warning" class="w-12 h-12" />
                <h2 class="text-lg font-bold text-red-600">Prepoznaj opasnost!</h2>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-700 flex items-start gap-1.5">
                    <span class="text-red-500 font-bold text-sm leading-none mt-px">&#10007;</span>
                    Neko traži od tebe da pošalješ svoju sliku
                </p>
                <p class="text-xs text-gray-700 flex items-start gap-1.5">
                    <span class="text-red-500 font-bold text-sm leading-none mt-px">&#10007;</span>
                    Neko te pita gde živiš ili u koju školu ideš
                </p>
                <p class="text-xs text-gray-700 flex items-start gap-1.5">
                    <span class="text-red-500 font-bold text-sm leading-none mt-px">&#10007;</span>
                    Neko ti kaže da čuvaš tajnu od roditelja
                </p>
                <p class="text-xs text-gray-700 flex items-start gap-1.5">
                    <span class="text-red-500 font-bold text-sm leading-none mt-px">&#10007;</span>
                    Neko želi da se nađete nasamo
                </p>
                <p class="text-xs text-red-600 font-bold flex items-start gap-1.5 mt-2 pt-2 border-t border-red-200">
                    <span class="text-sm leading-none mt-px">&#10007;</span>
                    Nikada se ne nalazi uživo sa nekim koga si upoznao na internetu!
                </p>
            </div>
        </div>

        {{-- Action Box --}}
        <div class="bg-white rounded-2xl p-5 border border-white/50 border-l-4 border-l-emerald-500">
            <div class="flex items-center gap-2 mb-3">
                <x-mascot variant="thumbsup" class="w-12 h-12" />
                <h2 class="text-lg font-bold text-emerald-600">Šta da radiš?</h2>
            </div>
            <div class="space-y-3">
                <p class="text-sm text-gray-700 leading-relaxed">
                    Uvek reci <strong class="text-emerald-600">roditelju, učitelju ili odrasloj osobi od poverenja</strong>.
                </p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Odrasli su tu da te <strong class="text-emerald-600">zaštite</strong> i pomognu ti.
                </p>
                <div class="bg-emerald-100 rounded-xl p-3 mt-2">
                    <p class="text-sm text-emerald-800 font-bold text-center">
                        Zapamti: ti si hrabar/hrabra kad tražiš pomoć! &#x1F4AA;
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-4">
        <p class="text-xl font-extrabold text-yellow-200">
            Sa ovim pravilima, internet će biti zabavno i bezbedno mesto!
        </p>
        <p class="text-sm text-white mt-1">Kiberko &#8212; Tvoj vodič za digitalni svet</p>
    </div>
</div>

</body>
</html>
