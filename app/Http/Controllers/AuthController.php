<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PgSql\Lob;

class AuthController extends Controller
{
    private $personController;

    public function __construct(PersonController $personController)
    {
        $this->personController = $personController;
    }

    public function register(Request $request)
    {
        $user = $this->personController->create($request);

        $token = $user->createToken('API TOKEN')->plainTextToken;
        $data = [
            'user' => $user->user,
            'password' => $user->password,
            'acces_token' => $token,
            'token_type' => 'Bearer'
        ];

        return ApiResponse::success("Create Successful", 200, $data);
    }

    public function logIn(LoginRequest $request)
    {
        if(!Auth::attempt($request->only('user','password'))){
            return response()->json(['message'=>'Datos Incorrectos'],403);
        }
        
        $user = User::where('user', $request['user'])->firstOrFail();
        $token =  $user->createToken('API TOKEN')->plainTextToken;

        $data = [
            'Message' => 'Hi '.$user->user,
            'AccessToken' => $token,
            'Token Type' => 'Bearer',
            'User' => $user
        ];

        return response()->json($data, 200);
    }

    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $menssage = 'LogOut Succesfull';

        return $menssage;
    }
}
