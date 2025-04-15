<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\Signataire;
use Illuminate\Support\Facades\Storage;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer quelques signataires de test
        $signataire1 = Signataire::create([
            'name' => 'Professeur Dupont',
            'email' => 'prof.dupont@example.com'
        ]);

        $signataire2 = Signataire::create([
            'name' => 'Étudiant Martin',
            'email' => 'etudiant.martin@example.com'
        ]);

        // Créer des documents de test
        $documents = [
            [
                'titre' => 'Contrat de stage',
                'description' => 'Contrat de stage pour l\'année 2024',
                'fichier' => 'documents/contrat_stage.pdf',
                'status' => 'en attente',
                'due_date' => now()->addDays(30)
            ],
            [
                'titre' => 'Convention de partenariat',
                'description' => 'Convention entre l\'établissement et une entreprise',
                'fichier' => 'documents/convention.pdf',
                'status' => 'signé',
                'due_date' => now()->addDays(15)
            ],
            [
                'titre' => 'Règlement intérieur',
                'description' => 'Règlement intérieur de l\'établissement',
                'fichier' => 'documents/reglement.pdf',
                'status' => 'brouillon',
                'due_date' => null
            ]
        ];

        foreach ($documents as $documentData) {
            $document = Document::create($documentData);
            
            // Associer les signataires au document
            $document->signataires()->attach([
                $signataire1->id,
                $signataire2->id
            ]);
        }
    }
}
