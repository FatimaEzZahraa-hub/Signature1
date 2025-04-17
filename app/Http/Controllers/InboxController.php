<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InboxController extends Controller
{
    public function index()
    {
        $documents = Document::whereHas('signataires', function($query) {
            $query->where('email', auth()->user()->email);
        })->orderBy('created_at', 'desc')->get();

        return view('inbox.index', compact('documents'));
    }

    public function sign(Request $request, Document $document)
    {
        // Vérifier que l'utilisateur est autorisé à signer
        if ($document->recipient_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Non autorisé'], 403);
        }

        // Sauvegarder la signature
        $signatureData = $request->input('signature');
        $signatureImage = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureImage = str_replace(' ', '+', $signatureImage);
        $signatureName = 'signatures/' . uniqid() . '.png';
        
        Storage::put($signatureName, base64_decode($signatureImage));

        // Mettre à jour le document
        $document->update([
            'status' => 'signed',
            'signature_path' => $signatureName,
            'signed_at' => now()
        ]);

        return response()->json(['success' => true]);
    }

    public function reject(Document $document)
    {
        // Vérifier que l'utilisateur est autorisé à rejeter
        if ($document->recipient_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Non autorisé'], 403);
        }

        $document->update([
            'status' => 'rejected',
            'rejected_at' => now()
        ]);

        return response()->json(['success' => true]);
    }
} 