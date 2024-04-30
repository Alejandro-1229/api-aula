<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Http\Requests\UserRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Person;
use App\Models\User;
use App\Services\PersonServices;
use App\Services\UserServices;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    //

    private $userServices;
    private $personServices;

    public function __construct(UserServices $userServices, PersonServices $personServices)
    {
        $this->userServices = $userServices;
        $this->personServices = $personServices;
    }


    public function create(PersonRequest $personRequest, UserRequest $userRequest)
    {
        try {
            $dataPerson = $personRequest->all();

            $person = $this->personServices->createPerson($dataPerson);

            $dataUser = $userRequest->all();
            $dataUser['status'] = 1;
            $dataUser['person_id'] = $person->id;

            $user = $this->userServices->createUser($dataUser);

            $data = [
                "person" => $person,
                "user" => $user
            ];

            return ApiResponse::success("Create Successfull",200,$data);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function update(Request $request, Person $person)
    {
        try {
            $this->personServices->updatePerson($request, $person);
            return response()->json('Update Successfull', 200);
        } catch (\Throwable $th) {
            return ApiResponse::success($th->getMessage(), 500);
        }
    }

    public function changeStatus(User $user){
        try {

            $message = match($user->status) {
                '1' => $this->userServices->disableUser($user) ? "user disable" : "failed to disable user",
                '2' => $this->userServices->enableUser($user) ? "user enable" : "failed to enable user",
                default => "unknown status",
            };
            
            return response()->json($message, 200);
        } catch (\Throwable $th) {
            return ApiResponse::success($th->getMessage(), 500);
        }
    }

}
