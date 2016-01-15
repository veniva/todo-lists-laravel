<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Task
{
    use HandlesAuthorization;

    public function delete(User $user, \App\Task $task)
    {
        return $user->id === $task->user_id;
    }
}
