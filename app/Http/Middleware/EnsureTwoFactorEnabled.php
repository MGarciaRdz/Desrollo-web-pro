<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTwoFactorEnabled
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }
        

        if (
            
            $user->isUsuario()
            && !$user->two_factor_confirmed_at
        ) {
            return redirect()
                ->route('profile.edit')
                ->with(
                    'error',
                    'Debes activar la autenticación de dos factores.'
                );
        }

        return $next($request);
    }
}
