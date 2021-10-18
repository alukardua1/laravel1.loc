<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class YearAiredController
 *
 * @package App\Http\Controllers
 */
class YearAiredController extends Controller
{
	private YearAiredRepositoryInterfaces $yearAired;

	/**
	 * @param  \App\Repository\Interfaces\YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
	 */
	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		parent::__construct();
		$this->yearAired = $yearAiredRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $yearUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(string $yearUrl): View|Factory|Application
	{
		$showYear = $this->yearAired->getYearAired($yearUrl)->first();
		$this->isNotNull($showYear);
		$title = $showYear->year . ' год выпуска';
		$description = null;
		$allAnime = $showYear->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showYear', 'allAnime', 'title', 'description'));
	}
}
