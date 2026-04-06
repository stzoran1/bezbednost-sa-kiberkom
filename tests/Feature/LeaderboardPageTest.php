<?php

use App\Models\GameScore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('leaderboard component shows all scores ordered by score desc then time asc', function () {
    GameScore::factory()->create(['player_name' => 'Brzi Tim', 'score' => 8, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Spori Tim', 'score' => 8, 'time_seconds' => 90]);
    GameScore::factory()->create(['player_name' => 'Najbolji Tim', 'score' => 10, 'time_seconds' => 45]);

    $component = Livewire::test('pages::igra.leaderboard');

    $html = $component->html();
    $bestPos = strpos($html, 'Najbolji Tim');
    $fastPos = strpos($html, 'Brzi Tim');
    $slowPos = strpos($html, 'Spori Tim');

    expect($bestPos)->toBeLessThan($fastPos);
    expect($fastPos)->toBeLessThan($slowPos);
});

test('leaderboard component shows all scores without limit', function () {
    GameScore::factory()->count(15)->create();

    $component = Livewire::test('pages::igra.leaderboard');

    $leaderboard = $component->instance()->leaderboard;

    expect($leaderboard)->toHaveCount(15);
});

test('leaderboard reset rejects wrong password', function () {
    GameScore::factory()->create(['player_name' => 'Tim A', 'score' => 10]);

    Livewire::test('pages::igra.leaderboard')
        ->set('showResetForm', true)
        ->set('resetPassword', '0000')
        ->call('resetLeaderboard')
        ->assertSet('resetError', __('game.leaderboard.reset_error'));

    expect(GameScore::count())->toBe(1);
});

test('leaderboard reset clears all scores with correct password', function () {
    GameScore::factory()->count(3)->create();

    expect(GameScore::count())->toBe(3);

    Livewire::test('pages::igra.leaderboard')
        ->set('showResetForm', true)
        ->set('resetPassword', '2604')
        ->call('resetLeaderboard')
        ->assertSet('resetSuccess', true);

    expect(GameScore::count())->toBe(0);
});

test('leaderboard component renders successfully', function () {
    Livewire::test('pages::igra.leaderboard')
        ->assertStatus(200);
});

test('leaderboard component has reset functionality', function () {
    Livewire::test('pages::igra.leaderboard')
        ->assertSet('resetPassword', '')
        ->assertSet('showResetForm', false)
        ->assertSet('resetError', null)
        ->assertSet('resetSuccess', false);
});

test('leaderboard hero section displays mascot and animated title', function () {
    Livewire::test('pages::igra.leaderboard')
        ->assertSeeHtml('mascot-thumbsup.svg')
        ->assertSeeHtml('animate-bounce-in');
});

test('leaderboard podium displays top 3 players with medal emojis', function () {
    GameScore::factory()->create(['player_name' => 'Gold Player', 'score' => 10, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Silver Player', 'score' => 8, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Bronze Player', 'score' => 6, 'time_seconds' => 30]);

    $component = Livewire::test('pages::igra.leaderboard');

    $html = $component->html();

    expect($html)
        ->toContain('data-testid="podium"')
        ->toContain('Gold Player')
        ->toContain('Silver Player')
        ->toContain('Bronze Player')
        ->toContain('🥇')
        ->toContain('🥈')
        ->toContain('🥉')
        ->toContain('animate-scale-up-shake');
});

test('leaderboard podium uses gold silver bronze border colors', function () {
    GameScore::factory()->create(['player_name' => 'P1', 'score' => 10, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'P2', 'score' => 8, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'P3', 'score' => 6, 'time_seconds' => 30]);

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->toContain('border-[#FFD700]')
        ->toContain('border-[#C0C0C0]')
        ->toContain('border-[#CD7F32]');
});

test('leaderboard podium gracefully handles fewer than 3 scores', function () {
    GameScore::factory()->create(['player_name' => 'Only Player', 'score' => 10, 'time_seconds' => 30]);

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->toContain('data-testid="podium"')
        ->toContain('Only Player')
        ->toContain('🥇')
        ->not->toContain('🥈')
        ->not->toContain('🥉');
});

test('leaderboard podium is hidden when no scores exist', function () {
    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)->not->toContain('data-testid="podium"');
});

test('leaderboard podium cards use entrance animations', function () {
    GameScore::factory()->create(['player_name' => 'Animated', 'score' => 10, 'time_seconds' => 30]);

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)->toContain('animate-fade-in-up');
});

test('leaderboard component shows played at date', function () {
    GameScore::factory()->create([
        'player_name' => 'Datum Tim',
        'score' => 8,
        'time_seconds' => 30,
        'created_at' => '2026-04-06 14:30:00',
    ]);

    Livewire::test('pages::igra.leaderboard')
        ->assertSee('06.04.2026 14:30');
});
