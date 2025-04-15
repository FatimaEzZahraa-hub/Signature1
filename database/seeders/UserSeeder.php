<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@edusign.com',
            'password' => Hash::make('password'),
            'role' => 'administrateur'
        ]);

        User::create([
            'name' => 'Enseignant Test',
            'email' => 'enseignant@edusign.com',
            'password' => Hash::make('password'),
            'role' => 'enseignant'
        ]);

        User::create([
            'name' => 'Étudiant Test',
            'email' => 'etudiant@edusign.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant'
        ]);
    }
}
