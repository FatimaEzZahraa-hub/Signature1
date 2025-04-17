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
        $r->validate([ 
            'nom' => 'required', 
            'description' => 'nullable',
            'existing_document_id' => 'required|exists:documents,id'
        ]);

        $parapheur = Parapheur::create($r->only('nom','description'));
        
        // Ajouter le document obligatoire lors de la création
        $parapheur->documents()->attach($r->existing_document_id, [
            'status' => 'en_attente',
            'updated_at' => now()
        ]);

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
        \Log::info('Request data', ['data' => $request->all()]);
        \Log::info('Files', ['has_files' => $request->file('new_documents') ? true : false]);

        $request->validate([
            'existing_document_ids' => 'nullable|array',
            'existing_document_ids.*' => 'exists:documents,id',
            'new_documents' => 'nullable|array',
            'new_documents.*' => 'file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Vérifier le nombre maximum de documents (15)
        $currentCount = $parapheur->documents()->count();
        $newDocumentsCount = count($request->existing_document_ids ?? []) + count($request->file('new_documents') ?? []);
        
        \Log::info('Document counts', [
            'current' => $currentCount,
            'new' => $newDocumentsCount
        ]);
        
        if ($currentCount + $newDocumentsCount > 15) {
            return redirect()->back()->with('error', 'Un parapheur ne peut pas contenir plus de 15 documents.');
        }

        // Ajouter les documents existants
        if ($request->has('existing_document_ids')) {
            \Log::info('Adding existing documents', ['documents' => $request->existing_document_ids]);
            foreach ($request->existing_document_ids as $documentId) {
                if (!$parapheur->documents->contains($documentId)) {
                    $parapheur->documents()->attach($documentId, [
                        'status' => 'en_attente',
                        'updated_at' => now()
                    ]);
                    \Log::info('Attached document', ['document_id' => $documentId]);
                }
            }
        }

        // Ajouter les nouveaux documents
        if ($request->hasFile('new_documents')) {
            \Log::info('Processing new documents');
            foreach ($request->file('new_documents') as $file) {
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
                \Log::info('Created and attached new document', ['filename' => $filename]);
            }
        }

        return redirect()->back()->with('success', 'Document(s) ajouté(s) avec succès');
    }

    public function removeDocument(Parapheur $p, Document $d)
    {
        $p->documents()->detach($d->id);
        return back();
    }

    public function edit(Parapheur $parapheur)
    {
        $documents = Document::all();
        return view('parapheur.edit', compact('parapheur', 'documents'));
    }

    public function update(Request $request, Parapheur $parapheur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'existing_document_ids' => 'nullable|array',
            'existing_document_ids.*' => 'exists:documents,id'
        ]);

        // Mettre à jour les informations de base
        $parapheur->update($request->only('nom', 'description'));

        // Mettre à jour les documents associés
        if ($request->has('existing_document_ids')) {
            // Détacher tous les documents actuels
            $parapheur->documents()->detach();
            
            // Attacher les nouveaux documents
            foreach ($request->existing_document_ids as $documentId) {
                $parapheur->documents()->attach($documentId, [
                    'status' => 'en_attente',
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('parapheur.show', $parapheur)
            ->with('success', 'Parapheur mis à jour avec succès');
    }

    public function sign(Parapheur $parapheur)
    {
        // Vérifier si tous les documents sont en attente
        $hasUnsignedDocuments = $parapheur->documents()
            ->wherePivot('status', 'en_attente')
            ->exists();

        if (!$hasUnsignedDocuments) {
            return redirect()->back()->with('error', 'Tous les documents sont déjà signés.');
        }

        // Mettre à jour le statut de tous les documents en attente
        $parapheur->documents()
            ->wherePivot('status', 'en_attente')
            ->update([
                'status' => 'signé',
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Tous les documents ont été signés avec succès.');
    }
}