<?php

use Illuminate\Support\Facades\Route;

// Routes without locale prefix default to sr-Latn (the default locale).
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::slidewire('/prezentacija', 'prezentacija');
Route::livewire('/igra', 'pages::igra.index');

Route::get('/flajer', fn () => view('pdf.flajer'))->name('flajer');

// Locale-prefixed routes — e.g. /ru/igra, /sr-Cyrl/prezentacija.
Route::prefix('{locale}')
    ->middleware('set-locale')
    ->where(['locale' => 'sr-Cyrl|ru'])
    ->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('locale.home');

        Route::slidewire('/prezentacija', 'prezentacija')->name('locale.slidewire.prezentacija');
        Route::livewire('/igra', 'pages::igra.index');

        Route::get('/flajer', fn () => view('pdf.flajer'))->name('locale.flajer');
    });
