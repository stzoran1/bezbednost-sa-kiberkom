<?php

use Illuminate\Support\Facades\Blade;

it('renders the default mascot variant', function () {
    $html = Blade::render('<x-mascot />');

    expect($html)
        ->toContain('mascot-default.svg')
        ->toContain('Kiberko');
});

it('renders the warning mascot variant', function () {
    $html = Blade::render('<x-mascot variant="warning" />');

    expect($html)
        ->toContain('mascot-warning.svg')
        ->toContain('Kiberko');
});

it('renders the thumbsup mascot variant', function () {
    $html = Blade::render('<x-mascot variant="thumbsup" />');

    expect($html)
        ->toContain('mascot-thumbsup.svg')
        ->toContain('Kiberko');
});

it('falls back to default for invalid variant', function () {
    $html = Blade::render('<x-mascot variant="invalid" />');

    expect($html)->toContain('mascot-default.svg');
});

it('applies default size class', function () {
    $html = Blade::render('<x-mascot />');

    expect($html)->toContain('w-32 h-32');
});

it('accepts a custom size class', function () {
    $html = Blade::render('<x-mascot class="w-64 h-64" />');

    expect($html)->toContain('w-64 h-64');
});
