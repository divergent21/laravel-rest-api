<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Cache::tags('users-lists')->flush();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Cache::tags('users-lists')->flush();

        Cache::tags('user')->forget('user-' . $user->id);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Cache::tags('users-lists')->flush();

        Cache::tags('user')->forget('user-' . $user->id);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        Cache::tags('users-lists')->flush();

        Cache::tags('user')->forget('user-' . $user->id);
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        Cache::tags('users-lists')->flush();

        Cache::tags('user')->forget('user-' . $user->id);
    }
}
