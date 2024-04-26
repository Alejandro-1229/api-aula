<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Person;
use App\Models\User;
use App\Services\PersonServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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


    public function getAllPerson()
    {
        try {
            $people = User::with('person')->select('id', 'user', 'status', 'person_id', 'user_roles_id')->get();
            return ApiResponse::success('Operation Successful', 201, $people);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function getPersonUser(int $id)
    {
        try {
            $people = User::with('person')->select('id', 'user', 'status', 'person_id', 'user_roles_id')->where('person_id', $id)->get();
            return ApiResponse::success('Operation Successful', 201, $people);
        } catch (\Throwable $th) {
            return ApiResponse::error($th->getMessage(), 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $dataPerson = $request->only(['name', 'last_name', 'email', 'cell_phone']);

            $person = $this->personServices->createPerson($dataPerson);

            $dataUser = $request->only(['user', 'user_roles_id']);
            $dataUser['password'] = Hash::make($request->password);
            $dataUser['person_id'] = $person->id;
            $dataUser['status'] = 1;

            $user = $this->userServices->createUser($dataUser);

            return ApiResponse::success("Creacion Satisfactoria", 200, $user);
        } catch (\Throwable $th) {
            return ApiResponse::success($th->getMessage(), 500);
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
