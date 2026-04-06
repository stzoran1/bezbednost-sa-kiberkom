<?php

test('welcome page hero section has entrance animations', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-bounce-in', false);
    $response->assertSee('animate-fade-in-up', false);
    $response->assertSee('animate-delay-200', false);
    $response->assertSee('animate-delay-400', false);
});

test('welcome page mascot has bounce-in animation', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-bounce-in', false);
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
