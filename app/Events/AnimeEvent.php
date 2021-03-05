<?php

namespace App\Events;

use App\Models\Anime;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class AnimeEvent
{
    use InteractsWithSockets, SerializesModels;

    public $anime;

	/**
	 * Create a new event instance.
	 *
	 * @param  \App\Models\Anime  $anime
	 */
    public function __construct(Anime $anime)
    {
        $this->anime = $anime;
    }
}
