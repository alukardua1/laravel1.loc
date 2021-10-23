<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class YearAiredController extends Controller
{
	private YearAiredRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
	 */
	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $yearAiredRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $url): View|Factory|Application
	{
		$show = $this->repository->getYearAired($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
