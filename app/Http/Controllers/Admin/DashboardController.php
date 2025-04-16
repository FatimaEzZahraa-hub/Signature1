<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrateur');
    }

    public function index()
    {
        $stats = [
            'teachers' => User::where('role', 'enseignant')->count(),
            'students' => User::where('role', 'etudiant')->count(),
            'total_users' => User::where('role', '!=', 'administrateur')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 