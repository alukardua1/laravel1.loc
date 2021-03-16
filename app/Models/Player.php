<?php

namespace App\Models;


class Player extends Model
{
	public $cacheTags = ['player'];
	public $cachePrefix = 'player_';

	protected $fillable = [
		'anime_id',
		'name_player',
		'url_player'
	];
    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
