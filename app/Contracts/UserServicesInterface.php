<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface UserServicesInterface
{
    public function createUser(array $userData);

    public function disableUser(User $user);

    public function enableUser(User $user);

    public function logIn(User $user);

    public function logOut(Request $request);

}


?>