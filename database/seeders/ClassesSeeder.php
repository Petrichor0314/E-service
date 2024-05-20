<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['name' => 'Première Année Cycle Préparatoire', 'filiere_id' => 1],
            ['name' => 'Deuxième Année Cycle Préparatoire', 'filiere_id' => 1],
            ['name' => 'Génie Civil 1', 'filiere_id' => 5],
            ['name' => 'Génie Civil 2', 'filiere_id' => 5],
            ['name' => 'Génie Civil 3 Option HYD', 'filiere_id' => 5],
            ['name' => 'Génie Civil 3 Option BPC', 'filiere_id' => 5],
            ['name' => 'Génie de l\'eau et de l\'Environnement 1', 'filiere_id' => 6],
            ['name' => 'Génie de l\'eau et de l\'Environnement 2', 'filiere_id' => 6],
            ['name' => 'Génie de l\'eau et de l\'Environnement 3', 'filiere_id' => 6],
            ['name' => 'Génie Energétique et Energies renouvelables 1', 'filiere_id' => 7],
            ['name' => 'Génie Energétique et Energies renouvelables 2', 'filiere_id' => 7],
            ['name' => 'Génie Energétique et Energies renouvelables 3', 'filiere_id' => 7],
            ['name' => 'Génie Informatique 1', 'filiere_id' => 2],
            ['name' => 'Génie Informatique 2', 'filiere_id' => 2],
            ['name' => 'Génie Informatique 3 Option GL', 'filiere_id' => 2],
            ['name' => 'Génie Informatique 3 Option BI', 'filiere_id' => 2],
            ['name' => 'Génie Informatique 3 Option Médias et Interactions', 'filiere_id' => 2],
            ['name' => 'Génie Mécanique 1', 'filiere_id' => 8],
            ['name' => 'Génie Mécanique 2', 'filiere_id' => 8],
            ['name' => 'Génie Mécanique 3', 'filiere_id' => 8],
            ['name' => 'Ingénierie des données 1', 'filiere_id' => 3],
            ['name' => 'Ingénierie des données 2', 'filiere_id' => 3],
            ['name' => 'Ingénierie des données 3', 'filiere_id' => 3],
            ['name' => 'Transformation Digitale & Intelligence Artificielle 1', 'filiere_id' => 4],
            ['name' => 'Transformation Digitale & Intelligence Artificielle 2', 'filiere_id' => 4],
            ['name' => 'Transformation Digitale & Intelligence Artificielle 3', 'filiere_id' => 4],
        ];

        // Insert classes into the database
        foreach ($classes as $class) {
            DB::table('class')->insert([
                'name' => $class['name'],
                'filiere_id' => $class['filiere_id'],
                'status' => 0, 
                'is_deleted' => 0, 
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
