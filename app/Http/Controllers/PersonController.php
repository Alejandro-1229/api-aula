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
        $people = User::with('person')->select('id','user','status','person_id','user_roles_id')->get();

        return ApiResponse::success('Operation Successful',201,$people);
    }

    public function getPersonUser(int $id)
    {
        $people = User::with('person')->select('id','user','status','person_id','user_roles_id')->where('person_id',$id)->get();

        return ApiResponse::success('Operation Successful',201,$people);
    }

    public function create(Request $request)
    {
        $dataPerson = $request->only(['name', 'last_name', 'email', 'cell_phone']);

        $person = $this->personServices->createPerson($dataPerson);
    
        $dataUser = $request->only(['user', 'user_roles_id']);
        $dataUser['password'] = Hash::make($request->password);
        $dataUser['person_id'] = $person->id; 
        $dataUser['status'] = 1; 

        $user = $this->userServices->createUser($dataUser);
    
        return $user;
    }

    public function update(Request $request, Person $person)
    {

        $this->personServices->updatePerson($request, $person);

        return response()->json('Update Successfull',200);
        
    }

    public function disable()
    {

    }
}
