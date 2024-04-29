<?php
 
namespace App\Services;

use App\Contracts\PersonServicesInterface;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class PersonServices implements PersonServicesInterface
{
    public function createPerson(array $personData)
    {
        return  Person::create($personData);
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