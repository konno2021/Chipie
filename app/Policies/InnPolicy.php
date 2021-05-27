<?php

namespace App\Policies;

use App\Inn;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InnPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any inns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the inn.
     *
     * @param  \App\User  $user
     * @param  \App\Inn  $inn
     * @return mixed
     */
    public function view(User $user, Inn $inn)
    {
        return $user->inn_id == $inn->id;
    }

    /**
     * Determine whether the user can create inns.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the inn.
     *
     * @param  \App\User  $user
     * @param  \App\Inn  $inn
     * @return mixed
     */
    public function update(User $user, Inn $inn)
    {
        return $user->inn_id == $inn->id;
    }

    /**
     * Determine whether the user can delete the inn.
     *
     * @param  \App\User  $user
     * @param  \App\Inn  $inn
     * @return mixed
     */
    public function delete(User $user, Inn $inn)
    {
        return $user->id == $inn->_id;
    }

    /**
     * Determine whether the user can restore the inn.
     *
     * @param  \App\User  $user
     * @param  \App\Inn  $inn
     * @return mixed
     */
    public function restore(User $user, Inn $inn)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inn.
     *
     * @param  \App\User  $user
     * @param  \App\Inn  $inn
     * @return mixed
     */
    public function forceDelete(User $user, Inn $inn)
    {
        //
    }
}
