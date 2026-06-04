<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/admin', [App\Http\Controllers\AdminDashboardController::class, 'index'])
        ->middleware('role:Admin')
        ->name('dashboard.admin');

    Route::get('/dashboard/usuario', [App\Http\Controllers\UsuarioDashboardController::class, 'index'])
        ->middleware('role:Usuario')
        ->name('dashboard.usuario');

    Route::get('/dashboard/invitado', [App\Http\Controllers\InvitadoDashboardController::class, 'index'])
        ->middleware('role:Invitado')
        ->name('dashboard.invitado');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
