<?php

namespace App\Policies;

use App\TodoList as ToList;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoList
{
    use HandlesAuthorization;

    public function show(User $user, ToList $list)
    {
        return $user->id === $list->user_id;
    }
}
