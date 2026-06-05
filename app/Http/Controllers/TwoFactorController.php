<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TwoFactorController extends Controller
{
    public function generate(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->two_factor_confirmed_at) {
            return redirect()->route('profile.edit')
                ->with('status', 'La autenticación de dos factores ya está activada.');
        }

        if (! $user->two_factor_secret) {
            $secret = app('pragmarx.google2fa')->generateSecretKey();
            $user->two_factor_secret = $secret;
            $user->save();
        }

        return redirect()->route('profile.edit')
            ->with('google2fa_qr', app('pragmarx.google2fa')->getQRCodeInline(
                config('app.name'),
                $user->email,
                $user->two_factor_secret
            ))
            ->with('google2fa_secret', $user->two_factor_secret);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $request->validate([
            'one_time_password' => ['required', 'digits:6'],
        ]);

        $user = $request->user();

        if (! $user->two_factor_secret) {
            return redirect()->route('profile.edit')
                ->with('error', 'Primero debes generar el código QR para Google Authenticator.');
        }

        $valid = app('pragmarx.google2fa')->verifyKey(
            $user->two_factor_secret,
            $request->input('one_time_password')
        );

        if (! $valid) {
            return back()->withErrors([
                'one_time_password' => 'El código de Google Authenticator no es válido.',
            ]);
        }

        $user->two_factor_confirmed_at = now();
        $user->save();

        return redirect()->route('profile.edit')
            ->with('status', 'Google Authenticator se ha activado correctamente.');
    }

    public function showUserVerify(Request $request): View
    {
        $user = $request->user();

        if (! $user || ! $user->two_factor_confirmed_at || ! $user->isUsuario()) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-user');
    }

    public function showAdminVerify(Request $request): View
    {
        $user = $request->user();

        if (! $user || ! $user->two_factor_confirmed_at || ! $user->isAdmin()) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-admin');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'one_time_password' => ['required', 'digits:6'],
        ]);

        $user = $request->user();

        if (! $user || ! $user->two_factor_secret || ! $user->two_factor_confirmed_at) {
            return redirect()->route('login');
        }

        $valid = app('pragmarx.google2fa')->verifyKey(
            $user->two_factor_secret,
            $request->input('one_time_password')
        );

        if (! $valid) {
            return back()->withErrors([
                'one_time_password' => 'El código de Google Authenticator no es válido.',
            ]);
        }

        $request->session()->put('2fa.passed', true);

        if ($user->isAdmin()) {
            return redirect()->intended(route('dashboard.admin'));
        }

        if ($user->isUsuario()) {
            return redirect()->intended(route('dashboard.usuario'));
        }

        return redirect()->intended(route('dashboard'));
    }
}
