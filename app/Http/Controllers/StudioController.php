<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StudioController extends Controller
{
	private StudioRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\StudioRepositoryInterfaces  $studioRepositoryInterfaces
	 */
	public function __construct(StudioRepositoryInterfaces $studioRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $studioRepositoryInterfaces;
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
		$show = $this->repository->getStudio($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
