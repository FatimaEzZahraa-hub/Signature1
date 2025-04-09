<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Exemple dans UserController.php
public function showAccount() {
    return view('account');  // Affiche la vue account.blade.php
}

public function updateAccount(Request $request) {
    $user = Auth::user();

    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telephone' => 'nullable|string',
        'old_password' => 'nullable|string',
        'new_password' => 'nullable|string|confirmed|min:8',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Mise à jour des données de l'utilisateur
    $user->update([
        'last_name' => $validated['nom'],
        'first_name' => $validated['prenom'],
        'email' => $validated['email'],
        'phone' => $validated['telephone'],
    ]);

    // Mise à jour du mot de passe si fourni
    if ($request->filled('new_password')) {
        $user->password = bcrypt($validated['new_password']);
    }

    // Upload de la photo si fournie
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('profile_photos', 'public');
        $user->photo = $photoPath;
    }

    $user->save();

    return redirect()->route('account')->with('success', 'Profil mis à jour avec succès.');
}
public function uploadPhoto(Request $request) {
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user = Auth::user();
    $photoPath = $request->file('photo')->store('profile_photos', 'public');
    $user->photo = $photoPath;
    $user->save();

    return response()->json(['success' => true, 'photoUrl' => asset('storage/' . $photoPath)]);
}


}
