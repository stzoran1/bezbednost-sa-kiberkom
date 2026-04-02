<?php

use function Pest\Laravel\get;

it('renders the presentation page without errors', function () {
    get('/prezentacija')->assertOk();
});

it('displays the presentation title', function () {
    get('/prezentacija')->assertSee('Digitalna bezbednost sa Kiberkom');
});

it('displays the mascot on the title slide', function () {
    get('/prezentacija')->assertSee('mascot-default.svg');
});

it('displays internet basics slide with digital playground analogy', function () {
    get('/prezentacija')
        ->assertSee('Sta je internet?')
        ->assertSee('digitalno igraliste');
});

it('displays personal data slide listing what not to share', function () {
    get('/prezentacija')
        ->assertSee('Licni podaci su tajna')
        ->assertSee('ime i prezime')
        ->assertSee('adresu')
        ->assertSee('skolu')
        ->assertSee('telefona');
});

it('displays password slide with house key metaphor', function () {
    get('/prezentacija')
        ->assertSee('Lozinke su kljucevi')
        ->assertSee('kljuc od tvoje kuce');
});

it('uses fragments for progressive content reveal', function () {
    get('/prezentacija')->assertSee('data-fragment');
});

it('has all text in Serbian Latin', function () {
    $response = get('/prezentacija');
    $response->assertSee('Naucimo zajedno');
    $response->assertSee('Nikada ne deli');
    $response->assertSee('roditeljima');
});

it('uses the aurora theme', function () {
    get('/prezentacija')->assertSee('data-theme', false);
});

it('displays social media slide explaining stranger danger', function () {
    get('/prezentacija')
        ->assertSee('Drustvene mreze')
        ->assertSee('svako moze da se pretvara da je neko drugi')
        ->assertSee('odrasla osoba');
});

it('displays online gaming slide covering chat safety', function () {
    get('/prezentacija')
        ->assertSee('Online igre i razgovori')
        ->assertSee('Ne deli licne podatke')
        ->assertSee('Nikada se ne nalazi uzivo sa nekim koga si upoznao na internetu');
});

it('displays warning signs slide with concrete red flags', function () {
    get('/prezentacija')
        ->assertSee('Prepoznaj opasnost')
        ->assertSee('svoju sliku')
        ->assertSee('gde zivis')
        ->assertSee('cuvas tajnu')
        ->assertSee('nadjete nasamo');
});

it('displays action slide encouraging talking to trusted adults', function () {
    get('/prezentacija')
        ->assertSee('Sta raditi?')
        ->assertSee('roditelju, ucitelju ili odrasloj osobi od poverenja')
        ->assertSee('nije tvoja krivica')
        ->assertSee('Neces biti u nevolji');
});

it('uses warning mascot on danger slides and thumbsup on action slide', function () {
    $response = get('/prezentacija');
    $content = $response->getContent();

    // Warning mascot should appear on slides 5, 6, 7 (danger slides)
    // Thumbsup mascot should appear on slide 8 (action slide)
    $warningCount = substr_count($content, 'mascot-warning.svg');
    $thumbsupCount = substr_count($content, 'mascot-thumbsup.svg');

    // 3 warning from slides 5,6,7 + 1 from slide 3 = 4 total warning
    expect($warningCount)->toBeGreaterThanOrEqual(4);
    // 1 thumbsup from slide 8 + 1 from slide 4 = 2 total thumbsup
    expect($thumbsupCount)->toBeGreaterThanOrEqual(2);
});
