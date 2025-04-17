<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Contact;
use App\Models\Parapheur;    // ← AJOUT
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $contacts   = Auth::user()->contacts;             // ou ta logique existante
        $documents  = Document::latest()->take(5)->get();  // ou ta logique
        $parapheurs = Parapheur::latest()->get();         // ← AJOUT

        return view('dashboard', compact('contacts','documents','parapheurs'));
    }
}
