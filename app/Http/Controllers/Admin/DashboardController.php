<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
		return view($this->backend . 'layout.components.home');
	}
}
