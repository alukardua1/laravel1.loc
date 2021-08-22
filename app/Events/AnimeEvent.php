<?php

namespace App\Events;

use App\Models\Anime;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class AnimeEvent
{
	use InteractsWithSockets;
	use SerializesModels;

	public Anime $anime;

	/**
	 * Create a new event instance.
	 *
	 * @param  Anime  $anime
	 */
	public function __construct(Anime $anime)
	{
        $this->anime = $anime;
    }
}
