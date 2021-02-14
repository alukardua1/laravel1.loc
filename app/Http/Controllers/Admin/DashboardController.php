<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
	/**
	 * Главная страница админки
	 */
	public function index()
	{
		dd(__METHOD__, \Auth::user());
	}
}
