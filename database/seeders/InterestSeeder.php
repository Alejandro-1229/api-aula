<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Interest::create([
            "interest_description" => "Inteligencia Artificial y Aprendizaje Automático"
        ]);

        Interest::create([
            "interest_description" => "Desarrollo Web Avanzado"
        ]);

        Interest::create([
            "interest_description" => "Ciberseguridad"
        ]);

        Interest::create([
            "interest_description" => "Desarrollo de Aplicaciones Moviles"
        ]);

        Interest::create([
            "interest_description" => "Desarrollo de Juegos"
        ]);

        Interest::create([
            "interest_description" => "Desarrollo de APIs y Servicios Web"
        ]);

        Interest::create([
            "interest_description" => "Computacion en la Nube"
        ]);

        Interest::create([
            "interest_description" => "Programacion Funcional y Reactiva"
        ]);

        Interest::create([
            "interest_description" => "POO con Java"
        ]);

        Interest::create([
            "interest_description" => "POO con PHP"
        ]);


    }
}
