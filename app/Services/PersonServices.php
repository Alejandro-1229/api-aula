<?php
 
namespace App\Services;

use App\Contracts\PersonServicesInterface;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;

class PersonServices implements PersonServicesInterface
{
    public function createPerson(array $personData)
    {
        $user = Person::create($personData);

        return $user;
    }

    public function updatePerson(Request $request, Person $person)
    {
        $dataPerson = $request->only(['name', 'last_name', 'email', 'cell_phone']);
        $person->update($dataPerson);
    
        $user = User::findOrFail($person->id);
        $dataUser = $request->only(['user', 'password']);
        $user->update($dataUser);
    
        return true;
    }
    
}


?>