<?php

namespace App\Policies;

use App\Models\Todolists;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TodolistsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return TRUE;

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Todolists $todolists)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->id>0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Todolists $todolists)
    {
        if ($user->can('update', $todolists)){

        }
        return $user->id === $todolists->user_id
        ? Response::allow()
        : Response::deny('You do not own this post');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Todolists $todolists)
    {
        return $user->id == $todolists->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Todolists $todolists)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todolists  $todolists
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Todolists $todolists)
    {
        //
    }
}
