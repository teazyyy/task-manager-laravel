<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Admin var visu. Šis tiek izsaukts pirms jebkura cita policy.
     */
    public function before(User $user, $ability)
    {
        if ($user->role && $user->role->name === 'admin') {
            return true;
        }
    }

    /**
     * Lietotājs var redzēt tikai savus uzdevumus.
     */
    public function view(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Lietotājs var veidot uzdevumus tikai, ja nav guest.
     */
    public function create(User $user)
    {
        return $user->role && in_array($user->role->name, ['user', 'admin']);
    }

    /**
     * Lietotājs var atjaunināt tikai savus uzdevumus.
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Lietotājs var dzēst tikai savus uzdevumus.
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function viewAny(User $user)
    {
        // Lietotāji (user, admin) var redzēt uzdevumu sarakstu
        return $user->role && in_array($user->role->name, ['user', 'admin']);
    }

    public function restore(User $user, Task $task)
    {
        // Tikai admin varētu atļaut atjaunot
        return false;
    }

    public function forceDelete(User $user, Task $task)
    {
        // Tikai admin varētu atļaut pilnīgi dzēst, bet tas tiek nosegts ar before()
        return false;
    }
}
