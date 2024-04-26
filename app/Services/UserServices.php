<?php
namespace App\Services;

use App\Contracts\UserServicesInterface;
use App\Models\User;

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
    }

    public function disableUser(User $user){
        if ($user->status == 1) {
            $user->update([
                'status' => 2
            ]);
        }

    }

}




?>