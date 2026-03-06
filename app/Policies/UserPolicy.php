<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $user): bool
    {
        if($authUser->id === $user->id)
        {
            return false;
        }

        if ($authUser->company_id !== $user->company_id) {
            return false;
        }

        if($auth->role === User::ROLE_OWNER) {
            return true;
        }

        if($authUser->role === User::ROLE_ADMIN && $user->role === User::ROLE_USER) {
            return true;
        }

        return false;
    }

    public function invite(User $authUser, string $role): bool
    {
        if ($authUser->role === User::ROLE_OWNER) {
            return in_array($role, [User::ROLE_ADMIN, User::ROLE_USER]);
        }

        if ($authUser->role === User::ROLE_ADMIN) {
            return $role === User::ROLE_USER;
        }

        return false;
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
