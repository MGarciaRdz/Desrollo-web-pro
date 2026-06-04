<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuarioDashboardController extends Controller
{
    /**
     * Display the usuario dashboard.
     */
    public function index(Request $request): View
    {
        return view('dashboard.usuario');
    }
}
