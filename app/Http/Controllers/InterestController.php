<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    //

    public function getAllInterest()
    {
        $interests = Interest::all();

        return ApiResponse::success("All Interests", 201, $interests);
    }

    public function getInterest(Interest $interest)
    {
        return ApiResponse::success("Interest", 201, $interest);
    }

    public function createInterest(Request $request)
    {
        $interest = Interest::create([
            'interest_description' => $request->input('interest_description')
        ]);

        return ApiResponse::success("Create Interest Successfull", 200, $interest);
    }

    public function updateInterest(Request $request, Interest $interest)
    {
        $interest->update([
            "interest_description" => $request->input('interest_description')
        ]);

        return ApiResponse::success("Update Interest Successfull", 201, $interest);
    }
}
