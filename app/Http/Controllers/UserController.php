<?php

//UserController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showAccount()
    {
        return view('account');
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed|min:8',
            // Retirer l'avatar_color
        ]);

        // Mise à jour des infos
        $user->update([
            'last_name' => $validated['nom'],
            'first_name' => $validated['prenom'],
            'email' => $validated['email'],
            'phone' => $validated['telephone'],
            // Ne pas mettre à jour l'avatar_color
        ]);

        // Mise à jour mot de passe
        if ($request->filled('new_password')) {
            $user->password = Hash::make($validated['new_password']);
            $user->save();
        }

        return redirect()->route('dashboard')->with('success', 'Profil mis à jour avec succès.');
    }

}
