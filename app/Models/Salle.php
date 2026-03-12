<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'type', 'capacite'];

    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }
}
