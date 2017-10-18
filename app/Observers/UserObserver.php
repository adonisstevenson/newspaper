<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use App\Jobs\SendWelcomeEmail;
use Carbon\Carbon;
use App\User;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        SendWelcomeEmail::dispatch($user)->delay(Carbon::now()->addSecond());;
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        Storage::disk('public')->delete($user->photo);
    }
}