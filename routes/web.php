<?php

use App\Http\Controllers\BioController;
use App\Http\Controllers\PostController;
use App\Models\Bio;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

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
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/bio', [BioController::class, 'show'])->name('bio.show');
    Route::get('/bio/edit', [BioController::class, 'edit'])->name('bio.edit');
    Route::put('/bio', [BioController::class, 'update'])->name('bio.update');

    Route::resource('posts', PostController::class);
});

// Public bio view for any user (visit /bio/{user})
Route::get('/bio/{user}', [\App\Http\Controllers\BioController::class, 'publicShow'])->name('bio.public');

// Public profiles listing
Route::get('/profiles', [\App\Http\Controllers\BioController::class, 'index'])->name('profiles.index');
