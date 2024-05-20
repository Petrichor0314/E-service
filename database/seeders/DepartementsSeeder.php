<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departements')->insert([
            [
                'name' => 'Département Mathématiques et Informatique',
                'head' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Département Génie Civil Energétique et Environnement (GCEE)',
                'head' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
