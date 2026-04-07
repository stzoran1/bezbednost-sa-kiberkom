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
    $response->assertSee('welcome-bg-shape welcome-bg-shape--8', false);
});

test('welcome page has sparkle particles', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('welcome-sparkle welcome-sparkle--1', false);
    $response->assertSee('welcome-sparkle welcome-sparkle--6', false);
});

test('welcome page has animated gradient background', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('welcome-animated-bg', false);
});

test('welcome page title has shimmer text effect', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-shimmer-text', false);
});

test('welcome page buttons have fun hover effects', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('animate-btn-fun animate-btn-yellow', false);
    $response->assertSee('animate-btn-fun animate-btn-green', false);
    $response->assertSee('animate-btn-fun animate-btn-cyan', false);
});

test('welcome page flyer button has visible text with z-index above pseudo-element overlay', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // Flyer button should use cyan color scheme for contrast (not white)
    $response->assertSee('bg-cyan-400', false);
    $response->assertSee('animate-btn-cyan', false);

    // Flyer button should have text-gray-900 for contrast
    preg_match('/<a[^>]*flajer[^>]*class="([^"]*)"/', $content, $classMatch);
    expect($classMatch[1])->toContain('text-gray-900');

    // Button text should be wrapped in a span with relative z-10 to sit above the ::after overlay
    preg_match('/<a[^>]*flajer[^>]*>(.*?)<\/a>/s', $content, $match);
    expect($match[1])->toContain('relative z-10');
});

test('welcome page background shapes wrapper is aria-hidden for accessibility', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // The wrapper div containing all shapes has aria-hidden and pointer-events-none
    preg_match_all('/pointer-events-none[^"]*"[^>]*aria-hidden="true"/', $content, $matches);
    expect($matches[0])->toHaveCount(1);
});

test('welcome page CTA buttons retain hover scale effect alongside animations', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // All three buttons should have both hover:scale-105 and animate-fade-in-up
    preg_match_all('/class="[^"]*hover:scale-105[^"]*animate-fade-in-up[^"]*"/', $content, $matches);
    expect($matches[0])->toHaveCount(3);
});

test('welcome page security icons render as img tags', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // Security icons should be <img> elements, not inline <svg>
    preg_match_all('/<img[^>]*welcome-security-icon[^>]*>/', $content, $matches);
    expect($matches[0])->toHaveCount(10);

    // Should not contain inline SVG security symbols
    expect($content)->not->toContain('<svg class="welcome-security-icon');
});

test('welcome page security icons reference correct SVG asset paths', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    $icons = ['shield', 'lock', 'phone', 'globe', 'key'];

    foreach ($icons as $icon) {
        $response->assertSee("images/icons/{$icon}.svg", false);
    }
});

test('welcome page security icons have animation classes for all 10 instances', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    for ($i = 1; $i <= 10; $i++) {
        $response->assertSee("welcome-security-icon--{$i}", false);
    }
});

test('welcome page CSS has mobile animation performance optimizations', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    // GPU acceleration hints are present
    expect($css)->toContain('will-change: background-position')
        ->and($css)->toContain('will-change: transform, opacity')
        ->and($css)->toContain('will-change: transform');

    // Mobile media query reduces gradient background-size
    expect($css)->toContain('background-size: 200% 200%');

    // Mobile media query hides extra decorative shapes
    expect($css)->toContain('.welcome-bg-shape--6')
        ->and($css)->toContain('.welcome-bg-shape--7')
        ->and($css)->toContain('.welcome-bg-shape--8');

    // Mobile media query hides some sparkle particles
    expect($css)->toContain('.welcome-sparkle--3')
        ->and($css)->toContain('.welcome-sparkle--5')
        ->and($css)->toContain('.welcome-sparkle--6');
});

test('welcome page CSS reduced-motion query still disables all animations', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    // Reduced motion media query exists and targets all elements
    expect($css)->toContain('prefers-reduced-motion: reduce')
        ->and($css)->toContain('animation-duration: 0.01ms !important')
        ->and($css)->toContain('animation-iteration-count: 1 !important');
});
