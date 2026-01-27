<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Menu;

class CheckMenuAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user) abort(403);

        if ($user->super) return $next($request); // super admin bypass

        $routeName = $request->route()->getName();

        if (! $routeName) return $next($request);

        $menu = Menu::where('route', $routeName)->first();

        if (! $menu) return $next($request);

        $hasAccess = $menu->roles()
            ->whereIn('roles.id', $user->roles->pluck('id'))
            ->exists();

        if (! $hasAccess) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}


