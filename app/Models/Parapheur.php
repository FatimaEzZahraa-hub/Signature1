<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parapheur extends Model
{
    protected $fillable = ['nom', 'description', 'status'];

    public function getStatusAttribute()
    {
        // Si tous les documents sont signés, le parapheur est considéré comme signé
        if ($this->documents()->count() === 0) {
            return 'en_attente';
        }
        return $this->documents()->where('document_parapheur.status', 'en_attente')->exists() ? 'en_attente' : 'signé';
    }

    public function signataires()
    {
        return $this->belongsToMany(Signataire::class)
                    ->withPivot('status', 'signed_at')
                    ->withTimestamps();
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class)
                    ->withPivot('status', 'updated_at')
                    ->withTimestamps();
    }
}
