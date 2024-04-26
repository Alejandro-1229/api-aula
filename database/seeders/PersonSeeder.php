<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Person::create([
            "name" => "admin",
            "last_name" => "admin",
            "email" => "admin@mail.com",
            "cell_phone" => "987654321"
        ]);
    }
}
