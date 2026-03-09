<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groupe extends Model
{
    protected $fillable = [
        'code',
        'filiere_id',
        'annee'
    ];

    
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }
}
