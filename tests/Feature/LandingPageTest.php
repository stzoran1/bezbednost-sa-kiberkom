<?php

test('landing page returns 200', function () {
    $this->get('/')->assertStatus(200);
});

test('landing page contains title', function () {
    $this->get('/')
        ->assertSee('Digitalna bezbednost sa Kiberkom');
});

test('landing page contains link to prezentacija', function () {
    $this->get('/')
        ->assertSee('href="/prezentacija"', escape: false);
});

test('landing page contains link to igra', function () {
    $this->get('/')
        ->assertSee('href="/igra"', escape: false);
});

test('landing page contains mascot image', function () {
    $this->get('/')
        ->assertSee('mascot-default.svg', escape: false);
});
