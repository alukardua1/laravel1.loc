<?php

namespace App\Models;


class Player extends Model
{
	public $cacheTags = ['player'];
	public $cachePrefix = 'player_';
    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
}
