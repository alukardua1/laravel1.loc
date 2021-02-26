<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\AnimeRepositoryInterfaces;

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
		parent::__construct();
		$this->anime = $animeRepositoryInterfaces;
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$allAnime = $this->anime->getAllAnime()->paginate($this->paginate);
		return view($this->frontend . 'anime.short', compact('allAnime'));
	}

	/**
	 * @param  int   $id
	 * @param  null  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function show(int $id, $url = null)
	{
		$showAnime = $this->anime->getAnime($id)->first();

		$this->isNotNull($showAnime);
		$this->blockPlayer($showAnime);
		$showAnime->broadcastTitle = $this->broadcast($showAnime->broadcast);
		$showAnime->getChannel = $this->unknown($showAnime->getChannel);
		$showAnime->seasonAired = $this->seasonAired($showAnime->aired_on);

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}
		//dd(__METHOD__, $showAnime);
		return view($this->frontend . 'anime.full', compact('showAnime'));
	}
}
