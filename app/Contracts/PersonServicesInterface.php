<?php

namespace App\Contracts;

use App\Models\Person;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

interface PersonServicesInterface
{
    public function createPerson(array $dataPerson);
    
    public function updatePerson(Request $request, Person $person);
}


?>