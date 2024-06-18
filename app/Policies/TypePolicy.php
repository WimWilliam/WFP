<?php

namespace App\Policies;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class TypePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function delete(User $user)
    {
        return ($user->role=='owner'
          ? Response::allow()
          : Response::deny('You must be an administrator'));
    }

}
