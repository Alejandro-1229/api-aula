<?php

namespace App\Services;

use App\Contracts\PersonServicesInterface;
use App\Models\Person;

class PersonServices implements PersonServicesInterface
{
    public function createPerson(array $personData)
    {
        $user = Person::create($personData);

        return $user;
    }
}


?>