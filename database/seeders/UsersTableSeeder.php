<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use Illuminate\Support\Facades\Hash;
    use App\Models\User;

    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'administrateur'
        ]);

        // Enseignant
        User::create([
            'name' => 'Professeur Youssef',
            'email' => 'enseignant1@example.com',
            'password' => Hash::make('enseignant123'),
            'role' => 'enseignant'
        ]);

        // Étudiant
        User::create([
            'name' => 'Étudiant Fatima',
            'email' => 'etudiant1@example.com',
            'password' => Hash::make('etudiant123'),
            'role' => 'etudiant'
        ]);
    }

}
