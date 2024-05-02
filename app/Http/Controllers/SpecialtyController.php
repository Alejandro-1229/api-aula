<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    //
    public function getAllSpecialties()
    {
        $specialties = Specialty::all();

        return ApiResponse::success("All Specialties",200,$specialties);
    }

    public function getSpecialty(Specialty $specialty)
    {
        return ApiResponse::success("Specialty",200,$specialty);
    }

    public function createSpecialty(Request $request)
    {
        $specialty = Specialty::create([
            'specialty_description' => $request->input('specialty_description')
        ]);

        return ApiResponse::success("Create Specialty Successfull",200,$specialty);
    }

    public function updateSpecialty(Request $request, Specialty $specialty)
    {
        $specialty->update([
            'specialty_description' => $request->input('specialty_description')
        ]);

        return ApiResponse::success("Update Specialty Successfull",200,$specialty);
    }
}
