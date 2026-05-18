<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio.home');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::get('/register', [\App\Http\Controllers\Auth\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
});

Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::view('/dashboard', 'portfolio.dashboard')->name('dashboard');
});
