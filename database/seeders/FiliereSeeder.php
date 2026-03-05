<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    
    public function run(): void
{
    $filieres = [
        ['nom' => 'Digital Design', 'niveau' => '1ère année'],
        ['nom' => 'Développement Digital', 'niveau' => '1ère année'],
        ['nom' => 'Intelligence Artificielle', 'niveau' => '1ère année'],
        ['nom' => 'Infrastructure Digitale', 'niveau' => '1ère année'],
        ['nom' => 'Web Full Stack', 'niveau' => '2ème année'],
        ['nom' => 'Applications Mobiles', 'niveau' => '2ème année'],
        ['nom' => 'UI Designer', 'niveau' => '2ème année'],
        ['nom' => 'UX Designer', 'niveau' => '2ème année'],
        ['nom' => 'Cyber sécurité', 'niveau' => '2ème année'],
        ['nom' => 'Systèmes et Réseaux', 'niveau' => '2ème année'],
    ];

    foreach ($filieres as $filiere) {
        \App\Models\Filiere::updateOrCreate(
            [
                'nom' => $filiere['nom'],
                'niveau' => $filiere['niveau'],
            ],
            $filiere
        );
    }
}
}

