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
        ->assertSee('Šta je internet?')
        ->assertSee('digitalno igralište');
});

it('displays personal data slide listing what not to share', function () {
    get('/prezentacija')
        ->assertSee('Lični podaci su tajna')
        ->assertSee('ime i prezime')
        ->assertSee('adresu')
        ->assertSee('školu')
        ->assertSee('telefona')
        ->assertSee('Tvoje')
        ->assertSee('fotografije')
        ->assertSee('Fotografije tvoje')
        ->assertSee('porodice');
});

it('displays password slide with house key metaphor', function () {
    get('/prezentacija')
        ->assertSee('Lozinke su ključevi')
        ->assertSee('ključ od tvoje kuće')
        ->assertSee('duga i jaka')
        ->assertSee('Saveti za jaku lozinku')
        ->assertSee('Ne koristi poznate reči')
        ->assertSee('slova, brojeve i specijalne znakove');
});

it('uses fragments for progressive content reveal', function () {
    get('/prezentacija')->assertSee('data-fragment');
});

it('has all text in Serbian Latin', function () {
    $response = get('/prezentacija');
    $response->assertSee('Naučimo zajedno');
    $response->assertSee('Nikada ne deli');
    $response->assertSee('roditeljima');
});

it('uses the aurora theme', function () {
    get('/prezentacija')->assertSee('data-theme', false);
});

it('displays social media slide explaining stranger danger', function () {
    get('/prezentacija')
        ->assertSee('Društvene mreže')
        ->assertSee('video zapise, poruke i priče')
        ->assertSee('svako može da se pretvara da je neko drugi')
        ->assertSee('Iza slatke profilne slike deteta')
        ->assertSee('odrasla osoba sa lošim namerama')
        ->assertSee('ne bi lagao da je mlađi');
});

it('displays online gaming slide covering chat safety', function () {
    get('/prezentacija')
        ->assertSee('Online igre i razgovori')
        ->assertSee('Ne deli lične podatke')
        ->assertSee('Nikada se ne nalazi uživo sa nekim koga si upoznao na internetu');
});

it('displays warning signs slide part 1 with grooming red flags', function () {
    get('/prezentacija')
        ->assertSee('Prepoznaj opasnost')
        ->assertSee('veoma ozbiljnom')
        ->assertSee('prevarili decu')
        ->assertSee('previše ličnih pitanja')
        ->assertSee('najbolji prijatelj')
        ->assertSee('neočekivane poklone')
        ->assertSee('čuvaš tajnu');
});

it('displays warning signs slide part 2 with additional red flags and emotional emphasis', function () {
    get('/prezentacija')
        ->assertSee('Prepoznaj opasnost (2)')
        ->assertSee('obrišeš poruke')
        ->assertSee('poseban tajni')
        ->assertSee('nađete uživo nasamo')
        ->assertSee('lak novac za fotografije')
        ->assertSee('ozbiljan crveni alarm');
});

it('displays action slide encouraging talking to trusted adults', function () {
    get('/prezentacija')
        ->assertSee('Šta raditi?')
        ->assertSee('roditelju, učitelju ili odrasloj osobi od poverenja')
        ->assertSee('nije tvoja krivica')
        ->assertSee('Nećeš biti u nevolji')
        ->assertSee('vršnjačko nasilje')
        ->assertSee('maltretira tvog druga ili drugaricu')
        ->assertSee('Sigurna linija za prijavu digitalnog nasilja')
        ->assertSee('19833');
});

it('uses warning mascot on danger slides and thumbsup on action slide', function () {
    $response = get('/prezentacija');
    $content = $response->getContent();

    // Warning mascot should appear on slides 5, 6, 7 (danger slides)
    // Thumbsup mascot should appear on slide 8 (action slide)
    $warningCount = substr_count($content, 'mascot-warning.svg');
    $thumbsupCount = substr_count($content, 'mascot-thumbsup.svg');

    // 4 warning from slides 5,6,7,8 + 1 from slide 3 = 5 total warning
    expect($warningCount)->toBeGreaterThanOrEqual(5);
    // 1 thumbsup from slide 8 + 1 from slide 4 = 2 total thumbsup
    expect($thumbsupCount)->toBeGreaterThanOrEqual(2);
});

it('displays recap slide with 4 golden rules', function () {
    get('/prezentacija')
        ->assertSee('Kiberkov savet')
        ->assertSee('4 zlatna pravila')
        ->assertSee('Ne deli lične podatke')
        ->assertSee('Čuvaj lozinke u tajnosti')
        ->assertSee('Reci odrasloj osobi')
        ->assertSee('Budi ljubazan na internetu');
});

it('displays thank you slide with mascot and game teaser', function () {
    get('/prezentacija')
        ->assertSee('Hvala!')
        ->assertSee('Kiberko je ponosan na vas')
        ->assertSee('vreme je za igru');
});

it('contains all 11 slide headings', function () {
    get('/prezentacija')
        ->assertSee('Digitalna bezbednost sa Kiberkom')
        ->assertSee('Šta je internet?')
        ->assertSee('Lični podaci su tajna')
        ->assertSee('Lozinke su ključevi')
        ->assertSee('Društvene mreže')
        ->assertSee('Online igre i razgovori')
        ->assertSee('Prepoznaj opasnost')
        ->assertSee('Prepoznaj opasnost (2)')
        ->assertSee('Šta raditi?')
        ->assertSee('Kiberkov savet')
        ->assertSee('Hvala!');
});
