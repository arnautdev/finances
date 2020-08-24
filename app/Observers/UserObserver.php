<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function created(User $user)
    {
        // assign user role
        if (in_array($user->email, config('acl.superAdminEmails'))) {
            $user->assignRole(User::SUPER_ADMIN);
        } else {
            $guardId = session()->get('guardId');
            if (intval($guardId) > 0) {
                $user->assignRole($guardId);
            } else {
                $user->assignRole(User::ADMINISTRATOR);
            }
        }

        // notify all super admins when new member registered
        $users = $user->role(User::SUPER_ADMIN)->get();
        foreach ($users as $userAdm) {
            $userAdm->notify(new \App\Notifications\NewUserRegistered($user));
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
