<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendPostNotificationToSubscribers;

class SendNewPostNotificationToSubscribers
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
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        SendPostNotificationToSubscribers::dispatch($event->post->id, $event->post->website_id);
    }
}
