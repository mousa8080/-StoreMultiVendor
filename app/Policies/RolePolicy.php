<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbilities('view.roles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Role $role): bool
    {
        return $user->hasAbilities('view.roles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbilities('create.roles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Role $role): bool
    {
        return $user->hasAbilities('update.roles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Role $role): bool
    {
        return $user->hasAbilities('delete.roles');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Role $role): bool
    {
        return $user->hasAbilities('restore.roles');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Role $role): bool
    {
        return $user->hasAbilities('forceDelete.roles');
    }
}
