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
        <a href="{{ $localePrefix }}/igra" style="position:fixed;top:1rem;right:1rem;z-index:9999;padding:0.5rem 1rem;background:rgba(255,255,255,0.25);color:#fff;font-size:0.875rem;font-weight:600;border-radius:9999px;text-decoration:none;backdrop-filter:blur(8px);transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.45)'" onmouseout="this.style.background='rgba(255,255,255,0.25)'" title="{{ __('game.title') }}">
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
        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 animate-fade-in-up">
            @include('pages.igra._leaderboard', ['scores' => $this->leaderboard])
        </div>
    </div>
</div>
