<?php

namespace App\Observers;

use App\News;
use Illuminate\Support\Facades\Storage;

class NewsObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(News $news)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(News $news)
    {
        Storage::disk('public')->delete($news->photo);
    }
}