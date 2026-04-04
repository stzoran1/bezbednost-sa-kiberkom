<?php

use App\Models\GameScore;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

new
#[Layout('layouts.app')]
class extends Component
{
    #[Validate('required|min:2|max:30')]
    public string $playerName = '';

    public bool $started = false;

    public int $current = 0;

    public int $score = 0;

    public ?bool $lastCorrect = null;

    public string $feedbackMessage = '';

    public bool $finished = false;

    public bool $showLeaderboard = false;

    public string $resetPassword = '';

    public bool $showResetForm = false;

    public ?string $resetError = null;

    public bool $resetSuccess = false;

    public array $activeScenarios = [];

    public int $questionsPerGame = 10;

    public ?float $startedAtTimestamp = null;

    public int $finalTimeSeconds = 0;

    public function title(): string
    {
        return __('game.title');
    }

    public function messages(): array
    {
        return [
            'playerName.required' => __('game.validation.player_name_required'),
            'playerName.min' => __('game.validation.player_name_min'),
            'playerName.max' => __('game.validation.player_name_max'),
        ];
    }

    public function startGame(): void
    {
        $this->validate();

        $scenarios = __('game.scenarios');
        shuffle($scenarios);
        $this->activeScenarios = array_slice($scenarios, 0, $this->questionsPerGame);

        $this->started = true;
        $this->current = 0;
        $this->score = 0;
        $this->lastCorrect = null;
        $this->feedbackMessage = '';
        $this->finished = false;
        $this->showLeaderboard = false;
        $this->startedAtTimestamp = microtime(true);
        $this->finalTimeSeconds = 0;
    }

    public function answer(bool $choice): void
    {
        $scenario = $this->activeScenarios[$this->current];
        $this->lastCorrect = $choice === $scenario['answer'];

        if ($this->lastCorrect) {
            $this->score++;
        }

        $this->feedbackMessage = $scenario['explanation'];
    }

    public function next(): void
    {
        $this->current++;
        $this->lastCorrect = null;
        $this->feedbackMessage = '';

        if ($this->current >= count($this->activeScenarios)) {
            $this->finalTimeSeconds = (int) round(microtime(true) - $this->startedAtTimestamp);
            $this->finished = true;

            GameScore::create([
                'player_name' => $this->playerName,
                'score' => $this->score,
                'total_questions' => count($this->activeScenarios),
                'time_seconds' => $this->finalTimeSeconds,
            ]);

        }
    }

    public function toggleLeaderboard(): void
    {
        $this->showLeaderboard = ! $this->showLeaderboard;
    }

    public function playAgain(): void
    {
        $scenarios = __('game.scenarios');
        shuffle($scenarios);
        $this->activeScenarios = array_slice($scenarios, 0, $this->questionsPerGame);

        $this->current = 0;
        $this->score = 0;
        $this->lastCorrect = null;
        $this->feedbackMessage = '';
        $this->finished = false;
        $this->showLeaderboard = false;
        $this->startedAtTimestamp = microtime(true);
        $this->finalTimeSeconds = 0;
    }

    public function newPlayer(): void
    {
        $this->playerName = '';
        $this->started = false;
        $this->current = 0;
        $this->score = 0;
        $this->lastCorrect = null;
        $this->feedbackMessage = '';
        $this->finished = false;
        $this->showLeaderboard = false;
        $this->activeScenarios = [];
        $this->startedAtTimestamp = null;
        $this->finalTimeSeconds = 0;
    }

    public function resetLeaderboard(): void
    {
        if ($this->resetPassword !== '2604') {
            $this->resetError = __('game.leaderboard.reset_error');

            return;
        }

        GameScore::truncate();

        $this->resetPassword = '';
        $this->showResetForm = false;
        $this->resetError = null;
        $this->resetSuccess = true;
    }

    public function getLeaderboardProperty(): \Illuminate\Support\Collection
    {
        return GameScore::orderByDesc('score')
            ->orderBy('time_seconds')
            ->limit(10)
            ->get();
    }
};
?>

@php
    $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
@endphp

<div
    class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-500 to-cyan-400 flex items-center justify-center p-4"
    x-data="{
        startedAt: null,
        running: false,
        elapsed: 0,
        interval: null,
        formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
        },
        startTimer() {
            this.startedAt = Date.now();
            this.elapsed = 0;
            this.running = true;
            if (this.interval) clearInterval(this.interval);
            this.interval = setInterval(() => {
                if (this.running) {
                    this.elapsed = Math.floor((Date.now() - this.startedAt) / 1000);
                }
            }, 250);
        },
        stopTimer() {
            this.running = false;
            if (this.interval) { clearInterval(this.interval); this.interval = null; }
        }
    }"
    x-effect="
        if ($wire.started && !$wire.finished && !running) { startTimer(); }
        if ($wire.finished && running) { stopTimer(); }
        if (!$wire.started && running) { stopTimer(); }
    "
>
    <div class="max-w-2xl w-full">

        {{-- Home Button --}}
        <a href="{{ $localePrefix }}/" style="position:fixed;top:3rem;right:1rem;z-index:9999;padding:0.5rem 1rem;background:rgba(255,255,255,0.25);color:#fff;font-size:0.875rem;font-weight:600;border-radius:9999px;text-decoration:none;backdrop-filter:blur(8px);transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.45)'" onmouseout="this.style.background='rgba(255,255,255,0.25)'" title="{{ __('game.home_title') }}">
            &#8962; {{ __('game.home') }}
        </a>

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg">
                {{ __('game.heading') }}
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 mt-2">{{ __('game.subheading') }}</p>
        </div>

        @if (! $started)
            {{-- Start Screen — Player Name Input --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 text-center animate-fade-in-up">
                <x-mascot variant="default" class="w-36 h-36 mx-auto mb-6" />

                <h2 class="text-2xl md:text-3xl font-extrabold text-purple-700 mb-2">
                    {{ __('game.start.welcome') }}
                </h2>
                <p class="text-lg md:text-xl text-gray-600 mb-8">
                    {{ __('game.start.instructions') }}
                </p>

                <form wire:submit="startGame" class="space-y-6">
                    <div>
                        <input
                            wire:model="playerName"
                            type="text"
                            placeholder="{{ __('game.start.placeholder') }}"
                            class="w-full text-xl md:text-2xl text-center font-bold px-6 py-4 rounded-2xl border-2 border-purple-300 focus:border-purple-500 focus:ring-4 focus:ring-purple-200 outline-none transition-all"
                            autofocus
                        >
                        @error('playerName')
                            <p class="text-red-500 text-base mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full px-8 py-5 bg-purple-600 text-white text-2xl font-bold rounded-2xl hover:bg-purple-700 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        {{ __('game.start.button') }}
                    </button>
                </form>

                <div class="mt-6">
                    <button
                        wire:click="toggleLeaderboard"
                        class="text-purple-600 hover:text-purple-800 font-semibold text-lg underline transition-colors"
                    >
                        @if ($showLeaderboard)
                            {{ __('game.hide_leaderboard') }}
                        @else
                            {{ __('game.show_leaderboard') }}
                        @endif
                    </button>
                </div>

                @if ($showLeaderboard)
                    <div class="mt-6 animate-fade-in-up">
                        @include('pages.igra._leaderboard', ['scores' => $this->leaderboard])
                    </div>
                @endif
            </div>

        @elseif ($finished)
            {{-- Final Results Screen --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 text-center animate-fade-in-up">
                <div class="animate-bounce-in">
                    <x-mascot variant="thumbsup" class="w-40 h-40 mx-auto mb-4" />
                </div>

                <h2 class="text-3xl font-extrabold text-purple-700 mb-2">
                    {{ __('game.results.bravo', ['name' => $playerName]) }}
                </h2>

                <p class="text-2xl font-bold text-gray-700 mb-2">
                    {{ __('game.results.score') }} <span class="text-green-600">{{ $score }}</span> / {{ count($activeScenarios) }}
                </p>

                <p class="text-lg text-gray-500 mb-4">
                    {{ __('game.results.time') }} {{ floor($finalTimeSeconds / 60) }}:{{ str_pad($finalTimeSeconds % 60, 2, '0', STR_PAD_LEFT) }}
                </p>

                @if ($score === count($activeScenarios))
                    <p class="text-xl text-green-600 font-semibold mb-6">
                        {{ __('game.results.perfect') }}
                    </p>
                @elseif ($score >= count($activeScenarios) * 0.7)
                    <p class="text-xl text-blue-600 font-semibold mb-6">
                        {{ __('game.results.good') }}
                    </p>
                @else
                    <p class="text-xl text-orange-600 font-semibold mb-6">
                        {{ __('game.results.low') }}
                    </p>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-6">
                    <button
                        wire:click="playAgain"
                        class="px-8 py-4 bg-purple-600 text-white text-xl font-bold rounded-full hover:bg-purple-700 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        {{ __('game.results.play_again') }}
                    </button>
                    <button
                        wire:click="newPlayer"
                        class="px-8 py-4 bg-cyan-500 text-white text-xl font-bold rounded-full hover:bg-cyan-600 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        {{ __('game.results.new_player') }}
                    </button>
                    <a
                        href="{{ $localePrefix }}/"
                        class="px-8 py-4 bg-gray-400 text-white text-xl font-bold rounded-full hover:bg-gray-500 hover:scale-105 transition-all duration-200 shadow-lg text-center"
                    >
                        {{ __('game.results.home') }}
                    </a>
                </div>

                {{-- Leaderboard --}}
                <div class="mt-4">
                    <button
                        wire:click="toggleLeaderboard"
                        class="text-purple-600 hover:text-purple-800 font-semibold text-lg underline transition-colors"
                    >
                        @if ($showLeaderboard)
                            {{ __('game.hide_leaderboard') }}
                        @else
                            {{ __('game.show_leaderboard') }}
                        @endif
                    </button>
                </div>

                @if ($showLeaderboard)
                    <div class="mt-6 animate-fade-in-up">
                        @include('pages.igra._leaderboard', ['scores' => $this->leaderboard])
                    </div>
                @endif
            </div>

        @elseif ($lastCorrect !== null)
            {{-- Feedback Screen --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 text-center animate-fade-in-up">
                @if ($lastCorrect)
                    <div class="animate-bounce-in">
                        <x-mascot variant="thumbsup" class="w-32 h-32 mx-auto mb-4" />
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-green-600 mb-3">
                        {{ __('game.feedback.correct') }}
                    </h2>
                @else
                    <div class="animate-bounce-in">
                        <x-mascot variant="warning" class="w-32 h-32 mx-auto mb-4" />
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-orange-500 mb-3">
                        {{ __('game.feedback.incorrect') }}
                    </h2>
                @endif

                <p class="text-xl md:text-2xl text-gray-700 mb-6 leading-relaxed">
                    {{ $feedbackMessage }}
                </p>

                <button
                    wire:click="next"
                    class="px-8 py-4 bg-blue-500 text-white text-xl font-bold rounded-full hover:bg-blue-600 hover:scale-105 transition-all duration-200 shadow-lg"
                >
                    @if ($current + 1 >= count($activeScenarios))
                        {{ __('game.feedback.view_result') }}
                    @else
                        {{ __('game.feedback.next_question') }}
                    @endif
                </button>
            </div>

        @else
            {{-- Question Screen --}}
            <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 animate-fade-in-up">
                {{-- Progress + Timer --}}
                <div class="flex justify-between items-center mb-4">
                    <span class="text-base md:text-lg font-semibold text-purple-600">
                        {{ __('game.question.progress', ['current' => $current + 1, 'total' => count($activeScenarios)]) }}
                    </span>
                    <span
                        class="text-base md:text-lg font-mono font-bold text-purple-700 bg-purple-100 px-3 py-1 rounded-full"
                        x-text="formatTime(elapsed)"
                    >00:00</span>
                    <span class="text-base md:text-lg font-semibold text-green-600">
                        {{ __('game.question.points') }} {{ $score }}
                    </span>
                </div>
                <div class="w-full bg-purple-100 rounded-full h-4 mb-6">
                    <div
                        class="bg-purple-500 h-4 rounded-full transition-all duration-500"
                        style="width: {{ (($current) / count($activeScenarios)) * 100 }}%"
                    ></div>
                </div>

                {{-- Mascot --}}
                <div class="text-center mb-4">
                    <x-mascot variant="default" class="w-24 h-24 mx-auto" />
                </div>

                {{-- Scenario --}}
                <p class="text-xl md:text-2xl font-bold text-gray-800 text-center mb-8 leading-relaxed">
                    {{ $activeScenarios[$current]['text'] }}
                </p>

                {{-- Answer Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        wire:click="answer(true)"
                        class="flex-1 flex items-center justify-center gap-3 px-8 py-6 bg-green-500 text-white text-2xl font-extrabold rounded-2xl hover:bg-green-600 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        <span class="text-4xl">&#128077;</span> {{ __('game.question.good') }}
                    </button>
                    <button
                        wire:click="answer(false)"
                        class="flex-1 flex items-center justify-center gap-3 px-8 py-6 bg-red-500 text-white text-2xl font-extrabold rounded-2xl hover:bg-red-600 hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        <span class="text-4xl">&#128078;</span> {{ __('game.question.bad') }}
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
