<?php

namespace App\Models;

use App\Services\MutationTrait;
use Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Model extends BaseModel
{
	use HasFactory, MutationTrait, QueryCacheable;

	protected $cacheFor;

    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
	    $this->cacheFor = Config::get('secondConfig.cache_time') * 1440;
    }
}
