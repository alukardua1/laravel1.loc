<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
	/**
	 * @var \App\Repository\Interfaces\AnimeRepositoryInterfaces
	 */
	private $firstAnime;

	/**
	 * HomeController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->keyCache = 'home';
		$this->firstAnime = $animeRepositoryInterfaces;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		if (Cache::has($this->keyCache)) {
			$ongoing = Cache::get($this->keyCache);
		} else {
			$ongoing = self::setCache($this->keyCache, $this->firstAnime->getFirstPageAnime(5)->get());
		}

		return view('web.frontend.anime.home', compact('ongoing'));
	}
}
