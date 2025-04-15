<?php

// app/Models/Signataire.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signataire extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telephone'
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class)
                    ->withPivot('signed_at')
                    ->withTimestamps();
    }
}
