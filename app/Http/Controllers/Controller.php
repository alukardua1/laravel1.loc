<?php

namespace App\Http\Controllers;

use App\Services\ApiTrait;
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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FunctionTrait, ApiTrait;

	protected $paginate;

	protected $frontend = 'web.frontend.';

	protected $backend = 'web.backend.';

	public function __construct()
	{
		$this->paginate = Config::get('secondConfig.paginate');
	}
}
