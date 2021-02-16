<?php

namespace App\Models;

use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class OtherLink extends Model
{
    use HasFactory, QueryCacheable;

	protected $cacheFor;
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->cacheFor = Config::get('secondConfig.cache_time');
	}
}
