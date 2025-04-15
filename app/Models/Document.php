<?php
// app/Models/Document.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = [
        'titre',    // au lieu de name
        'description',
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
}
