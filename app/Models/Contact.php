<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'signataires';
    
    protected $fillable = [
        'name',
        'email',
        'telephone'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_signataire', 'signataire_id', 'user_id');
    }
} 