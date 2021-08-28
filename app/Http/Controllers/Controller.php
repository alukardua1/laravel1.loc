<?php

namespace App\Http\Controllers;

use App\Services\ApiTrait;
use App\Services\FunctionTrait;
use App\Services\MutationTrait;
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
	use ApiTrait;
	use AuthorizesRequests;
	use DispatchesJobs;
	use FunctionTrait;
	use MutationTrait;
	use ValidatesRequests;

	protected int $paginate;

	protected string $frontend = 'web.frontend.';

	protected string $backend = 'web.backend.';

	/**
	 * Controller constructor.
	 */
	public function __construct()
	{
		$this->paginate = Config::get('secondConfig.paginate', 10);
	}
}
