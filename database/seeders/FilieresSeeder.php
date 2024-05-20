<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FilieresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Filieres for Departement 1
        $departement1Filieres = [
            'Cycle Préparatoire Intégré',
            'Génie Informatique',
            'Ingénierie des Données',
            'Transformation Digitale & Intelligence Artificielle',
        ];

        // Filieres for Departement 2
        $departement2Filieres = [
            'Génie Civil',
            'Génie de l\'Eau et de l\'Environnement',
            'Génie Energétique et Energie Renouvelable',
            'Génie Mécanique',
        ];

        // Seed filieres for Departement 1
        $departement1Id = 1;
        $coord = 6;
        foreach ($departement1Filieres as $filiere) {
            DB::table('filieres')->insert([
                'name' => $filiere,
                'departements_id' => $departement1Id,
                'coord' => $coord,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $coord++;
        }

        // Seed filieres for Departement 2
        $departement2Id = 2;
        
        foreach ($departement2Filieres as $filiere) {
            DB::table('filieres')->insert([
                'name' => $filiere,
                'departements_id' => $departement2Id,
                'coord' => $coord,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $coord++;
        }
    }
}
