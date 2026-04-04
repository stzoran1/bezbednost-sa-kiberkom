<?php

test('welcome page in sr-Latn contains translated strings', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Digitalna bezbednost sa Kiberkom');
    $response->assertSee('Nauči kako da budeš siguran na internetu!');
    $response->assertSee('Prezentacija');
    $response->assertSee('Igra');
    $response->assertSee('Flajer');
});

test('welcome page in sr-Latn has no locale prefix in links', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('href="/prezentacija"', false);
    $response->assertSee('href="/igra"', false);
    $response->assertSee('href="/flajer"', false);
});

test('welcome page in sr-Cyrl contains Cyrillic strings', function () {
    $response = $this->get('/sr-Cyrl');

    $response->assertStatus(200);
    $response->assertSee('Дигитална безбедност са Киберком');
    $response->assertSee('Научи како да будеш сигуран на интернету!');
    $response->assertSee('Презентација');
    $response->assertSee('Игра');
    $response->assertSee('Флајер');
});

test('welcome page in sr-Cyrl has locale prefix in links', function () {
    $response = $this->get('/sr-Cyrl');

    $response->assertStatus(200);
    $response->assertSee('href="/sr-Cyrl/prezentacija"', false);
    $response->assertSee('href="/sr-Cyrl/igra"', false);
    $response->assertSee('href="/sr-Cyrl/flajer"', false);
});

test('welcome page in ru contains Russian strings', function () {
    $response = $this->get('/ru');

    $response->assertStatus(200);
    $response->assertSee('Цифровая безопасность с Киберко');
    $response->assertSee('Узнай, как быть в безопасности в интернете!');
    $response->assertSee('Презентация');
    $response->assertSee('Игра');
    $response->assertSee('Флаер');
});

test('welcome page in ru has locale prefix in links', function () {
    $response = $this->get('/ru');

    $response->assertStatus(200);
    $response->assertSee('href="/ru/prezentacija"', false);
    $response->assertSee('href="/ru/igra"', false);
    $response->assertSee('href="/ru/flajer"', false);
});

test('welcome page contains no hardcoded Serbian text', function () {
    $bladeContent = file_get_contents(resource_path('views/welcome.blade.php'));

    expect($bladeContent)->not->toContain('Digitalna bezbednost sa Kiberkom');
    expect($bladeContent)->not->toContain('Nauči kako da budeš siguran na internetu!');
    expect($bladeContent)->not->toContain('>Prezentacija<');
    expect($bladeContent)->not->toContain('>Igra<');
    expect($bladeContent)->not->toContain('>Flajer<');
});
