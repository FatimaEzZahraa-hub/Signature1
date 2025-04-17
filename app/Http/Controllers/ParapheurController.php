<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parapheur;
use App\Models\Document;

class ParapheurController extends Controller
{
    public function index()
    {
        $parapheurs = Parapheur::withCount('documents')->get();
        return view('parapheur.index', compact('parapheurs'));
    }

    public function create()
    {
        $documents = Document::all();
        return view('parapheur.create', compact('documents'));
    }

    public function store(Request $r)
    {
        $r->validate([ 'nom'=>'required', 'description'=>'nullable' ]);
        Parapheur::create($r->only('nom','description'));
        return redirect()->route('parapheur.index');
    }

    public function show(Parapheur $parapheur)
    {
        $parapheur->load('documents', 'signataires');
        return view('parapheur.show', compact('parapheur'));
    }

    public function destroy(Parapheur $parapheur)
    {
        $parapheur->delete();
        return back();
    }

    public function addDocument(Request $request, Parapheur $parapheur)
    {
        $request->validate([
            'existing_document_id' => 'nullable|exists:documents,id',
            'new_document' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->has('existing_document_id') && $request->existing_document_id) {
            $document = Document::find($request->existing_document_id);
            if (!$parapheur->documents->contains($document->id)) {
                $parapheur->documents()->attach($document->id, [
                    'status' => 'en_attente',
                    'updated_at' => now()
                ]);
            }
        }

        if ($request->hasFile('new_document')) {
            $file = $request->file('new_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');

            $document = Document::create([
                'titre' => $file->getClientOriginalName(),
                'fichier' => $filename,
                'user_id' => auth()->id()
            ]);

            $parapheur->documents()->attach($document->id, [
                'status' => 'en_attente',
                'updated_at' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Document(s) ajouté(s) avec succès');
    }

    public function removeDocument(Parapheur $p, Document $d)
    {
        $p->documents()->detach($d->id);
        return back();
    }
}