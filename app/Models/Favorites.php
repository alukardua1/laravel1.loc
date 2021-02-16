<?php

namespace App\Models;

use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Favorites extends Model
{
    use HasFactory, QueryCacheable;
	protected $cacheFor;
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->cacheFor = Config::get('secondConfig.cache_time');
	}

    public function getUser()
    {
    	return $this->belongsTo(User::class);
    }

	public function getAnime()
	{
		return $this->belongsTo(Anime::class);
	}
}
