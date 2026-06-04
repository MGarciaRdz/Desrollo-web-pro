<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $allowed = false;

        if ($role === 'Admin' && $user->isAdmin()) {
            $allowed = true;
        }

        if ($role === 'Usuario' && $user->isUsuario()) {
            $allowed = true;
        }

        if ($role === 'Invitado' && $user->isInvitado()) {
            $allowed = true;
        }

        if (! $allowed) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para acceder a esa sección.');
        }

        return $next($request);
    }
}
