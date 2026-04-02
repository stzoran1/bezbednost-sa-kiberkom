<?php

use function Pest\Laravel\get;

// All three routes return 200
it('serves the landing page', function () {
    get('/')->assertOk();
});

it('serves the presentation page', function () {
    get('/prezentacija')->assertOk();
});

it('serves the game page', function () {
    get('/igra')->assertOk();
});

// Test route is removed
it('does not serve the removed test-slide route', function () {
    get('/test-slide')->assertNotFound();
});

// Consistent gradient class across landing page and game
it('uses consistent gradient styling on landing page', function () {
    get('/')
        ->assertSee('from-purple-600', false)
        ->assertSee('via-blue-500', false)
        ->assertSee('to-cyan-400', false);
});

it('uses consistent gradient styling on game page', function () {
    get('/igra')
        ->assertSee('from-purple-600', false)
        ->assertSee('via-blue-500', false)
        ->assertSee('to-cyan-400', false);
});

// Navigation links work
it('has navigation from landing page to presentation', function () {
    get('/')->assertSee('href="/prezentacija"', false);
});

it('has navigation from landing page to game', function () {
    get('/')->assertSee('href="/igra"', false);
});

// Game has animation classes for smooth feedback
it('game page includes transition animation classes', function () {
    get('/igra')
        ->assertSee('animate-fade-in-up', false);
});

// Projector readability — large font classes present
it('landing page uses large font sizes for projector readability', function () {
    get('/')
        ->assertSee('text-5xl', false)
        ->assertSee('md:text-7xl', false);
});

it('game page uses large font sizes for projector readability', function () {
    get('/igra')
        ->assertSee('text-4xl', false)
        ->assertSee('md:text-5xl', false);
});
