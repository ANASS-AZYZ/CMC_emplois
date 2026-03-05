<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    
    public function run(): void
{
    for ($i = 1; $i <= 6; $i++) {
        \App\Models\Salle::create([
            'code' => 'SC-' . str_pad($i, 2, '0', STR_PAD_LEFT),
            'type' => 'SC',
            'capacite' => 30
        ]);
    }
    for ($i = 1; $i <= 10; $i++) {
        \App\Models\Salle::create([
            'code' => 'SM-' . str_pad($i, 2, '0', STR_PAD_LEFT),
            'type' => 'SM',
            'capacite' => 20
        ]);
    }
}
}

