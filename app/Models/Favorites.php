<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorites extends Model
{
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
	}

    public function getUser(): BelongsTo
    {
    	return $this->belongsTo(User::class);
    }

	public function getAnime(): BelongsTo
	{
		return $this->belongsTo(Anime::class);
	}
}
