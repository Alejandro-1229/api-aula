<?php

namespace App\Contracts;

use App\Models\User;

interface UserServicesInterface
{
    public function createUser(array $userData);

    public function disableUser(User $user);

    public function enableUser(User $user);

}


?>