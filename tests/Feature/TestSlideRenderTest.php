<?php

use function Pest\Laravel\get;

it('renders the test slide route without errors', function () {
    get('/test-slide')
        ->assertOk()
        ->assertSee('Welcome to SlideWire');
});
