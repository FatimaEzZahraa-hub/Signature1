<?php

//web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;



Auth::routes(); // Ajoute automatiquement login, register, password.request, etc.

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('accueil');
});

Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');



Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Exemple dans routes/web.php
Route::get('/account', [UserController::class, 'showAccount'])->name('account');
Route::put('/account', [UserController::class, 'updateAccount'])->name('account.update');


Route::post('/upload-photo', [UserController::class, 'uploadPhoto']);
