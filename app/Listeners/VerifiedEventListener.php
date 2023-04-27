<?php

namespace App\Listeners;

// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;

use App\Events\RedirectOnVerified;
use Illuminate\Auth\Events\Verified;

class VerifiedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        event(new RedirectOnVerified($event->user->id));
    }
}
