<?php
namespace App\Services;

use App\Contracts\UserServicesInterface;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;

class UserServices implements UserServicesInterface
{
    public function createUser(array $userData)
    {
        return User::create($userData);
    }

    public function getRolUser(int $idRol)
    {
        try {
            $users = User::with('person')->select('id', 'user', 'status', 'person_id', 'user_roles_id')->where('user_roles_id',$idRol)->get();
            return $users;
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function getSpecificUser(int $idPerson)
    {
        try {
            $user = User::with('person')->select('id', 'user', 'status', 'person_id', 'user_roles_id')->where('person_id', $idPerson)->get();
            return $user;
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
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

    public function logIn(User $user)
    {
        
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