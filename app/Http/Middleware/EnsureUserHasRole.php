<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
    * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(401);
        }

        $allowedRoles = array_values(array_filter(array_map(
            static fn (string $role): ?UserRole => UserRole::tryFrom($role),
            $roles,
        )));

        if ($allowedRoles === [] || $user->hasAnyRole($allowedRoles)) {
            return $next($request);
        }

        abort(403, 'You do not have permission to access this resource.');
    }
}
