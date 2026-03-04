<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    // Hada hwa l-fix bach d-data d-khul l-base de données
    protected $fillable = ['code', 'type', 'capacite'];
}