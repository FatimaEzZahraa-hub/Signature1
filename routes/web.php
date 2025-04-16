<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignataireController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InboxController;

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

    // Routes pour les contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Boîte de réception et signature
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::post('/documents/{document}/sign', [InboxController::class, 'sign'])->name('documents.sign');
    Route::post('/documents/{document}/reject', [InboxController::class, 'reject'])->name('documents.reject');
});

// Routes pour la gestion des utilisateurs par l'administrateur
Route::middleware(['auth', 'role:administrateur'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserManagementController::class)->except(['edit', 'update']);
});

// Déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
