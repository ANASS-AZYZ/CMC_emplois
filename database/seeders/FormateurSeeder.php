<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $formateurs = [
        [
            'matricule' => 'M12345',
            'nom' => 'FRITET',
            'prenom' => 'IMANE',
            'email_professionnel' => 'imane.fritet@ofppt.ma',
            'telephone' => '0611223344',
            'specialite' => 'Web Full Stack'
        ],
        [
            'matricule' => 'M67890',
            'nom' => 'GUELSA',
            'prenom' => 'MOUNA',
            'email_professionnel' => 'mouna.guelsa@ofppt.ma',
            'telephone' => '0655667788',
            'specialite' => 'Digital Design'
        ]
    ];

    foreach ($formateurs as $f) {
        \App\Models\Formateur::create($f);
    }
}
}
