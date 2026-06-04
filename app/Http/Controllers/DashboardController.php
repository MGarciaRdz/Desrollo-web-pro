<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard according to the user's role.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return view('dashboard.admin');
        }

        if ($user->isUsuario()) {
            return view('dashboard.usuario');
        }

        if ($user->isInvitado()) {
            return view('dashboard.invitado');
        }

        abort(403);
    }
}
