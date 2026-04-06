<?php

test('welcome page hero section has entrance animations', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-gentle-float', false);
    $response->assertSee('animate-fade-in-up', false);
    $response->assertSee('animate-delay-200', false);
    $response->assertSee('animate-delay-400', false);
});

test('welcome page mascot has gentle float animation', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-gentle-float', false);
});

test('welcome page title has fade-in-up animation with delay', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-fade-in-up animate-delay-200', false);
});

test('welcome page subtitle has fade-in-up animation with longer delay', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-fade-in-up animate-delay-400', false);
});

test('welcome page CTA buttons have staggered entrance animations', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-fade-in-up animate-delay-600', false);
    $response->assertSee('animate-fade-in-up animate-delay-800', false);
    $response->assertSee('animate-fade-in-up animate-delay-1000', false);
});

test('welcome page has animated background shapes', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('welcome-bg-shapes', false);
    $response->assertSee('welcome-bg-shape welcome-bg-shape--1', false);
    $response->assertSee('welcome-bg-shape welcome-bg-shape--5', false);
});

test('welcome page background shapes are aria-hidden for accessibility', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    preg_match_all('/welcome-bg-shape[^"]*"[^>]*aria-hidden="true"/', $content, $matches);
    expect($matches[0])->toHaveCount(5);
});

test('welcome page CTA buttons retain hover scale effect alongside animations', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // All three buttons should have both hover:scale-105 and animate-fade-in-up
    preg_match_all('/class="[^"]*hover:scale-105[^"]*animate-fade-in-up[^"]*"/', $content, $matches);
    expect($matches[0])->toHaveCount(3);
});
