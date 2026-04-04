<?php

test('routes without locale prefix default to sr-Latn', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    expect(app()->getLocale())->toBe('sr-Latn');
});

test('routes with /ru/ prefix set locale to ru', function () {
    $response = $this->get('/ru');

    $response->assertStatus(200);
    expect(app()->getLocale())->toBe('ru');
});

test('routes with /sr-Cyrl/ prefix set locale to sr-Cyrl', function () {
    $response = $this->get('/sr-Cyrl');

    $response->assertStatus(200);
    expect(app()->getLocale())->toBe('sr-Cyrl');
});

test('invalid locale prefix returns 404', function () {
    $response = $this->get('/fr');

    $response->assertStatus(404);
});

test('html lang attribute reflects active locale for default', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('lang="sr-Latn"', false);
});

test('html lang attribute reflects active locale for ru', function () {
    $response = $this->get('/ru');

    $response->assertStatus(200);
    $response->assertSee('lang="ru"', false);
});

test('default locale is sr-Latn in config', function () {
    expect(config('app.locale'))->toBe('sr-Latn');
    expect(config('app.fallback_locale'))->toBe('sr-Latn');
});

test('supported locales config maps codes to display names', function () {
    $supported = config('locales.supported');

    expect($supported)->toHaveKeys(['sr-Latn', 'sr-Cyrl', 'ru']);
    expect($supported['sr-Latn'])->toBe('Srpski latinica');
    expect($supported['sr-Cyrl'])->toBe('Српски ћирилица');
    expect($supported['ru'])->toBe('Русский');
});
