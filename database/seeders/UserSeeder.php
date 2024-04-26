<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            "user" => "admin",
            "password" => "123",
            "status" => 1,
            "person_id" => 1,
            "user_roles_id" => 1
        ]);
    }
}
