<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LastLoginNotification
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
	    $event->user->last_login = date('Y-m-d H:i:s');
	    $event->user->save();
    }
}
