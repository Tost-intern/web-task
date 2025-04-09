<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Only allow the owner of the task to update it.
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Only allow the owner of the task to delete it.
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
