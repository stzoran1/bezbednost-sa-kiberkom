<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::slidewire('/prezentacija', 'prezentacija');
Route::livewire('/igra', 'pages::igra.index');
