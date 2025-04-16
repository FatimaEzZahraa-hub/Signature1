<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrateur');
    }

    public function dashboard()
    {
        $totalEtudiants = User::where('role', 'etudiant')->count();
        $totalEnseignants = User::where('role', 'enseignant')->count();
        $totalDocuments = Document::count();

        return view('admin.dashboard', compact('totalEtudiants', 'totalEnseignants', 'totalDocuments'));
    }

    public function etudiants()
    {
        $etudiants = User::where('role', 'etudiant')->get();
        return view('admin.etudiants.index', compact('etudiants'));
    }

    public function enseignants()
    {
        $enseignants = User::where('role', 'enseignant')->get();
        return view('admin.enseignants.index', compact('enseignants'));
    }

    public function activites()
    {
        $activites = DB::table('activity_log')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.activites', compact('activites'));
    }

    public function createEtudiant()
    {
        return view('admin.etudiants.create');
    }

    public function storeEtudiant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'etudiant',
        ]);

        return redirect()->route('admin.etudiants.index')
            ->with('success', 'Étudiant créé avec succès.');
    }

    public function createEnseignant()
    {
        return view('admin.enseignants.create');
    }

    public function storeEnseignant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'enseignant',
        ]);

        return redirect()->route('admin.enseignants.index')
            ->with('success', 'Enseignant créé avec succès.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
} 