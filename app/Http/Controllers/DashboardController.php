<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DashboardController extends Controller
{
    public function index()
    {
        $documents = Document::with('signataires')->latest()->take(5)->get();
        return view('dashboard', compact('documents'));
    }
}
