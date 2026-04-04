<?php

/**
 * Recursively flatten a nested array into dot-notation keys.
 */
function flattenKeys(array $array, string $prefix = ''): array
{
    $keys = [];

    foreach ($array as $key => $value) {
        $fullKey = $prefix === '' ? (string) $key : "{$prefix}.{$key}";

        if (is_array($value)) {
            $keys = array_merge($keys, flattenKeys($value, $fullKey));
        } else {
            $keys[] = $fullKey;
        }
    }

    return $keys;
}

$translationFiles = ['messages', 'welcome', 'presentation', 'game', 'flyer'];
$referenceLocale = 'sr-Latn';
$targetLocales = ['sr-Cyrl', 'ru'];

foreach ($translationFiles as $file) {
    foreach ($targetLocales as $targetLocale) {
        test("{$targetLocale}/{$file}.php has all keys from {$referenceLocale}/{$file}.php", function () use ($file, $referenceLocale, $targetLocale) {
            $referencePath = lang_path("{$referenceLocale}/{$file}.php");
            $targetPath = lang_path("{$targetLocale}/{$file}.php");

            expect(file_exists($referencePath))->toBeTrue("Reference file {$referencePath} does not exist");
            expect(file_exists($targetPath))->toBeTrue("Target file {$targetPath} does not exist");

            $referenceKeys = flattenKeys(require $referencePath);
            $targetKeys = flattenKeys(require $targetPath);

            $missingKeys = array_diff($referenceKeys, $targetKeys);

            expect($missingKeys)->toBeEmpty(
                "Missing keys in {$targetLocale}/{$file}.php: ".implode(', ', $missingKeys)
            );
        });
    }
}

test('all locale directories have the same translation files', function () use ($referenceLocale, $targetLocales) {
    $referenceFiles = collect(scandir(lang_path($referenceLocale)))
        ->filter(fn ($f) => str_ends_with($f, '.php'))
        ->map(fn ($f) => str_replace('.php', '', $f))
        ->sort()
        ->values()
        ->all();

    foreach ($targetLocales as $locale) {
        $localeFiles = collect(scandir(lang_path($locale)))
            ->filter(fn ($f) => str_ends_with($f, '.php'))
            ->map(fn ($f) => str_replace('.php', '', $f))
            ->sort()
            ->values()
            ->all();

        expect($localeFiles)->toBe($referenceFiles, "Locale {$locale} has different translation files than {$referenceLocale}");
    }
});
