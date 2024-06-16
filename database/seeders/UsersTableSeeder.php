<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = [];

            for ($i = 1; $i <= 3; $i++) {
                $users[] = [
                    'name' => 'Admin' . ($i > 1 ? '_'.$i : ''),
                    'last_name' => $i == 1 ? '' : $faker->lastName,
                    'email' => 'admin' . ($i > 1 ? '_'.$i : '') . '@uae.ac.ma',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345'),
                    'remember_token' => null,
                    'user_type' => 1,   // admin
                    'department_id' => null,
                    'is_deleted' => 0,
                    'CIN' => $i == 1 ? null : $faker->randomNumber(4),
                    'CNE' => $i == 1 ? null : $faker->randomNumber(4),
                    'class_id' => null,
                    'gender' => $i == 1 ? null : $faker->randomElement(['Male', 'Female']),
                    'date_of_birth' => $i == 1 ? null : $faker->date(),
                    'profile_pic' => $i == 1 ? null : 'profile'.$i.'.jpg',
                    'admission_date' => $i == 1 ? null : $faker->date(),
                    'mobile_number' => $i == 1 ? null : $faker->phoneNumber,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
    
            // Creation de 50 Professeurs
            for ($i = 1; $i <= 50; $i++) {
                $users[] = [
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => 'teacher' . $i . '@uae.ac.ma',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345'),
                    'remember_token' => null,
                    'user_type' => 2, // prof
                    'department_id' =>$faker->randomElement([1,2]),
                    'is_deleted' => 0,
                    'CIN' => $faker->randomNumber(4),
                    'CNE' => $faker->randomNumber(4),
                    'class_id' => null,
                    'gender' => $faker->randomElement(['Male', 'Female']),
                    'date_of_birth' => $faker->date(),
                    'profile_pic' => 'teacher'.$i.'.jpg',
                    'admission_date' => $faker->date(),
                    'mobile_number' => $faker->phoneNumber,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
    
            // Creation de 500 Etudiants
            for ($i = 1; $i <= 500; $i++) {
                $users[] = [
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => 'student' . $i . '@etu.uae.ac.ma',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345'),
                    'remember_token' => null,
                    'user_type' => 3, // student
                    'department_id' => null,
                    'is_deleted' => 0,
                    'CIN' => $faker->randomNumber(4),
                    'CNE' => $faker->randomNumber(4),
                    'class_id' => $faker->numberBetween(1,8),
                    'gender' => $faker->randomElement(['Male', 'Female']),
                    'date_of_birth' => $faker->date(),
                    'profile_pic' => 'student'.$i.'.jpg',
                    'admission_date' => $faker->date(),
                    'mobile_number' => $faker->phoneNumber,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];   
            }
            
        DB::table('users')->insert($users);
    }
}

