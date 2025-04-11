<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signataire;

class SignataireController extends Controller
{
    public function create()
    {
        return view('signataires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:signataires,email',
        ]);

        Signataire::create([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('documents.create')
                         ->with('success', 'Signataire ajouté. Vous pouvez maintenant le sélectionner.');
    }
}
