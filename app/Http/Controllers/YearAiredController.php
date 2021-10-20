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
	 * @param  string  $yearUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $yearUrl): View|Factory|Application
	{
		$showYear = $this->repository->getYearAired($yearUrl)->first();
		$this->isNotNull($showYear);
		$title = $showYear->year . ' год выпуска';
		$description = null;
		$allAnime = $showYear->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showYear', 'allAnime', 'title', 'description'));
	}
}
