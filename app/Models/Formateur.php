<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;
public function user()
{
    return $this->belongsTo(User::class);
}
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email_professionnel', 
        'telephone',
        'specialite',
    ];
}