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

    public function __construct(UserServices $userServices ,PersonServices $personServices)
    {
        $this->userServices = $userServices;
        $this->personServices = $personServices;
    }


    public function getAllPerson()
    {
        $people = User::with('person')->get();

        return ApiResponse::success('Operation Successful',201,$people);
    }

    public function create(Request $request)
    {
        $dataPerson = $request->only(['name', 'last_name', 'email', 'cell_phone']);

        $person = $this->personServices->createPerson($dataPerson);
    
        $dataUser = $request->only(['user', 'user_roles_id', 'status']);
        $dataUser['password'] = Hash::make($request->password);
        $dataUser['person_id'] = $person->id; 

        $user = $this->userServices->createUser($dataUser);
    
        return $user;
    }

    public function update()
    {

    }

    public function disable()
    {

    }
}
