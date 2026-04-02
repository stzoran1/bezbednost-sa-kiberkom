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
