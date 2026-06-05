<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UsuarioDashboardController;
use App\Http\Controllers\InvitadoDashboardController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['2fa.enabled', '2fa.verified'])
        ->name('dashboard');

    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])
        ->middleware(['role:Admin', '2fa.enabled', '2fa.verified'])
        ->name('dashboard.admin');

    Route::get('/dashboard/usuario', [UsuarioDashboardController::class, 'index'])
        ->middleware(['role:Usuario', '2fa.enabled', '2fa.verified'])
        ->name('dashboard.usuario');

    Route::get('/dashboard/invitado', [InvitadoDashboardController::class, 'index'])
        ->middleware('role:Invitado')
        ->name('dashboard.invitado');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/profile/two-factor/generate', [TwoFactorController::class, 'generate'])
        ->name('profile.two-factor.generate');

    Route::post('/profile/two-factor/confirm', [TwoFactorController::class, 'confirm'])
        ->name('profile.two-factor.confirm');

    Route::get('/two-factor/user', [TwoFactorController::class, 'showUserVerify'])
        ->name('two-factor.user');

    Route::get('/two-factor/admin', [TwoFactorController::class, 'showAdminVerify'])
        ->name('two-factor.admin');

    Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])
        ->name('two-factor.verify');
});

require __DIR__.'/auth.php';
