<?php

test('flyer page loads successfully', function () {
    $response = $this->get('/flajer');

    $response->assertStatus(200);
});

test('flyer mentions photos and videos as personal data', function () {
    $response = $this->get('/flajer');

    $response->assertSee('fotografije');
    $response->assertSee('video zapisi');
});

test('flyer password advice says duga i jaka', function () {
    $response = $this->get('/flajer');

    $response->assertSee('duga i jaka');
    $response->assertDontSee('duga i tajna');
});

test('flyer has expanded grooming warning signs', function () {
    $response = $this->get('/flajer');

    $response->assertSee('preterano hvali');
    $response->assertSee('nudi poklone');
    $response->assertSee('tajnu od roditelja');
    $response->assertSee('obriše');
    $response->assertSee('nasamo');
});

test('flyer mentions peer cyberbullying', function () {
    $response = $this->get('/flajer');

    $response->assertSee('nasilje na internetu');
});

test('flyer includes reporting hotline', function () {
    $response = $this->get('/flajer');

    $response->assertSee('Sigurna linija za prijavu digitalnog nasilja');
});

test('flyer includes reporting hotline number', function () {
    $response = $this->get('/flajer');

    $response->assertSee('19833');
});
