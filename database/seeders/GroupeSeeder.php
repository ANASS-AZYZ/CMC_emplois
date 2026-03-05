<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupeSeeder extends Seeder
{
    
    public function run(): void
{
    $filiereWFS = \App\Models\Filiere::where('nom', 'Web Full Stack')->first();

    \App\Models\Groupe::create([
        'code' => 'DEVOWFS202',
        'filiere_id' => $filiereWFS->id,
        'annee' => '2ème'
    ]);
    
    \App\Models\Groupe::create([
        'code' => 'DEVOWFS201',
        'filiere_id' => $filiereWFS->id,
        'annee' => '2ème'
    ]);
}
}

