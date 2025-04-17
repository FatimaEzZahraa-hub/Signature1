<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parapheur extends Model
{
    protected $fillable = ['nom', 'description'];

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
