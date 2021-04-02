<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
	/**
	 * Главная страница админки
	 *
	 * @return Factory|View|Application
	 */
	public function index(): Factory|View|Application
	{
		return view($this->backend . 'layout.components.home');
	}
}
