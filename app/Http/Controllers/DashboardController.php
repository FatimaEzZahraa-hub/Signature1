<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Signataire;

class DashboardController extends Controller
{
    public function index()
    {
        $documents = Document::with('signataires')
            ->where('user_id', auth()->id())  // Filtrage par utilisateur connecté
            ->latest()
            ->take(5)
            ->get();
        $contacts = Signataire::latest()->take(5)->get();

        return view('dashboard', compact('documents', 'contacts'));
    }

}
