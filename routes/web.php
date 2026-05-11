<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio.home');
});

Route::middleware('auth')->group(function (): void {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});
