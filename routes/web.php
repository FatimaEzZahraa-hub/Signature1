<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;

// Auth routes
Auth::routes(); // login, register, reset password, etc.

// Page d'accueil (évite le doublon)
Route::get('/', function () {
    return view('accueil'); // ou 'welcome' si tu préfères
});

// Connexion personnalisée
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);

// Routes protégées par auth
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profil utilisateur
    Route::get('/account', [UserController::class, 'showAccount'])->name('account');
    Route::put('/account', [UserController::class, 'updateAccount'])->name('account.update');
    Route::post('/upload-photo', [UserController::class, 'uploadPhoto'])->name('account.uploadPhoto');
    
    // Documents
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
});

// Déconnexion et redirection vers la page d'accueil
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');




