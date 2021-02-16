<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\AnimeRepositoryInterfaces;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
	private $firstAnime;

	/**
	 * HomeController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->firstAnime = $animeRepositoryInterfaces;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$ongoing = $this->firstAnime->getFirstPageAnime(5)->get();
		return view($this->frontend . 'anime.home', compact('ongoing'));
	}
}
