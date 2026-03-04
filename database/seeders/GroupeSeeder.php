<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Ghadi n-akhdou l-ID dyal Web Full Stack
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
