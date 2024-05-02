<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Responses\ApiResponse;
use App\Services\UserServices;

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

    public function getDocentes()
    {
        try {
            $docentes = $this->userServices->getRolUser(2);
            return ApiResponse::success('Operation Successful', 201, $docentes);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function getEstudiantes()
    {
        try {
            $estudiantes = $this->userServices->getRolUser(3);
            return ApiResponse::success('Operation Successful', 201, $estudiantes);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function getAuxiliares()
    {
        try {
            $auxiliares = $this->userServices->getRolUser(4);
            return ApiResponse::success('Operation Successful', 201, $auxiliares);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function getSpecificUser(int $idPerson)
    {
        try {
            $user = $this->userServices->getSpecificUser($idPerson);
            return ApiResponse::success('Operation Successful', 201, $user);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }
}
