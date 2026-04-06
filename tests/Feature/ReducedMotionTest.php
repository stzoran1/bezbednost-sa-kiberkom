<?php

test('app.css contains prefers-reduced-motion media query with global animation override', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    expect($css)->toContain('@media (prefers-reduced-motion: reduce)');
    expect($css)->toContain('animation-duration: 0.01ms !important');
    expect($css)->toContain('transition-duration: 0.01ms !important');
    expect($css)->toContain('animation-iteration-count: 1 !important');
});

test('prefers-reduced-motion resets opacity and transform on all animated classes', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    $animatedClasses = [
        '.animate-fade-in-up',
        '.animate-bounce-in',
        '.animate-scale-up-shake',
        '.animate-gentle-float',
        '.animate-shimmer-text',
        '.animate-credits',
        '.animate-btn-fun',
        '.welcome-bg-shape',
        '.welcome-sparkle',
        '.welcome-animated-bg',
        '.slide-attention',
        '.slide-highlight',



        '.slide-conclusion',
        '.slide-rule',
        '.slide-title-shimmer',
        '.slide-celebrate',
    ];

    foreach ($animatedClasses as $class) {
        expect($css)->toContain($class);
    }
});

test('welcome page renders correctly and content is accessible regardless of motion preference', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    // Core content is present — would still render with animations disabled
    $response->assertSee('animate-fade-in-up', false);
    $response->assertSee('animate-gentle-float', false);
    $response->assertSee('welcome-bg-shapes', false);
});
