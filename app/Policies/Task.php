<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Task
{
    use HandlesAuthorization;

    public function store(User $user, \App\Task $task)
    {
        return $user->id == $task->user_id;
    }
}
