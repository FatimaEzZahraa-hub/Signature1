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
        'fichier',  // au lieu de path
        'due_date',
        'status',
      ];
    
    public function signataires()
    {
        return $this->belongsToMany(Signataire::class)
                    ->withPivot('signed_at')
                    ->withTimestamps();
    }

    // Pour télécharger le fichier
    public function getDownloadUrl()
    {
        return Storage::url($this->path);
    }
}
