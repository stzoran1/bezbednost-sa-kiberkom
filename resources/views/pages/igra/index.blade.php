<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('layouts.app')]
#[Title('Dobro ili Lose? - Igra sa Kiberkom')]
class extends Component
{
    public int $current = 0;

    public int $score = 0;

    public ?bool $lastCorrect = null;

    public string $feedbackMessage = '';

    public bool $finished = false;

    public array $scenarios = [
        [
            'text' => 'Neko te pita za tvoju adresu na internetu',
            'answer' => false,
            'explanation' => 'Nikada ne deli svoju adresu sa nepoznatim osobama na internetu! To je licni podatak.',
        ],
        [
            'text' => 'Kazes mami da ti je neko poslao cudnu poruku',
            'answer' => true,
            'explanation' => 'Odlicno! Uvek reci odrasloj osobi ako dobijes cudnu poruku.',
        ],
        [
            'text' => 'Prihvatas zahtev za prijateljstvo od nepoznate osobe',
            'answer' => false,
            'explanation' => 'Ne prihvataj zahteve od nepoznatih osoba! Ne znamo ko se krije iza ekrana.',
        ],
        [
            'text' => 'Koristis jaku lozinku sa slovima i brojevima',
            'answer' => true,
            'explanation' => 'Super! Jake lozinke cuvaju tvoje naloge bezbednim.',
        ],
        [
            'text' => 'Saljes svoju fotografiju nepoznatoj osobi online',
            'answer' => false,
            'explanation' => 'Nikada ne salji svoje fotografije nepoznatim osobama! To nije bezbedno.',
        ],
        [
            'text' => 'Zatrazis dozvolu od roditelja pre nego sto skines novu aplikaciju',
            'answer' => true,
            'explanation' => 'Bravo! Uvek pitaj roditelje pre nego sto instaliras nesto novo.',
        ],
        [
            'text' => 'Delis svoju lozinku sa drugom iz skole',
            'answer' => false,
            'explanation' => 'Lozinka je kao kljuc od kuce — ne deli je ni sa kim osim sa roditeljima!',
        ],
        [
            'text' => 'Ljubazno se ponasas prema drugima u online igrama',
            'answer' => true,
            'explanation' => 'Fantasticno! Lepo ponasanje na internetu je jednako vazno kao i uzivo.',
        ],
        [
            'text' => 'Ides sam da se nadjes sa nekim koga si upoznao online',
            'answer' => false,
            'explanation' => 'Nikada se ne nalazi sam sa osobama sa interneta! Uvek idi sa roditeljem.',
        ],
        [
            'text' => 'Kada vidis nesto sto te uplasi na internetu, kazes odrasloj osobi',
            'answer' => true,
            'explanation' => 'Tacno! Odrasli su tu da ti pomognu i neces biti u nevolji.',
        ],
    ];

    public function answer(bool $choice): void
    {
        $scenario = $this->scenarios[$this->current];
        $this->lastCorrect = $choice === $scenario['answer'];

        if ($this->lastCorrect) {
            $this->score++;
            $this->feedbackMessage = $scenario['explanation'];
        } else {
            $this->feedbackMessage = $scenario['explanation'];
        }
    }

    public function next(): void
    {
        $this->current++;
        $this->lastCorrect = null;
        $this->feedbackMessage = '';

        if ($this->current >= count($this->scenarios)) {
            $this->finished = true;
        }
    }

    public function restart(): void
    {
        $this->current = 0;
        $this->score = 0;
        $this->lastCorrect = null;
        $this->feedbackMessage = '';
        $this->finished = false;
    }
};
?>

<div class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-500 to-cyan-400 flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg">
                Dobro ili Lose?
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 mt-2">Igra sa Kiberkom</p>
        </div>

        @if ($finished)
            {{-- Final Results Screen --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 text-center animate-fade-in-up">
                <x-mascot variant="thumbsup" class="w-40 h-40 mx-auto mb-4" />

                <h2 class="text-3xl font-extrabold text-purple-700 mb-2">
                    Bravo!
                </h2>

                <p class="text-2xl font-bold text-gray-700 mb-2">
                    Tvoj rezultat: <span class="text-green-600">{{ $score }}</span> / {{ count($scenarios) }}
                </p>

                @if ($score === count($scenarios))
                    <p class="text-xl text-green-600 font-semibold mb-6">
                        Savrseno! Ti si pravi internet heroj!
                    </p>
                @elseif ($score >= count($scenarios) * 0.7)
                    <p class="text-xl text-blue-600 font-semibold mb-6">
                        Odlicno! Znas mnogo o bezbednosti na internetu!
                    </p>
                @else
                    <p class="text-xl text-orange-600 font-semibold mb-6">
                        Dobar pocetak! Pogledaj prezentaciju da naucis jos vise!
                    </p>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        wire:click="restart"
                        class="px-8 py-4 bg-purple-600 text-white text-xl font-bold rounded-full hover:bg-purple-700 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        Igraj ponovo
                    </button>
                    <a
                        href="/"
                        class="px-8 py-4 bg-cyan-500 text-white text-xl font-bold rounded-full hover:bg-cyan-600 hover:scale-105 transition-all duration-200 shadow-lg text-center"
                    >
                        Pocetna strana
                    </a>
                </div>
            </div>

        @elseif ($lastCorrect !== null)
            {{-- Feedback Screen --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 text-center animate-fade-in-up">
                @if ($lastCorrect)
                    <div class="animate-bounce-in">
                        <x-mascot variant="thumbsup" class="w-32 h-32 mx-auto mb-4" />
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-green-600 mb-3">
                        Tacno!
                    </h2>
                @else
                    <div class="animate-bounce-in">
                        <x-mascot variant="warning" class="w-32 h-32 mx-auto mb-4" />
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-orange-500 mb-3">
                        Nije tacno, ali nema veze!
                    </h2>
                @endif

                <p class="text-xl md:text-2xl text-gray-700 mb-6 leading-relaxed">
                    {{ $feedbackMessage }}
                </p>

                <button
                    wire:click="next"
                    class="px-8 py-4 bg-blue-500 text-white text-xl font-bold rounded-full hover:bg-blue-600 hover:scale-105 transition-all duration-200 shadow-lg"
                >
                    @if ($current + 1 >= count($scenarios))
                        Pogledaj rezultat
                    @else
                        Sledece pitanje
                    @endif
                </button>
            </div>

        @else
            {{-- Question Screen --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 animate-fade-in-up">
                {{-- Progress --}}
                <div class="flex justify-between items-center mb-4">
                    <span class="text-base md:text-lg font-semibold text-purple-600">
                        Pitanje {{ $current + 1 }} od {{ count($scenarios) }}
                    </span>
                    <span class="text-base md:text-lg font-semibold text-green-600">
                        Poeni: {{ $score }}
                    </span>
                </div>
                <div class="w-full bg-purple-100 rounded-full h-4 mb-6">
                    <div
                        class="bg-purple-500 h-4 rounded-full transition-all duration-500"
                        style="width: {{ (($current) / count($scenarios)) * 100 }}%"
                    ></div>
                </div>

                {{-- Mascot --}}
                <div class="text-center mb-4">
                    <x-mascot variant="default" class="w-24 h-24 mx-auto" />
                </div>

                {{-- Scenario --}}
                <p class="text-xl md:text-2xl font-bold text-gray-800 text-center mb-8 leading-relaxed">
                    {{ $scenarios[$current]['text'] }}
                </p>

                {{-- Answer Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        wire:click="answer(true)"
                        class="flex-1 flex items-center justify-center gap-3 px-8 py-6 bg-green-500 text-white text-2xl font-extrabold rounded-2xl hover:bg-green-600 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        <span class="text-4xl">&#128077;</span> Dobro
                    </button>
                    <button
                        wire:click="answer(false)"
                        class="flex-1 flex items-center justify-center gap-3 px-8 py-6 bg-red-500 text-white text-2xl font-extrabold rounded-2xl hover:bg-red-600 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        <span class="text-4xl">&#128078;</span> Lose
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
