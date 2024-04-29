<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    private $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function createUser(UserRequest $request)
    {
        $userData = $request->all();

        $this->userServices->createUser($userData);
    }
}
