<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FiliereSeeder::class,
            SalleSeeder::class,
            FormateurSeeder::class,
            GroupeSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'admin@cmc.ma'],
            [
                'name' => 'Anass Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::query()
            ->where('role', 'admin')
            ->where('email', '!=', 'admin@cmc.ma')
            ->update(['role' => 'formateur']);
    }
}