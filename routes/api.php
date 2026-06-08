<?php

use App\Http\Controllers\Api\V1\BioController;
use App\Http\Controllers\Api\V1\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('force.json')->group(function (): void {
    Route::get('/portfolio', [PortfolioController::class, 'show']);
    Route::get('/stats', [PortfolioController::class, 'stats']);

    Route::middleware('api.auth')->group(function (): void {
        Route::get('/bio', [BioController::class, 'show']);
        Route::put('/bio', [BioController::class, 'update']);
    });
});
