<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Specialty::create([
            "specialty_description" => "Especialista en Java"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en PHP"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en JavaScript"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en Machine Learning"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en QA"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en Python"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en Desarrollo de Aplicaciones Moviles en Android"
        ]);
        Specialty::create([
            "specialty_description" => "Especialista en Ciberseguridad"
        ]);
    }
}
