<?php

namespace App\Http\Controllers;

use App\Services\ApiTrait;
use App\Services\CacheTrait;
use App\Services\FunctionTrait;
use Config;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionTrait, ApiTrait, CacheTrait;

	/**
	 * @var
	 */
	protected $paginate;
	/**
	 * @var
	 */
	protected $keyCache;

	/**
	 * @var string
	 */
	protected $frontend = 'web.frontend.';
}
