<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(); // Ajoute automatiquement login, register, password.request, etc.

Route::get('/', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('accueil');
});

Route::get('/connexion', function () {
    return view('connexion');
})->name('login');




