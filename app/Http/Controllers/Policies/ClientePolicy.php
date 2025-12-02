<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    public function crear_cliente(User $user)
    {
        return $user->hasPermissionTo('crear_cliente');
    }
}