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

test('flyer contains zero hardcoded user-facing text', function () {
    $content = file_get_contents(resource_path('views/pdf/flajer.blade.php'));
    // Strip Blade comments
    $content = preg_replace('/\{\{--.*?--\}\}/s', '', $content);

    // All user-facing text should use __() or translation helpers
    // Check that no Serbian Latin sentences remain as hardcoded text
    $hardcodedStrings = [
        'Kiberkov vodič za bezbednost',
        'Saveti za pametne',
        'zlatna pravila',
        'Ne deli lične podatke',
        'Čuvaj lozinke',
        'Reci odrasloj osobi',
        'Budi ljubazan',
        'Prepoznaj opasnost',
        'Šta da radiš',
        'Nazad na početnu',
        'Skini PDF',
    ];

    foreach ($hardcodedStrings as $string) {
        expect($content)->not->toContain($string, "Found hardcoded text: $string");
    }
});

test('flyer renders correctly in sr-Cyrl locale', function () {
    app()->setLocale('sr-Cyrl');
    $response = $this->get('/sr-Cyrl/flajer');

    $response->assertStatus(200);
    $response->assertSee('Киберков водич за безбедност');
    $response->assertSee('4 златна правила');
    $response->assertSee('Не дели личне податке');
    $response->assertSee('Чувај лозинке у тајности');
    $response->assertSee('Реци одраслој особи');
    $response->assertSee('Буди љубазан на интернету');
    $response->assertSee('Препознај опасност!');
    $response->assertSee('Шта да радиш?');
    $response->assertSee('19833');
});

test('flyer renders correctly in ru locale', function () {
    app()->setLocale('ru');
    $response = $this->get('/ru/flajer');

    $response->assertStatus(200);
    $response->assertSee('Руководство Киберко по безопасности');
    $response->assertSee('4 золотых правила');
    $response->assertSee('Не делись личными данными');
    $response->assertSee('Храни пароли в тайне');
    $response->assertSee('Расскажи взрослому');
    $response->assertSee('Будь вежливым в интернете');
    $response->assertSee('Распознай опасность!');
    $response->assertSee('Что делать?');
    $response->assertSee('19833');
});

test('phone number 19833 is present in all three locales', function () {
    // sr-Latn (default)
    $this->get('/flajer')->assertSee('19833');

    // sr-Cyrl
    app()->setLocale('sr-Cyrl');
    $this->get('/sr-Cyrl/flajer')->assertSee('19833');

    // ru
    app()->setLocale('ru');
    $this->get('/ru/flajer')->assertSee('19833');
});

test('flyer danger signs render in all locales', function () {
    // sr-Latn: 7 danger signs
    $response = $this->get('/flajer');
    $response->assertSee('Neko traži od tebe da pošalješ svoju sliku ili video');
    $response->assertSee('Nikada se ne nalazi uživo');

    // sr-Cyrl
    app()->setLocale('sr-Cyrl');
    $response = $this->get('/sr-Cyrl/flajer');
    $response->assertSee('Неко тражи од тебе да пошаљеш своју слику или видео');
    $response->assertSee('Никада се не налази уживо');

    // ru
    app()->setLocale('ru');
    $response = $this->get('/ru/flajer');
    $response->assertSee('Кто-то просит тебя отправить свою фотографию или видео');
    $response->assertSee('Никогда не встречайся лично');
});

test('flyer back page renders with qr code and url in sr-Cyrl', function () {
    app()->setLocale('sr-Cyrl');
    $response = $this->get('/sr-Cyrl/flajer');

    $response->assertStatus(200);
    $response->assertSee('id="flajer-back"', false);
    $response->assertSee('bezbednost-sa-kiberkom.on-forge.com/sr-Cyrl');
    $response->assertSee('<svg', false);
    $response->assertSee('Посети наш сајт');
    $response->assertSee('Скенирај QR код да отвориш сајт');
});

test('flyer back page renders in ru locale', function () {
    app()->setLocale('ru');
    $response = $this->get('/ru/flajer');

    $response->assertStatus(200);
    $response->assertSee('Посети наш сайт');
    $response->assertSee('Отсканируй QR-код, чтобы открыть сайт');
    $response->assertSee('bezbednost-sa-kiberkom.on-forge.com/ru');
});

test('flyer back page url is a clickable link', function () {
    app()->setLocale('sr-Cyrl');
    $response = $this->get('/sr-Cyrl/flajer');

    $response->assertSee('href="https://bezbednost-sa-kiberkom.on-forge.com/sr-Cyrl"', false);
});

test('flyer back page has page break for print', function () {
    $content = file_get_contents(resource_path('views/pdf/flajer.blade.php'));

    expect($content)->toContain('break-before: page');
});

test('flyer action section renders in all locales', function () {
    // sr-Latn
    $response = $this->get('/flajer');
    $response->assertSee('Uvek reci');
    $response->assertSee('Zapamti: ti si hrabar/hrabra');

    // sr-Cyrl
    app()->setLocale('sr-Cyrl');
    $response = $this->get('/sr-Cyrl/flajer');
    $response->assertSee('Увек реци');
    $response->assertSee('Запамти: ти си храбар/храбра');

    // ru
    app()->setLocale('ru');
    $response = $this->get('/ru/flajer');
    $response->assertSee('Всегда расскажи');
    $response->assertSee('Запомни: ты смелый/смелая');
});
