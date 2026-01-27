<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        // pastikan relasi ada
        $user->loadMissing('roles');

        if ($user->super) {
            return $next($request);
        }

        if (!$user->hasAnyRole($roles)) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}
