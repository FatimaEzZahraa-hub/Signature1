<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Signataire;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $query = Document::query();

        // On filtre toujours par l'utilisateur connecté
        $query->where('user_id', auth()->id());

        // Recherche
        if (request('q')) {
            $query->where('titre', 'like', request('q') . '%');
        }        

        // Filtre par statut
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Tri
        switch (request('sort')) {
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('titre', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('titre', 'desc');
                break;
            case 'date_desc':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $documents = $query->with('signataires')->paginate(10);

        return view('documents.index', compact('documents'));
    }


    public function create()
    {
        $signataires = Signataire::all();
        
        // Sauvegarder les données du formulaire si elles existent
        if (session()->has('document_form_data')) {
            session()->keep(['document_form_data']);
        }
        
        return view('documents.create', compact('signataires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'file'         => 'required|file|mimes:pdf,doc,docx',
            'due_date'     => 'nullable|date',
            'signataires'  => 'array',
            'signataires.*'=> 'exists:signataires,id',
        ]);

        $path = $request->file('file')->store('documents', 'public');

        $doc = Document::create([
            'titre'       => $request->titre,
            'description' => $request->description,
            'fichier'     => $path,
            'due_date'    => $request->due_date,
            'status'      => 'Brouillon',
            'user_id'     => auth()->id(),
        ]);        

        if ($request->filled('signataires')) {
            $doc->signataires()->attach($request->signataires);
        }

        return redirect()->route('documents.index')
                        ->with('success', 'Document créé.');
    }

    public function show(Document $document)
    {
        // Vérifier que le document appartient bien à l'utilisateur connecté
        if ($document->user_id !== auth()->id()) {
            abort(403, 'Accès non autorisé.');
        }

        $document->load('signataires');
        return view('documents.show', compact('document'));
    }

    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->fichier)) {
            return back()->with('error', 'Le fichier n\'existe pas.');
        }

        return Storage::disk('public')->download($document->fichier);
    }

    public function voir(Document $document)
    {
        if (!Storage::disk('public')->exists($document->fichier)) {
            abort(404, 'Fichier introuvable');
        }

        $mimeType = Storage::disk('public')->mimeType($document->fichier);
        $content = Storage::disk('public')->get($document->fichier);

        return response($content, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="'.basename($document->fichier).'"');
    }

    public function destroy(Document $document)
    {
        // Supprimer le fichier du stockage
        if (Storage::disk('public')->exists($document->fichier)) {
            Storage::disk('public')->delete($document->fichier);
        }

        // Supprimer les relations avec les signataires
        $document->signataires()->detach();

        // Supprimer le document de la base de données
        $document->delete();

        return redirect()->route('documents.index')
                        ->with('success', 'Document supprimé avec succès.');
    }

    public function saveFormData(Request $request)
    {
        session()->put('document_form_data', $request->all());
        return response()->json(['success' => true]);
    }
}
