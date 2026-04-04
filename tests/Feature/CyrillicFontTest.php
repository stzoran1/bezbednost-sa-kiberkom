<?php

$locales = ['sr-Latn', 'sr-Cyrl', 'ru'];

$routes = [
    '/' => 'welcome',
    '/prezentacija' => 'presentation',
    '/igra' => 'game',
    '/flajer' => 'flyer',
];

// Test all routes return 200 for every locale
foreach ($routes as $path => $label) {
    foreach ($locales as $locale) {
        $url = $locale === 'sr-Latn' ? $path : "/{$locale}{$path}";

        test("{$label} page returns 200 for {$locale} locale", function () use ($url, $locale) {
            $response = $this->get($url);

            $response->assertStatus(200);
            expect(app()->getLocale())->toBe($locale);
        });
    }
}

// Test Google Fonts Inter is loaded with Cyrillic support in main layouts
test('welcome page loads Inter font from Google Fonts', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('fonts.googleapis.com/css2?family=Inter', false);
});

test('game page loads Inter font from Google Fonts', function () {
    $response = $this->get('/igra');

    $response->assertStatus(200);
    $response->assertSee('fonts.googleapis.com/css2?family=Inter', false);
});

test('flyer page loads Inter font from Google Fonts', function () {
    $response = $this->get('/flajer');

    $response->assertStatus(200);
    $response->assertSee('fonts.googleapis.com/css2?family=Inter', false);
});

// Test Cyrillic content renders in sr-Cyrl locale
test('welcome page renders Cyrillic text for sr-Cyrl locale', function () {
    $response = $this->get('/sr-Cyrl');

    $response->assertStatus(200);
    // Verify actual Cyrillic characters appear (not tofu/replacement chars)
    $content = $response->getContent();
    expect($content)->toMatch('/[\x{0400}-\x{04FF}]/u');
});

// Test Cyrillic content renders in ru locale
test('welcome page renders Cyrillic text for ru locale', function () {
    $response = $this->get('/ru');

    $response->assertStatus(200);
    $content = $response->getContent();
    expect($content)->toMatch('/[\x{0400}-\x{04FF}]/u');
});

// Test html lang attribute is correct for Cyrillic locales
test('html lang attribute is sr-Cyrl for Cyrillic Serbian pages', function () {
    $response = $this->get('/sr-Cyrl/flajer');

    $response->assertStatus(200);
    $response->assertSee('lang="sr-Cyrl"', false);
});

test('html lang attribute is ru for Russian pages', function () {
    $response = $this->get('/ru/flajer');

    $response->assertStatus(200);
    $response->assertSee('lang="ru"', false);
});
