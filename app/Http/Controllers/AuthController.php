<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\UserRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\PersonServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $userServices;
    private $personServices;

    public function __construct(UserServices $userServices, PersonServices $personServices)
    {
        $this->userServices = $userServices;
        $this->personServices = $personServices;
    }

    public function register(PersonRequest $personRequest, UserRequest $userRequest)
    {
        try {
            $dataPerson = $personRequest->all();

            $person = $this->personServices->createPerson($dataPerson);

            $dataUser = $userRequest->all();
            $dataUser['status'] = 1;
            $dataUser['person_id'] = $person->id;

            $user = $this->userServices->createUser($dataUser);

            $token = $user->createToken('API TOKEN')->plainTextToken;
            $data = [
                'user' => $user->user,
                'acces_token' => $token,
                'token_type' => 'Bearer'
            ];

            return ApiResponse::success("Create Successful", 200, $data);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function logIn(LoginRequest $loginRequest)
    {
        try {
            $data = $this->userServices->logIn($loginRequest);

            return ApiResponse::success('Success', 200, $data);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function logOut(Request $request)
    {
        try {
            $message = $this->userServices->logOut($request);

            return ApiResponse::success('Success', 200, $message);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }
}
