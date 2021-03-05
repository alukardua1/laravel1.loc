<?php

namespace App\Listeners;

use App\Events\AnimeEvent;

class AnimeViewNotification
{
    /**
     * Handle the event.
     *
     * @param  AnimeEvent  $event
     * @return void
     */
    public function handle(AnimeEvent $event)
    {
	    $event->anime->increment('read_count');
    }
}
