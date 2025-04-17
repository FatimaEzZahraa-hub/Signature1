<?php
// app/Models/Document.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class Document extends Model
{
    protected $fillable = [
        'titre',    // au lieu de name
        'description',
        'fichier',  // Added fichier field
        'path',
        'user_id',  // Ajout de l'utilisateur propriétaire
        'recipient_id',
        'status',
        'signature_path',
        'signed_at',
        'rejected_at'
    ];

    protected $dates = [
        'signed_at',
        'rejected_at'
    ];

    public function signataires()
    {
        return $this->belongsToMany(Signataire::class)
                    ->withPivot('signed_at')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function getSenderEmailAttribute()
    {
        return $this->user->email;
    }

    // Pour télécharger le fichier
    public function getDownloadUrl()
    {
        return Storage::url($this->path);
    }

    public function store(Request $request)
    {
        try {
            // Opération risquée
        } catch (Exception $e) {
            Log::error('Erreur lors de la création du document', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Une erreur est survenue');
        }
    }

    public function test_document_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('documents.store'), [
            'titre' => 'Test Document',
            'file' => UploadedFile::fake()->create('document.pdf')
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('documents', ['titre' => 'Test Document']);
    }
}
