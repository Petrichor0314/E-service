<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'last_name' => '',
                'email' => 'admin@etu.uae.ac.ma',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'),
                'remember_token' => null,
                'user_type' => 1, // admin
                'is_deleted' => 0,
                'CIN' => null,
                'CNE' => null,
                'class_id' => null,
                'gender' => null,
                'date_of_birth' => null,
                'profile_pic' => null,
                'admission_date' => null,
                'mobile_number' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Teacher',
                'last_name' => '',
                'email' => 'teacher@etu.uae.ac.ma',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'),
                'remember_token' => null,
                'user_type' => 2, // teacher
                'is_deleted' => 0,
                'CNI' => null,
                'CNE' => null,
                'class_id' => null,
                'gender' => null,
                'date_of_birth' => null,
                'profile_pic' => null,
                'admission_date' => null,
                'mobile_number' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Student',
                'last_name' => '',
                'email' => 'student@etu.uae.ac.ma',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'),
                'remember_token' => null,
                'user_type' => 3, // student
                'is_deleted' => 0,
                'CNI' => null,
                'CNE' => null,
                'class_id' => null,
                'gender' => null,
                'date_of_birth' => null,
                'profile_pic' => null,
                'admission_date' => null,
                'mobile_number' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    }

