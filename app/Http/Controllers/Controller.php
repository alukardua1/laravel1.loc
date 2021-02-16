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

	protected $paginate;

	protected $frontend = 'web.frontend.';

	public function __construct()
	{
		$this->paginate = Config::get('secondConfig.paginate');
	}
}
