<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seance extends Model
{
    protected $fillable = [
        'groupe_id',
        'formateur_id',
        'salle_id',
        'jour',
        'creneau',
        'mode',
        'formateur_present',
    ];

    public function groupe(): BelongsTo { return $this->belongsTo(Groupe::class); }
    public function formateur(): BelongsTo { return $this->belongsTo(Formateur::class); }
    public function salle(): BelongsTo { return $this->belongsTo(Salle::class)->withDefault(['code' => 'N/A']); }
}