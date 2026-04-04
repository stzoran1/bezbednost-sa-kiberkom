<?php

use App\Models\GameScore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('renders the game page in default locale (sr-Latn)', function () {
    get('/igra')
        ->assertOk()
        ->assertSee('Dobro ili Loše?')
        ->assertSee('Igra sa Kiberkom')
        ->assertSee('Dobrodošli u igru!')
        ->assertSee('Započni igru');
});

it('renders the game page in sr-Cyrl locale', function () {
    get('/sr-Cyrl/igra')
        ->assertOk()
        ->assertSee('Добро или Лоше?')
        ->assertSee('Игра са Киберком')
        ->assertSee('Добродошли у игру!')
        ->assertSee('Започни игру');
});

it('renders the game page in ru locale', function () {
    get('/ru/igra')
        ->assertOk()
        ->assertSee('Хорошо или Плохо?')
        ->assertSee('Игра с Киберком')
        ->assertSee('Добро пожаловать в игру!')
        ->assertSee('Начать игру');
});

it('loads all 20 scenarios from translation files in sr-Latn', function () {
    $scenarios = __('game.scenarios');

    expect($scenarios)->toBeArray()->toHaveCount(20);
    expect($scenarios[0])->toHaveKeys(['text', 'answer', 'explanation']);
    expect($scenarios[0]['text'])->toBe('Davanje kućne adrese nepoznatoj osobi na internetu');
});

it('loads all 20 scenarios from translation files in sr-Cyrl', function () {
    app()->setLocale('sr-Cyrl');
    $scenarios = __('game.scenarios');

    expect($scenarios)->toBeArray()->toHaveCount(20);
    expect($scenarios[0]['text'])->toBe('Давање кућне адресе непознатој особи на интернету');
});

it('loads all 20 scenarios from translation files in ru', function () {
    app()->setLocale('ru');
    $scenarios = __('game.scenarios');

    expect($scenarios)->toBeArray()->toHaveCount(20);
    expect($scenarios[0]['text'])->toBe('Сообщение домашнего адреса незнакомому человеку в интернете');
});

it('has zero hardcoded user-facing text in the game view', function () {
    $content = file_get_contents(resource_path('views/pages/igra/index.blade.php'));

    // Strip Blade comments
    $content = preg_replace('/\{\{--.*?--\}\}/s', '', $content);

    // Strip PHP block at top (class definition)
    $content = preg_replace('/^<\?php.*?\?>/s', '', $content);

    // Strip Blade directives, translation calls, variables, and HTML tags
    $stripped = $content;
    $stripped = preg_replace('/\{\{.*?\}\}/s', '', $stripped);
    $stripped = preg_replace('/\{!!.*?!!\}/s', '', $stripped);
    $stripped = preg_replace('/@(if|elseif|else|endif|foreach|endforeach|error|enderror|include|php|endphp|livewireStyles|livewireScripts|vite)\b[^@]*/s', '', $stripped);
    $stripped = preg_replace('/<[^>]+>/', '', $stripped);
    $stripped = preg_replace('/x-data="[^"]*"/s', '', $stripped);
    $stripped = preg_replace('/x-effect="[^"]*"/s', '', $stripped);
    $stripped = preg_replace('/x-text="[^"]*"/s', '', $stripped);

    // Remove HTML entities (emojis like &#8962; &#128077; &#128078;)
    $stripped = preg_replace('/&#\d+;/', '', $stripped);

    // Remove 00:00 timer placeholder
    $stripped = str_replace('00:00', '', $stripped);

    // Get remaining visible text (letters only, not numbers or punctuation)
    preg_match_all('/[a-zA-ZčćšžđČĆŠŽĐа-яА-ЯёЁ]{2,}/', $stripped, $matches);

    $ignoredWords = ['div', 'class', 'href', 'style', 'px', 'rem', 'sm', 'md', 'lg', 'xl',
        'bg', 'text', 'font', 'py', 'mt', 'mb', 'gap', 'flex', 'items', 'justify',
        'center', 'rounded', 'shadow', 'transition', 'duration', 'hover', 'none',
        'bold', 'extrabold', 'semibold', 'left', 'right', 'top', 'fixed', 'absolute',
        'white', 'purple', 'blue', 'cyan', 'green', 'red', 'orange', 'gray', 'black',
        'backdrop', 'blur', 'animate', 'fade', 'bounce', 'drop', 'gradient',
        'onmouseover', 'onmouseout', 'this', 'rgba', 'type', 'submit', 'autofocus',
        'wire', 'model', 'click', 'min', 'max', 'screen', 'full', 'wide', 'col',
        'row', 'all', 'up', 'in', 'to', 'br', 'from', 'via', 'of', 'padStart',
        'width', 'height', 'padding', 'color', 'background', 'position', 'filter',
        'zIndex', 'fontSize', 'fontWeight', 'borderRadius', 'textDecoration',
    ];

    $hardcoded = array_filter($matches[0], fn ($word) => ! in_array(strtolower($word), array_map('strtolower', $ignoredWords)));

    expect($hardcoded)->toBeEmpty('Found hardcoded text: '.implode(', ', $hardcoded));
});

it('has zero hardcoded user-facing text in the leaderboard partial', function () {
    $content = file_get_contents(resource_path('views/pages/igra/_leaderboard.blade.php'));

    // Strip Blade comments
    $content = preg_replace('/\{\{--.*?--\}\}/s', '', $content);

    // Strip Blade directives, translation calls, variables, and HTML tags
    $stripped = $content;
    $stripped = preg_replace('/\{\{.*?\}\}/s', '', $stripped);
    $stripped = preg_replace('/@(if|elseif|else|endif|foreach|endforeach|error|enderror)\b[^@]*/s', '', $stripped);
    $stripped = preg_replace('/<[^>]+>/', '', $stripped);

    // Get remaining visible text (letters only)
    preg_match_all('/[a-zA-ZčćšžđČĆŠŽĐа-яА-ЯёЁ]{2,}/', $stripped, $matches);

    $ignoredWords = ['div', 'table', 'thead', 'tbody', 'tr', 'th', 'td', 'form',
        'input', 'button', 'class', 'type', 'wire', 'submit', 'password',
        'px', 'py', 'mt', 'pt', 'text', 'bg', 'font', 'sm', 'flex', 'col',
        'row', 'items', 'center', 'rounded', 'border', 'hover', 'transition',
        'bold', 'semibold', 'left', 'right', 'underline', 'purple', 'red',
        'green', 'gray', 'white', 'mono',
    ];

    $hardcoded = array_filter($matches[0], fn ($word) => ! in_array(strtolower($word), array_map('strtolower', $ignoredWords)));

    expect($hardcoded)->toBeEmpty('Found hardcoded text: '.implode(', ', $hardcoded));
});

it('displays leaderboard with translated headers in sr-Cyrl', function () {
    GameScore::create([
        'player_name' => 'Тест',
        'score' => 8,
        'total_questions' => 10,
        'time_seconds' => 45,
    ]);

    get('/sr-Cyrl/igra')
        ->assertOk()
        ->assertSee('Погледај табелу резултата');
});

it('displays leaderboard with translated headers in ru', function () {
    GameScore::create([
        'player_name' => 'Тест',
        'score' => 8,
        'total_questions' => 10,
        'time_seconds' => 45,
    ]);

    get('/ru/igra')
        ->assertOk()
        ->assertSee('Посмотреть таблицу результатов');
});

it('shows translated validation error for empty player name in sr-Latn', function () {
    Livewire::test('pages::igra.index')
        ->set('playerName', '')
        ->call('startGame')
        ->assertHasErrors(['playerName' => 'required']);
});

it('shows translated validation error for empty player name in sr-Cyrl', function () {
    app()->setLocale('sr-Cyrl');

    Livewire::test('pages::igra.index')
        ->set('playerName', '')
        ->call('startGame')
        ->assertHasErrors(['playerName' => 'required']);
});

it('shows translated validation error for empty player name in ru', function () {
    app()->setLocale('ru');

    Livewire::test('pages::igra.index')
        ->set('playerName', '')
        ->call('startGame')
        ->assertHasErrors(['playerName' => 'required']);
});

it('plays full game flow in sr-Cyrl locale', function () {
    app()->setLocale('sr-Cyrl');

    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Тест Тим')
        ->call('startGame')
        ->assertSet('started', true)
        ->assertSet('current', 0);

    // Answer all 10 questions
    for ($i = 0; $i < 10; $i++) {
        $scenario = $component->get('activeScenarios')[$component->get('current')];
        $component->call('answer', $scenario['answer'])
            ->call('next');
    }

    $component->assertSet('finished', true)
        ->assertSet('score', 10);
});

it('plays full game flow in ru locale', function () {
    app()->setLocale('ru');

    $component = Livewire::test('pages::igra.index')
        ->set('playerName', 'Тестовая команда')
        ->call('startGame')
        ->assertSet('started', true)
        ->assertSet('current', 0);

    // Answer all 10 questions
    for ($i = 0; $i < 10; $i++) {
        $scenario = $component->get('activeScenarios')[$component->get('current')];
        $component->call('answer', $scenario['answer'])
            ->call('next');
    }

    $component->assertSet('finished', true)
        ->assertSet('score', 10);
});

it('resets leaderboard with password 2604 in all locales', function () {
    foreach (['sr-Latn', 'sr-Cyrl', 'ru'] as $locale) {
        app()->setLocale($locale);

        GameScore::create([
            'player_name' => 'Test',
            'score' => 5,
            'total_questions' => 10,
            'time_seconds' => 30,
        ]);

        Livewire::test('pages::igra.index')
            ->set('showResetForm', true)
            ->set('resetPassword', '2604')
            ->call('resetLeaderboard')
            ->assertSet('resetSuccess', true)
            ->assertSet('resetError', null);

        expect(GameScore::count())->toBe(0);
    }
});

it('shows translated error for wrong reset password', function () {
    app()->setLocale('ru');

    Livewire::test('pages::igra.index')
        ->set('showResetForm', true)
        ->set('resetPassword', 'wrong')
        ->call('resetLeaderboard')
        ->assertSet('resetError', 'Неправильный пароль!');
});

it('scenario answers are consistent across all locales', function () {
    $locales = ['sr-Latn', 'sr-Cyrl', 'ru'];
    $answerSets = [];

    foreach ($locales as $locale) {
        app()->setLocale($locale);
        $scenarios = __('game.scenarios');
        $answerSets[$locale] = array_column($scenarios, 'answer');
    }

    expect($answerSets['sr-Latn'])->toBe($answerSets['sr-Cyrl']);
    expect($answerSets['sr-Latn'])->toBe($answerSets['ru']);
});
