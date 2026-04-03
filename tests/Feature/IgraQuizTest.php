<?php

use App\Models\GameScore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('igra page returns 200', function () {
    $this->get('/igra')->assertStatus(200);
});

test('igra page displays quiz title', function () {
    $this->get('/igra')
        ->assertSee('Dobro ili Loše?');
});

test('igra page shows player name input before starting', function () {
    $this->get('/igra')
        ->assertSee('Dobrodošli u igru!')
        ->assertSee('Ime igrača ili tima');
});

test('igra page displays mascot on start screen', function () {
    $this->get('/igra')
        ->assertSee('mascot-default.svg', escape: false);
});

test('igra page shows leaderboard link on start screen', function () {
    $this->get('/igra')
        ->assertSee('Pogledaj tabelu rezultata');
});

test('starting game requires a player name', function () {
    Livewire::test('pages::igra.index')
        ->call('startGame')
        ->assertHasErrors(['playerName' => 'required']);
});

test('starting game with valid name shows first question', function () {
    Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame')
        ->assertSet('started', true)
        ->assertSet('current', 0);
});

test('starting game records a start timestamp', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    expect($component->get('startedAtTimestamp'))->toBeFloat()->toBeGreaterThan(0);
});

test('game selects random scenarios each time', function () {
    $component1 = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios1 = $component1->get('activeScenarios');

    $component2 = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim B')
        ->call('startGame');

    $scenarios2 = $component2->get('activeScenarios');

    expect(count($scenarios1))->toBe(10);
    expect(count($scenarios2))->toBe(10);
});

test('answering correctly increments score', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');
    $correctAnswer = $scenarios[0]['answer'];

    $component->call('answer', $correctAnswer)
        ->assertSet('score', 1)
        ->assertSet('lastCorrect', true);
});

test('answering incorrectly does not increment score', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');
    $wrongAnswer = ! $scenarios[0]['answer'];

    $component->call('answer', $wrongAnswer)
        ->assertSet('score', 0)
        ->assertSet('lastCorrect', false);
});

test('completing the game saves score and time to database', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Kiberko Tim')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');

    foreach ($scenarios as $scenario) {
        $component->call('answer', $scenario['answer']);
        $component->call('next');
    }

    $component->assertSet('finished', true);

    $score = GameScore::where('player_name', 'Kiberko Tim')->first();

    expect($score)->not->toBeNull();
    expect($score->score)->toBe(count($scenarios));
    expect($score->total_questions)->toBe(count($scenarios));
    expect($score->time_seconds)->toBeGreaterThanOrEqual(0);
});

test('final time is shown on results screen', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');

    foreach ($scenarios as $scenario) {
        $component->call('answer', $scenario['answer']);
        $component->call('next');
    }

    $component->assertSee('Vreme:');
});

test('leaderboard shows saved scores with time', function () {
    GameScore::factory()->create(['player_name' => 'Najbolji Tim', 'score' => 10, 'time_seconds' => 45]);
    GameScore::factory()->create(['player_name' => 'Drugi Tim', 'score' => 7, 'time_seconds' => 60]);

    Livewire::test('pages::igra.index')
        ->call('toggleLeaderboard')
        ->assertSee('Tabela rezultata')
        ->assertSee('Najbolji Tim')
        ->assertSee('Drugi Tim')
        ->assertSee('Vreme');
});

test('leaderboard ranks by score then by time for tiebreaker', function () {
    GameScore::factory()->create(['player_name' => 'Brzi Tim', 'score' => 8, 'time_seconds' => 30]);
    GameScore::factory()->create(['player_name' => 'Spori Tim', 'score' => 8, 'time_seconds' => 90]);

    $component = Livewire::test('pages::igra.index')
        ->call('toggleLeaderboard');

    $html = $component->html();
    $fastPos = strpos($html, 'Brzi Tim');
    $slowPos = strpos($html, 'Spori Tim');

    expect($fastPos)->toBeLessThan($slowPos);
});

test('play again keeps the same player name', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');

    foreach ($scenarios as $scenario) {
        $component->call('answer', $scenario['answer']);
        $component->call('next');
    }

    $component->call('playAgain')
        ->assertSet('playerName', 'Tim A')
        ->assertSet('started', true)
        ->assertSet('finished', false)
        ->assertSet('current', 0)
        ->assertSet('score', 0);

    expect($component->get('startedAtTimestamp'))->toBeFloat()->toBeGreaterThan(0);
});

test('wrong answer shows encouraging heading without trivializing', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');
    $wrongAnswer = ! $scenarios[0]['answer'];

    $component->call('answer', $wrongAnswer)
        ->assertSee('Nije tačno, ali ne brini')
        ->assertDontSee('nema veze');
});

test('wrong answer explanations do not contain congratulatory words', function () {
    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame');

    $scenarios = $component->get('activeScenarios');
    $congratulatoryWords = ['Odlično!', 'Bravo!', 'Super!', 'Fantastično!'];

    foreach ($scenarios as $scenario) {
        if ($scenario['answer'] === false) {
            foreach ($congratulatoryWords as $word) {
                expect($scenario['explanation'])->not->toContain($word);
            }
        }
    }
});

test('new player resets to start screen', function () {
    Livewire::test('pages::igra.index')
        ->set('playerName', 'Tim A')
        ->call('startGame')
        ->call('newPlayer')
        ->assertSet('started', false)
        ->assertSet('playerName', '')
        ->assertSet('startedAtTimestamp', null)
        ->assertSet('finalTimeSeconds', 0);
});
