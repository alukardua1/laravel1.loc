<?php

namespace App\Models;

use App\Services\MutationTrait;
use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Rennokki\QueryCache\Traits\QueryCacheable;

abstract class Model extends BaseModel
{
	use HasFactory;
	use MutationTrait;
	use QueryCacheable;

	protected int|float $cacheFor;
	//protected static $flushCacheOnUpdate = true;

	/**
	 * Model constructor.
	 *
	 * @param  array  $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->cacheFor = Config::get('secondConfig.cache_time') * 1440; //Получает из конфига время жизни кэша в секундах
	}
}
