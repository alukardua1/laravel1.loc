<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class GeoBlockController extends Controller
{
	private GeoBlockRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\GeoBlockRepositoryInterfaces  $geoBlockRepositoryInterfaces
	 */
	public function __construct(GeoBlockRepositoryInterfaces $geoBlockRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $geoBlockRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(string $url): View|Factory|Application
	{
		$show = $this->repository->getGeoBlock($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
