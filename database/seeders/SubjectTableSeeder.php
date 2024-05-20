<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Department 1
            ['name' => 'Algèbre 1', 'department_id' => 1],
            ['name' => 'Analyse 1', 'department_id' => 1],
            ['name' => 'Informatique 1', 'department_id' => 1],
            ['name' => 'Physique 1', 'department_id' => 1],
            ['name' => 'Algèbre 2', 'department_id' => 1],
            ['name' => 'Analyse 2', 'department_id' => 1],
            ['name' => 'Informatique 2', 'department_id' => 1],
            ['name' => 'Physique 2', 'department_id' => 1],
            ['name' => 'Algèbre 3', 'department_id' => 1],
            ['name' => 'Analyse 3', 'department_id' => 1],
            ['name' => 'Informatique 3', 'department_id' => 1],
            ['name' => 'Mathématiques appliquées', 'department_id' => 1],
            ['name' => 'Analyse 4', 'department_id' => 1],
            ['name' => 'Réseaux informatiques', 'department_id' => 1],
            ['name' => 'Systèmes d’Information et Bases de Données Relationnelles', 'department_id' => 1],
            ['name' => 'Algorithmique Avancée et complexité', 'department_id' => 1],
            ['name' => 'Administration des Bases de données Avancées', 'department_id' => 1],
            ['name' => 'Administration réseaux et systèmes', 'department_id' => 1],
            ['name' => 'Programmation Java Avancée', 'department_id' => 1],
            ['name' => 'Python pour les sciences de données', 'department_id' => 1],
            ['name' => 'Crypto-systèmes et sécurité Informatique', 'department_id' => 1],
            ['name' => 'Frameworks Java EE avancés et .Net', 'department_id' => 1],
            ['name' => 'Machine Learning', 'department_id' => 1],
            ['name' => 'Développement des applications mobiles', 'department_id' => 1],
            ['name' => 'Système embarqué et temps réel', 'department_id' => 1],
            ['name' => 'Virtualisation et Cloud Computing', 'department_id' => 1],

            // Department 2
            ['name' => 'Mécanique 1', 'department_id' => 2],
            ['name' => 'Chimie 1', 'department_id' => 2],
            ['name' => 'Géologie', 'department_id' => 2],
            ['name' => 'Physique 4', 'department_id' => 2],
            ['name' => 'Dessin, architecture', 'department_id' => 2],
            ['name' => 'Matériaux de construction', 'department_id' => 2],
            ['name' => 'Mécanique des Fluides et des Solides', 'department_id' => 2],
            ['name' => 'Programmation événementielle et Initiations aux bases de données', 'department_id' => 2],
            ['name' => 'Résistance des Matériaux 1', 'department_id' => 2],
            ['name' => 'Urbanisme, Topographie', 'department_id' => 2],
            ['name' => 'Béton Armé 1', 'department_id' => 2],
            ['name' => 'Equation de la physique mathématiques', 'department_id' => 2],
            ['name' => 'Géotechnique 1', 'department_id' => 2],
            ['name' => 'Logistique et transport : routes 1', 'department_id' => 2],
            ['name' => 'Résistance des Matériaux 2', 'department_id' => 2],
            ['name' => 'Béton Armé 2', 'department_id' => 2],
            ['name' => 'Géotechnique 2 et Hydraulique Souterraine', 'department_id' => 2],
            ['name' => 'Hydraulique et Machines Hydrauliques', 'department_id' => 2],
            ['name' => 'Hydrologie', 'department_id' => 2],
            ['name' => 'Résistance des Matériaux 3', 'department_id' => 2],
            ['name' => 'Stratégie de gestion et gestion de l’entreprise', 'department_id' => 2],
            ['name' => 'Voirie, réseaux divers et éclairagisme', 'department_id' => 2],
            ['name' => 'Béton précontraint', 'department_id' => 2],
            ['name' => 'Construction Métallique 1', 'department_id' => 2],
        ];

        foreach ($subjects as $subject) {
            $subject['type'] = 'Theory';
            $subject['created_by'] = 1;
            $subject['status'] = 0;
            $subject['is_deleted'] = 0;
            $subject['created_at'] = Carbon::now();
            $subject['updated_at'] = Carbon::now();
            DB::table('subject')->insert($subject);
        }

    }   
}