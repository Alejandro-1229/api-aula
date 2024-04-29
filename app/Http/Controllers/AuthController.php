<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\UserRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\PersonServices;
use App\Services\UserServices;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function logIn(Request $loginRequest)
    {
        try {
            
            $loginRequest->validate([
                'user' => 'required',
                'password' => 'required',
            ]);
            
            $user = User::where('user', $loginRequest['user'])->first();

            if (!$user) {
                return ApiResponse::error('El usuario no existe',401);
            }
    
            if (!Hash::check($loginRequest->password, $user->password)) {
                return ApiResponse::error('La contraseña es incorrecta',401);
            }


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
