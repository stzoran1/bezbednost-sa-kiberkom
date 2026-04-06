<?php

it('includes favicon link on the home page', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('<link rel="icon" type="image/svg+xml" href="/favicon.svg">', escape: false);
});

it('includes favicon link on the game page', function () {
    $this->get('/igra')
        ->assertSuccessful()
        ->assertSee('<link rel="icon" type="image/svg+xml" href="/favicon.svg">', escape: false);
});
