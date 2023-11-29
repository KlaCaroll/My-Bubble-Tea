<?php

namespace App\Policies;

use App\Models\Drink;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DrinkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Drink $drink): bool
    {
        return $user->role === 'admin' || $user->id === $drink->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->id === true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Drink $drink): bool
    {
        return $user->role === 'admin' || $user->id === $user->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Drink $drink): bool
    {
        return $user->id === $user->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Drink $drink): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Drink $drink): bool
    {
        //
    }
}
