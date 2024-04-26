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

}




?>