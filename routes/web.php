<?php

use App\Http\Controllers\BioController;
use App\Http\Controllers\PostController;
use App\Models\Bio;
use App\Models\Post;
use Illuminate\Http\Request;
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
    Route::get('/dashboard', function (Request $request) {
        $bio = Bio::query()->where('user_id', $request->user()->id)->first();
        $postsQuery = Post::query()->where('user_id', $request->user()->id);

        return view('dashboard', [
            'bio' => $bio,
            'posts' => (clone $postsQuery)->latest()->limit(5)->get(),
            'draftCount' => (clone $postsQuery)->where('status', 'draft')->count(),
            'publishedCount' => (clone $postsQuery)->where('status', 'published')->count(),
        ]);
    })->name('dashboard');

    Route::get('/bio', [BioController::class, 'edit'])->name('bio.edit');
    Route::put('/bio', [BioController::class, 'update'])->name('bio.update');

    Route::resource('posts', PostController::class);
    Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
});
