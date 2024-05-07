<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => "Première Année Cycle Préparatoire",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => "Deuxième Année Cycle Préparatoire",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => "Génie Informatique 1",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => "Génie Informatique 2",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => "Ingénierie des données 1",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => "Ingénierie des données 2",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => "Transformation Digitale & Intelligence Artificielle 1",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => "Transformation Digitale & Intelligence Artificielle 2",
                'status' => 0,
                'is_deleted' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more data as needed
        ];

        DB::table('class')->insert($data);
    
    }
}
