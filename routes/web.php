<?php

use App\Http\Controllers\ShortLinkRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{code}', ShortLinkRedirectController::class)
    ->where('code', '[A-Za-z0-9]{6,32}')
    ->name('short-links.redirect');
