<?php
namespace App\Services;

use App\Contracts\UserServicesInterface;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserServices implements UserServicesInterface
{
    public function createUser(array $userData)
    {
        return User::create($userData);
    }

    public function enableUser(User $user){
        if ($user->status == 2) {
            $user->update([
                'status' => 1
            ]);
        }
        return $user->status;
    }

    public function disableUser(User $user){
        if ($user->status == 1) {
            $user->update([
                'status' => 2
            ]);
        }
        return $user->status;

    }

    public function logIn(LoginRequest $loginRequest)
    {
        if(!Auth::attempt($loginRequest->only('user','password'))){
            return response()->json(['message'=>'Datos Incorrectos'],403);
        }
        
        $user = User::where('user', $loginRequest['user'])->firstOrFail();
        $token =  $user->createToken('API TOKEN')->plainTextToken;

        $data = [
            'Message' => 'Hi '.$user->user,
            'AccessToken' => $token,
            'Token Type' => 'Bearer',
            'User' => $user
        ];

       return $data;

    }

    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $menssage = 'LogOut Succesfull';

        return $menssage;
        
    }

}




?>