<?php

namespace App\Contracts;

use App\Models\Person;
use Illuminate\Http\Request;

interface PersonServicesInterface
{
    public function createPerson(array $dataPerson);
    
    public function updatePerson(Request $request, Person $person);
}


?>