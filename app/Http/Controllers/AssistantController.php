<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Http\Requests\UserRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Assistant;
use App\Services\PersonServices;
use App\Services\UserServices;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    //

    private $userServices;
    private $personServices;

    public function __construct(UserServices $userServices, PersonServices $personServices)
    {
        $this->userServices = $userServices;
        $this->personServices = $personServices;
    }

    public function createAssistant(PersonRequest $personRequest, UserRequest $userRequest)
    {
        try {
            $dataPerson = $personRequest->all();

            $person = $this->personServices->createPerson($dataPerson);

            $dataUser = $userRequest->all();
            $dataUser['status'] = 1;
            $dataUser['person_id'] = $person->id;

            $user = $this->userServices->createUser($dataUser);

            Assistant::create([
                "user_id" => $user->id
            ]);

            $data = [
                "person" => $person,
                "user" => $user,
            ];

            return ApiResponse::success("Create Successfull",200,$data);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }
}
