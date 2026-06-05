<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTwoFactorVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->two_factor_confirmed_at && ! $request->session()->get('2fa.passed')) {
            if ($request->routeIs('two-factor.*')) {
                return $next($request);
            }

            if ($user->isAdmin()) {
                return redirect()->route('two-factor.admin');
            }

            if ($user->isUsuario()) {
                return redirect()->route('two-factor.user');
            }
        }

        return $next($request);
    }
}
