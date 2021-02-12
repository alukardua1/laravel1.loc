<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Cache;
use Config;
use Illuminate\Http\Request;

/**
 * Class AnimeController
 *
 * @package App\Http\Controllers
 */
class AnimeController extends Controller
{
	/**
	 * @var \App\Repository\Interfaces\AnimeRepositoryInterfaces
	 */
	private $anime;


	/**
	 * AnimeController constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->keyCache = 'anime_';
		$this->anime = $animeRepositoryInterfaces;
		$this->paginate = Config::get('secondConfig.paginate');
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(Request $request)
	{
		$page = 'page_' . $request->get('page', 1);
		if (Cache::has($this->keyCache . $page) and (Config::get('secondConfig.cache_time') > 0)) {
			$allAnime = Cache::get($this->keyCache . $page);
		} else {
			$allAnime = self::setCache(
				$this->keyCache . $page,
				$this->anime->getAllAnime()->paginate($this->paginate)
			);
		}

		return view($this->frontend . 'anime.short', compact('allAnime'));
	}

	/**
	 * @param        $id
	 * @param  null  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function show($id, $url = null)
	{
		if (Cache::has($this->keyCache . $id) and (Config::get('secondConfig.cache_time') > 0)) {
			$showAnime = Cache::get($this->keyCache . $id);
		} else {
			$showAnime = self::setCache($this->keyCache . $id, $this->anime->getAnime($id)->first());
		}

		$this->isNotNull($showAnime);

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}
		//dd(__METHOD__, $showAnime->category);
		return view($this->frontend . 'anime.full', compact('showAnime'));
	}
}
