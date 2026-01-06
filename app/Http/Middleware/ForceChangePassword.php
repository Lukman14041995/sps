<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceChangePassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (
            $user &&
            $user->must_change_password &&
            ! $request->routeIs(
                'password.change.form',
                'password.change.update',
                'logout'
            )
        ) {
            return redirect()->route('password.change.form')
                ->with('warning', 'Silakan ganti password terlebih dahulu.');
        }

        return $next($request);
    }
}
