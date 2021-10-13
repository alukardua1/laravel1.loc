<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class GeoBlockController extends Controller
{
	protected GeoBlockRepositoryInterfaces $geoBlockRepository;

	/**
	 * @param  \App\Repository\Interfaces\GeoBlockRepositoryInterfaces  $geoBlockRepositoryInterfaces
	 */
	public function __construct(GeoBlockRepositoryInterfaces $geoBlockRepositoryInterfaces)
	{
		parent::__construct();
		$this->geoBlockRepository = $geoBlockRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$geoBlock = $this->geoBlockRepository->getGeoBlock()->get();
		$this->isNotNull($geoBlock);
		$title = $geoBlock->name;
		$description = $geoBlock->description;
		$allAnime = $geoBlock->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('geoBlock', 'allAnime', 'title', 'description'));
	}
}
