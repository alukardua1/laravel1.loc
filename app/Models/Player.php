<?php

namespace App\Models;


/**
 * Class Player
 *
 * @package App\Models
 */
class Player extends Model
{
	public array  $cacheTags   = ['player'];
	public string $cachePrefix = 'player_';

	protected $fillable = [
		'anime_id',
		'name_player',
		'url_player'
	];

	/**
	 * Player constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
