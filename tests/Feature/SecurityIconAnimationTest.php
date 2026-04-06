<?php

test('security icons render as img elements with animation classes', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // Each security icon should be an <img> element with the welcome-security-icon class
    preg_match_all('/<img[^>]*class="[^"]*welcome-security-icon[^"]*"/', $content, $matches);
    expect($matches[0])->toHaveCount(10);
});

test('security icons have staggered animation classes for all 10 instances', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    for ($i = 1; $i <= 10; $i++) {
        $response->assertSee("welcome-security-icon--{$i}", false);
    }
});

test('security icon img elements load SVG files from correct path', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    $expectedIcons = ['shield', 'lock', 'phone', 'globe', 'key'];

    foreach ($expectedIcons as $icon) {
        $pattern = '/src="[^"]*images\/icons\/'.$icon.'\.svg"/';
        expect(preg_match($pattern, $content))->toBe(1, "Expected {$icon}.svg icon to be referenced");
    }
});

test('security icons are inside aria-hidden container', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // The container div has aria-hidden="true" and pointer-events-none
    // and security icons are within it
    preg_match('/aria-hidden="true"[^>]*>(.+?)<\/div>\s*<div class="text-center/s', $content, $match);
    expect($match)->not->toBeEmpty();
    expect($match[1])->toContain('welcome-security-icon');
});

test('security icons have explicit width and height attributes for stable animation', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    // Each <img> security icon should have width and height attributes
    preg_match_all('/<img[^>]*welcome-security-icon[^>]*>/', $content, $imgMatches);

    foreach ($imgMatches[0] as $img) {
        expect($img)->toContain('width=');
        expect($img)->toContain('height=');
    }
});

test('security icons are decorative with empty alt text', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $content = $response->getContent();

    preg_match_all('/<img[^>]*welcome-security-icon[^>]*>/', $content, $imgMatches);

    foreach ($imgMatches[0] as $img) {
        expect($img)->toContain('alt=""');
        expect($img)->toContain('aria-hidden="true"');
    }
});

test('CSS contains symbol-sparkle keyframes with scale rotate and opacity', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    expect($css)->toContain('@keyframes symbol-sparkle');
    expect($css)->toContain('transform: scale(');
    expect($css)->toContain('rotate(');
    expect($css)->toContain('opacity:');
});

test('CSS contains symbol-drift keyframes with translate movement', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    expect($css)->toContain('@keyframes symbol-drift-1');
    expect($css)->toContain('@keyframes symbol-drift-2');
    expect($css)->toContain('@keyframes symbol-drift-3');
    expect($css)->toContain('@keyframes symbol-drift-4');
    expect($css)->toContain('@keyframes symbol-drift-5');
});

test('CSS has unique animation timing for each security icon instance', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    $timings = [];
    for ($i = 1; $i <= 10; $i++) {
        preg_match('/\.welcome-security-icon--'.$i.'\s*\{[^}]*animation:\s*([^}]+)\}/', $css, $match);
        expect($match)->not->toBeEmpty("Icon --{$i} should have animation rule");
        $timings[] = $match[1];
    }

    // All 10 timings should be unique (staggered)
    expect(array_unique($timings))->toHaveCount(10);
});

test('CSS prefers-reduced-motion disables security icon animations', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    // The reduced-motion block should set security icons to a static visible state
    expect($css)->toContain('prefers-reduced-motion: reduce');

    // Extract the reduced-motion block
    preg_match('/@media\s*\(prefers-reduced-motion:\s*reduce\)\s*\{(.+)\}/s', $css, $match);
    $reducedMotionBlock = $match[1];

    // Should set opacity to visible and disable translate
    expect($reducedMotionBlock)->toContain('.welcome-security-icon');
    expect($reducedMotionBlock)->toContain('opacity: 0.2');
    expect($reducedMotionBlock)->toContain('translate: none');
});

test('CSS mobile styles scale down and hide some security icons', function () {
    $css = file_get_contents(resource_path('css/app.css'));

    // Mobile breakpoint should scale icons down
    expect($css)->toContain('scale: 0.65');

    // Some icons should be hidden on mobile
    expect($css)->toContain('.welcome-security-icon--4');
    expect($css)->toContain('.welcome-security-icon--7');
    expect($css)->toContain('.welcome-security-icon--8');
    expect($css)->toContain('.welcome-security-icon--10');
    expect($css)->toContain('display: none');
});
