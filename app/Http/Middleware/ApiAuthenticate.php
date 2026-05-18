<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class ApiAuthenticate
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (! Auth::check()) {
            return new JsonResponse(['message' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}
