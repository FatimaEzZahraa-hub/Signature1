<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Auth::routes(); // Ajoute automatiquement login, register, password.request, etc.

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('accueil');
});

Route::get('/connexion', function () {
    return view('connexion');
})->name('connexion');







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'login']);


