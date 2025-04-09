<?php

//App\Http\Controllers\Auth\LoginController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Valider les informations de connexion
        $credentials = $request->only('email', 'password');

        // Authentifier l'utilisateur
        if (Auth::attempt($credentials, $request->remember)) {
            // Si l'authentification réussit, rediriger vers le tableau de bord
            return redirect()->intended('/dashboard');
        }

        // Sinon, retourner un message d'erreur
        return Redirect::back()->withErrors(['email' => 'Les informations de connexion sont incorrectes.']);
    
        
    }
    public function showLoginForm()
    {
        return view('connexion');
    }
}
