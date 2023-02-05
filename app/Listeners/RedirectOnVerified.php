<?php

namespace App\Listeners;

// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Verified;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use ProtoneMedia\Splade\Facades\Splade;

class RedirectOnVerified implements ShouldBroadcast
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
     * @param  Illuminate\Auth\Events\Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        
    }

    public function broadcastOn()
    {
        return new PrivateChannel('verified.' . $this->user->getKey());
    }

    public function broadcastWith()
    {
        return [
            Splade::redirectOnEvent()->route('home'),
        ];
    }
}
