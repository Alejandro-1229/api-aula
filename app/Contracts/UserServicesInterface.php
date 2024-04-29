<?php

namespace App\Contracts;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface UserServicesInterface
{
    public function createUser(array $userData);

    public function disableUser(User $user);

    public function enableUser(User $user);

    public function logIn(LoginRequest $loginRequest);

    public function logOut(Request $request);

}


?>