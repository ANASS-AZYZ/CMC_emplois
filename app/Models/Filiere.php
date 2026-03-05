<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filiere extends Model
{
    protected $fillable = [
        'nom',
        'niveau'
    ];

    
    public function groupes(): HasMany
    {
        return $this->hasMany(Groupe::class);
    }
}
