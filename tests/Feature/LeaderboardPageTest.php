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

test('leaderboard table shows scores from 4th place onward', function () {
    // Create 5 players with distinct scores
    GameScore::factory()->create(['player_name' => 'First', 'score' => 10, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Second', 'score' => 9, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Third', 'score' => 8, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Fourth', 'score' => 7, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Fifth', 'score' => 6, 'time_seconds' => 30]);

    $html = Livewire::test('pages::igra.leaderboard')->html();

    // Table should contain 4th and 5th place players
    expect($html)
        ->toContain('data-testid="leaderboard-table"')
        ->toContain('data-testid="score-row"')
        ->toContain('Fourth')
        ->toContain('Fifth');

    // Podium has the top 3, table starts at rank 4
    $tableStart = strpos($html, 'data-testid="leaderboard-table"');
    $fourthPos = strpos($html, 'Fourth', $tableStart);
    $fifthPos = strpos($html, 'Fifth', $tableStart);

    expect($fourthPos)->toBeLessThan($fifthPos);
});

test('leaderboard table rows have alternating backgrounds', function () {
    GameScore::factory()->count(6)->create();

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->toContain('bg-white')
        ->toContain('bg-purple-50/40');
});

test('leaderboard table rows have hover effects', function () {
    GameScore::factory()->count(5)->create();

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)->toContain('hover:bg-purple-100/60');
});

test('leaderboard table shows rank numbers starting at 4', function () {
    GameScore::factory()->count(5)->create();

    $html = Livewire::test('pages::igra.leaderboard')->html();

    // Rank numbers should be visible (4, 5 for 4th and 5th place)
    $tableStart = strpos($html, 'data-testid="leaderboard-table"');
    $tableHtml = substr($html, $tableStart);

    // Should not contain rank 1, 2, 3 in the table rows (those are in podium)
    // But should have ranks starting at 4
    expect($tableHtml)->toContain('>4<');
    expect($tableHtml)->toContain('>5<');
});

test('leaderboard table has score tier color styling', function () {
    // Top 3 go to podium, so we need scores that land in the table (4th+)
    GameScore::factory()->create(['score' => 10, 'total_questions' => 10, 'time_seconds' => 10]); // 1st - podium
    GameScore::factory()->create(['score' => 9, 'total_questions' => 10, 'time_seconds' => 10]);  // 2nd - podium
    GameScore::factory()->create(['score' => 8, 'total_questions' => 10, 'time_seconds' => 10]);  // 3rd - podium
    // These go to the table:
    GameScore::factory()->create(['score' => 7, 'total_questions' => 10, 'time_seconds' => 10]);  // 4th - blue tier (>=70%)
    GameScore::factory()->create(['score' => 3, 'total_questions' => 10, 'time_seconds' => 10]);  // 5th - gray tier (<50%)

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->toContain('border-l-blue-400')
        ->toContain('border-l-gray-200');
});

test('leaderboard table is responsive with overflow scroll', function () {
    GameScore::factory()->count(5)->create();

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)->toContain('overflow-x-auto');
});

test('leaderboard empty state shows mascot and encouraging message when 3 or fewer scores', function () {
    // With exactly 3 scores, table section should show empty state
    GameScore::factory()->count(3)->create();

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->toContain('data-testid="empty-state"')
        ->toContain('mascot-default.svg');
});

test('leaderboard empty state shows when no scores exist', function () {
    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->toContain('data-testid="empty-state"')
        ->toContain('mascot-default.svg');
});

test('leaderboard table hidden when only top 3 players exist', function () {
    GameScore::factory()->count(2)->create();

    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)
        ->not->toContain('data-testid="score-row"')
        ->toContain('data-testid="empty-state"');
});

test('leaderboard page has back to game button linking to igra', function () {
    $html = Livewire::test('pages::igra.leaderboard')->html();

    expect($html)->toContain('/igra');
    expect($html)->toContain(__('game.back_to_game'));
});

test('leaderboard table shows formatted played at date', function () {
    // 3 scores for the podium
    GameScore::factory()->create(['score' => 10, 'time_seconds' => 10]);
    GameScore::factory()->create(['score' => 9, 'time_seconds' => 10]);
    GameScore::factory()->create(['score' => 8, 'time_seconds' => 10]);
    // 4th place goes to the table
    GameScore::factory()->create([
        'player_name' => 'Datum Tim',
        'score' => 7,
        'time_seconds' => 30,
        'created_at' => '2026-04-06 14:30:00',
    ]);

    Livewire::test('pages::igra.leaderboard')
        ->assertSee('06.04.2026 14:30');
});
