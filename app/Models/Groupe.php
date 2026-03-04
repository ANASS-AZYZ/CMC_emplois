<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Groupe extends Model
{
    protected $fillable = [
        'code',
        'filiere_id',
        'annee'
    ];

    /**
     * Un groupe appartient à une seule filière.
     */
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }
}