<?php

test('welcome page shows language switcher with all locales', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('language-switcher', false);
    $response->assertSee('SR', false);
    $response->assertSee('СР', false);
    $response->assertSee('RU', false);
});

test('language switcher highlights current locale on welcome page (sr-Latn)', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('aria-current="true"', false);
});

test('language switcher links to correct locale URLs from welcome page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    // sr-Latn is default, links to /
    $response->assertSee('href="/"', false);
    // sr-Cyrl links to /sr-Cyrl
    $response->assertSee('href="/sr-Cyrl"', false);
    // ru links to /ru
    $response->assertSee('href="/ru"', false);
});

test('language switcher on sr-Cyrl welcome page links back to other locales', function () {
    $response = $this->get('/sr-Cyrl');

    $response->assertStatus(200);
    $response->assertSee('href="/"', false);
    $response->assertSee('href="/sr-Cyrl"', false);
    $response->assertSee('href="/ru"', false);
});

test('language switcher on ru welcome page links back to other locales', function () {
    $response = $this->get('/ru');

    $response->assertStatus(200);
    $response->assertSee('href="/"', false);
    $response->assertSee('href="/sr-Cyrl"', false);
    $response->assertSee('href="/ru"', false);
});

test('language switcher preserves path when switching locale on flajer page', function () {
    $response = $this->get('/flajer');

    $response->assertStatus(200);
    $response->assertSee('language-switcher', false);
    $response->assertSee('href="/flajer"', false);
    $response->assertSee('href="/sr-Cyrl/flajer"', false);
    $response->assertSee('href="/ru/flajer"', false);
});

test('language switcher preserves path from locale-prefixed flajer page', function () {
    $response = $this->get('/ru/flajer');

    $response->assertStatus(200);
    $response->assertSee('href="/flajer"', false);
    $response->assertSee('href="/sr-Cyrl/flajer"', false);
    $response->assertSee('href="/ru/flajer"', false);
});

test('language switcher is visible on game page', function () {
    $response = $this->get('/igra');

    $response->assertStatus(200);
    $response->assertSee('language-switcher', false);
});
