<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    public function getUser()
    {
    	return $this->belongsTo(User::class);
    }

	public function getAnime()
	{
		return $this->belongsTo(Anime::class);
	}
}
