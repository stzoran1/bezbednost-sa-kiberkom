<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

test('qr code package generates svg output for target url', function () {
    $url = 'https://bezbednost-sa-kiberkom.on-forge.com';
    $svg = QrCode::format('svg')->size(300)->generate($url);

    expect((string) $svg)
        ->toContain('<svg')
        ->toContain('</svg>')
        ->toContain('viewBox');
});

test('qr code package generates high resolution svg suitable for print', function () {
    $url = 'https://bezbednost-sa-kiberkom.on-forge.com';
    $svg = QrCode::format('svg')->size(600)->generate($url);

    $svgString = (string) $svg;

    expect($svgString)
        ->toContain('width="600"')
        ->toContain('height="600"');
});
