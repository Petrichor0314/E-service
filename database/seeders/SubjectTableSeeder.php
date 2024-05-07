<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => "Développement d'applications Web",
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => "Systèmes d’Information et Bases de Données Relationnelle",
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Recherche opérationnelle et théorie des graphes',
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Architecture des ordinateurs',
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Applications Web avancées avec Java et Spring',
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Entreprise Reproducing Planning (Odoo)',
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => "Python pour les sciences de données",
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Administration Linux',
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => "Modélisation avec UML",
                'type' => 'Theory',
                'created_by' => 1,
                'status' => 0,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('subject')->insert($data);
    
    }
}
