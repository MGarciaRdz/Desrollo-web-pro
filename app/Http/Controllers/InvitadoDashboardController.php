<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class InvitadoDashboardController extends Controller
{
    /**
     * Display the invitado dashboard.
     */
    public function index(Request $request): View
    {
        return view('dashboard.invitado');
    }
}
