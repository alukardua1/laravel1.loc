<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use App\Traits\CacheTrait;
use App\Traits\FunctionTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionTrait, ApiTrait, CacheTrait;

	protected $paginate;
	protected $keyCache;

	protected $frontend = 'web.frontend.';
}
