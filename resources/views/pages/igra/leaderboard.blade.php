<?php

use App\Models\GameScore;
use Livewire\Attributes\Layout;
use Livewire\Component;

new
#[Layout('layouts.app')]
class extends Component
{
    public string $resetPassword = '';

    public bool $showResetForm = false;

    public ?string $resetError = null;

    public bool $resetSuccess = false;

    public function title(): string
    {
        return __('game.leaderboard.title');
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
            ->get();
    }
};
?>

@php
    $localePrefix = app()->getLocale() === config('app.fallback_locale') ? '' : '/' . app()->getLocale();
@endphp

<div class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-500 to-cyan-400 flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">

        {{-- Navigation --}}
        <a href="{{ $localePrefix }}/igra" class="fixed top-4 left-4 z-[9999] px-4 py-2 bg-white/25 text-white text-sm font-semibold rounded-full no-underline backdrop-blur-md transition-all duration-200 hover:bg-white/45" title="{{ __('game.title') }}">
            &#8962; {{ __('game.title') }}
        </a>

        {{-- Hero Section --}}
        <div class="text-center mb-8 animate-fade-in-up">
            <x-mascot variant="thumbsup" class="w-28 h-28 mx-auto mb-4 animate-bounce-in" />
            <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-lg animate-bounce-in">
                {{ __('game.leaderboard.title') }}
            </h1>
        </div>

        {{-- Podium Section --}}
        @php
            $topScores = $this->leaderboard->take(3);
            $podiumStyles = [
                0 => ['bg' => 'bg-yellow-50', 'border' => 'border-[#FFD700]', 'text' => 'text-yellow-700', 'medal' => '🥇', 'ring' => 'ring-[#FFD700]', 'order' => 'order-2', 'scale' => 'scale-105'],
                1 => ['bg' => 'bg-gray-50', 'border' => 'border-[#C0C0C0]', 'text' => 'text-gray-600', 'medal' => '🥈', 'ring' => 'ring-[#C0C0C0]', 'order' => 'order-1', 'scale' => ''],
                2 => ['bg' => 'bg-orange-50', 'border' => 'border-[#CD7F32]', 'text' => 'text-orange-700', 'medal' => '🥉', 'ring' => 'ring-[#CD7F32]', 'order' => 'order-3', 'scale' => ''],
            ];
        @endphp

        @if ($topScores->isNotEmpty())
            <div class="flex flex-col sm:flex-row items-end justify-center gap-4 mb-8" data-testid="podium">
                @foreach ($topScores as $i => $player)
                    @php $style = $podiumStyles[$i]; @endphp
                    <div
                        class="w-full sm:w-1/3 {{ $style['bg'] }} {{ $style['order'] }} {{ $style['scale'] }} border-2 {{ $style['border'] }} ring-2 {{ $style['ring'] }} rounded-2xl p-4 text-center shadow-lg animate-fade-in-up"
                        style="animation-delay: {{ $i * 0.15 }}s"
                    >
                        <span class="text-4xl inline-block animate-scale-up-shake" style="animation-delay: {{ 0.3 + $i * 0.15 }}s">
                            {{ $style['medal'] }}
                        </span>
                        <p class="text-lg font-extrabold {{ $style['text'] }} mt-2 truncate">{{ $player->player_name }}</p>
                        <p class="text-sm font-bold text-gray-600">
                            {{ $player->score }} / {{ $player->total_questions }}
                        </p>
                        <p class="text-xs text-gray-400 font-mono">
                            {{ floor($player->time_seconds / 60) }}:{{ str_pad($player->time_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Full Leaderboard Table --}}
        @php
            $allScores = $this->leaderboard;
        @endphp

        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-6 md:p-8 animate-fade-in-up" data-testid="leaderboard-table">
            <h2 class="text-xl md:text-2xl font-extrabold text-purple-700 mb-5 flex items-center gap-2">
                <span class="inline-block w-1.5 h-6 bg-gradient-to-b from-purple-500 to-cyan-400 rounded-full"></span>
                {{ __('game.leaderboard.title') }}
            </h2>

            @if ($allScores->isEmpty())
                <div class="text-center py-10" data-testid="empty-state">
                    <x-mascot variant="default" class="w-24 h-24 mx-auto mb-4 opacity-80" />
                    <p class="text-lg text-purple-400 font-semibold">{{ __('game.leaderboard.more_players_needed') }}</p>
                </div>
            @else
                <div class="overflow-x-auto -mx-6 md:-mx-8 px-6 md:px-8">
                    <table class="w-full text-left min-w-[500px]">
                        <thead>
                            <tr class="border-b-2 border-purple-200 bg-purple-50/50">
                                <th class="py-3 px-3 text-xs font-bold text-purple-500 uppercase tracking-wider">#</th>
                                <th class="py-3 px-3 text-xs font-bold text-purple-500 uppercase tracking-wider">{{ __('game.leaderboard.player') }}</th>
                                <th class="py-3 px-3 text-xs font-bold text-purple-500 uppercase tracking-wider text-right">{{ __('game.leaderboard.result') }}</th>
                                <th class="py-3 px-3 text-xs font-bold text-purple-500 uppercase tracking-wider text-right">{{ __('game.leaderboard.time') }}</th>
                                <th class="py-3 px-3 text-xs font-bold text-purple-500 uppercase tracking-wider text-right">{{ __('game.leaderboard.played_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allScores as $index => $entry)
                                @php
                                    $rank = $index + 1;
                                    $scoreRatio = $entry->total_questions > 0 ? $entry->score / $entry->total_questions : 0;
                                    $tierClass = match(true) {
                                        $scoreRatio >= 0.9 => 'border-l-4 border-l-green-400',
                                        $scoreRatio >= 0.7 => 'border-l-4 border-l-blue-400',
                                        $scoreRatio >= 0.5 => 'border-l-4 border-l-yellow-400',
                                        default => 'border-l-4 border-l-gray-200',
                                    };
                                @endphp
                                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-purple-50/40' }} {{ $tierClass }} hover:bg-purple-100/60 transition-colors duration-150" data-testid="score-row">
                                    <td class="py-3 px-3 text-sm font-bold text-purple-400">{{ $rank }}</td>
                                    <td class="py-3 px-3 text-sm font-semibold text-gray-800 truncate max-w-[160px]">{{ $entry->player_name }}</td>
                                    <td class="py-3 px-3 text-sm text-right">
                                        <span class="inline-flex items-center gap-1 font-bold {{ $scoreRatio >= 0.9 ? 'text-green-600' : ($scoreRatio >= 0.7 ? 'text-blue-600' : ($scoreRatio >= 0.5 ? 'text-yellow-600' : 'text-gray-500')) }}">
                                            {{ $entry->score }}<span class="text-gray-400 font-normal">/</span>{{ $entry->total_questions }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 text-sm text-right text-gray-500 font-mono">
                                        {{ floor($entry->time_seconds / 60) }}:{{ str_pad($entry->time_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="py-3 px-3 text-sm text-right text-gray-400 font-mono">
                                        {{ $entry->created_at->format('d.m.Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Reset Leaderboard --}}
            <div class="mt-6 pt-4 border-t border-purple-100">
                @if ($this->resetSuccess)
                    <p class="text-green-600 font-semibold text-base">{{ __('game.leaderboard.reset_success') }}</p>
                @elseif ($this->showResetForm)
                    <form wire:submit="resetLeaderboard" class="flex flex-col sm:flex-row items-center gap-2">
                        <input
                            wire:model="resetPassword"
                            type="password"
                            placeholder="{{ __('game.leaderboard.reset_placeholder') }}"
                            class="px-3 py-2 text-base rounded-lg border border-purple-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                        >
                        <button
                            type="submit"
                            class="px-4 py-2 bg-red-500 text-white text-base font-bold rounded-lg hover:bg-red-600 transition-colors"
                        >
                            {{ __('game.leaderboard.reset_confirm') }}
                        </button>
                        @if ($this->resetError)
                            <p class="text-red-500 text-sm font-semibold">{{ $this->resetError }}</p>
                        @endif
                    </form>
                @else
                    <button
                        wire:click="$set('showResetForm', true)"
                        class="text-red-500 hover:text-red-700 text-sm font-semibold underline transition-colors"
                    >
                        {{ __('game.leaderboard.reset_button') }}
                    </button>
                @endif
            </div>
        </div>

        {{-- Back to Game --}}
        <div class="text-center mt-6">
            <a
                href="{{ $localePrefix }}/igra"
                class="inline-block px-8 py-4 bg-purple-600 text-white text-xl font-bold rounded-full hover:bg-purple-700 hover:scale-105 transition-all duration-200 shadow-lg"
            >
                {{ __('game.back_to_game') }}
            </a>
        </div>
    </div>
</div>
