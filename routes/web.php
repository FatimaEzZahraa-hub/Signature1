<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignataireController;

// Auth Laravel
Auth::routes();

// Accueil
Route::get('/', fn() => view('accueil'));

// Connexion personnalisée
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);

// Routes protégées
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Compte utilisateur
    Route::get('/account', [UserController::class, 'showAccount'])->name('account');
    Route::put('/account', [UserController::class, 'updateAccount'])->name('account.update');
    Route::post('/upload-photo', [UserController::class, 'uploadPhoto'])->name('account.uploadPhoto');

    // Documents
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/{document}/voir', [DocumentController::class, 'voir'])->name('documents.voir');

    // Signataires
    Route::get('/signataires/create', [SignataireController::class, 'create'])->name('signataires.create');
    Route::post('/signataires', [SignataireController::class, 'store'])->name('signataires.store');
});

// Déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
