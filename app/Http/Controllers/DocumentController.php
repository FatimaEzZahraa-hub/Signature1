<?php
// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Signataire;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $documents = Document::when($q, fn($qBuilder) =>
            $qBuilder->where('name','like', "%{$q}%")
        )->with('signataires')->latest()->paginate(10);

        return view('documents.index', compact('documents'));
        
        $documents = Document::all();
        return view('dashboard', compact('documents'));
    }

    public function create()
    {
        $signataires = Signataire::all();
        return view('documents.create', compact('signataires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'file'         => 'required|file|mimes:pdf,doc,docx',
            'signataires'  => 'array',
            'signataires.*'=> 'exists:signataires,id',
        ]);

        // stocke le fichier
        $path = $request->file('file')->store('documents');

        // crée le document
        $doc = Document::create([
            'name'   => $request->name,
            'path'   => $path,
            'status' => 'en attente',
        ]);

        // attache les signataires
        if ($request->filled('signataires')) {
            $doc->signataires()->attach($request->signataires);
        }

        return redirect()->route('documents.index')
                         ->with('success','Document créé.');
    }

    public function show(Document $document)
    {
        $document->load('signataires');
        return view('documents.show', compact('document'));
    }

    public function download(Document $document)
    {
        if (!Storage::exists($document->path)) {
            return back()->with('error', 'Le fichier n\'existe pas.');
        }

        return Storage::download($document->path, $document->name . $this->getFileExtension($document->path));
    }

    private function getFileExtension($path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return $extension ? '.' . $extension : '';
    }
}
