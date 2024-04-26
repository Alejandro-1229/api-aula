<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UserRole::create([
            "role_description" => "admin"
        ]);

        UserRole::create([
            "role_description" => "teacher"
        ]);

        UserRole::create([
            "role_description" => "student"
        ]);
    }
}
