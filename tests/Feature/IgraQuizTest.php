<?php

test('igra page returns 200', function () {
    $this->get('/igra')->assertStatus(200);
});

test('igra page displays quiz title', function () {
    $this->get('/igra')
        ->assertSee('Dobro ili Lose?');
});

test('igra page displays first scenario', function () {
    $this->get('/igra')
        ->assertSee('Neko te pita za tvoju adresu na internetu');
});

test('igra page displays answer buttons', function () {
    $this->get('/igra')
        ->assertSee('Dobro')
        ->assertSee('Lose');
});

test('igra page displays mascot', function () {
    $this->get('/igra')
        ->assertSee('mascot-default.svg', escape: false);
});
