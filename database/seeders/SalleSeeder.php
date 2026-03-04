<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // 6 Salles de Cours (SC)
    for ($i = 1; $i <= 6; $i++) {
        \App\Models\Salle::create([
            'code' => 'SC-' . str_pad($i, 2, '0', STR_PAD_LEFT),
            'type' => 'SC',
            'capacite' => 30
        ]);
    }

    // 10 Salles Multimédia (SM)
    for ($i = 1; $i <= 10; $i++) {
        \App\Models\Salle::create([
            'code' => 'SM-' . str_pad($i, 2, '0', STR_PAD_LEFT),
            'type' => 'SM',
            'capacite' => 20
        ]);
    }
}
}
