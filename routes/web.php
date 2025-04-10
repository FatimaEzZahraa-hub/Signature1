<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

// Auth routes
Auth::routes(); // login, register, reset password, etc.

// Page d'accueil (évite le doublon)
Route::get('/', function () {
    return view('accueil'); // ou 'welcome' si tu préfères
});

// Connexion personnalisée
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);

// Dashboard (protégé par auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil utilisateur
    Route::get('/account', [UserController::class, 'showAccount'])->name('account');
    Route::put('/account', [UserController::class, 'updateAccount'])->name('account.update');
    Route::post('/upload-photo', [UserController::class, 'uploadPhoto'])->name('account.uploadPhoto');
});

// Déconnexion et redirection vers la page d'accueil
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


