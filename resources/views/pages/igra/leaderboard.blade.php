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

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg">
                {{ __('game.leaderboard.title') }}
            </h1>
        </div>

        <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 animate-fade-in-up">
            @include('pages.igra._leaderboard', ['scores' => $this->leaderboard])
        </div>
    </div>
</div>
