<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
	private $anime;



	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->keyCache = 'anime_';
		$this->anime = $animeRepositoryInterfaces;
		$this->paginate = env('APP_PAGINATE', 10);
	}

	public function index(Request $request)
	{
		$page = 'page_'. $request->get('page', 1);
		if (Cache::has($this->keyCache . $page)) {
			$allAnime = Cache::get($this->keyCache . $page);
		} else {
			$allAnime = self::setCache(
				$this->keyCache . $page,
				$this->anime->getAllAnime()->paginate($this->paginate)
			);
		}

		//$allAnime = $this->anime->getAllAnime()->paginate($this->paginate);

		//dd(__METHOD__, $allAnime);

		return view('anime.short', compact('allAnime'));
	}

	public function show($id, $url = null)
	{
		if (Cache::has($this->keyCache . $id)) {
			$showAnime = Cache::get($this->keyCache . $id);
		} else {
			$showAnime = self::setCache(
				$this->keyCache . $id,
				$showAnime = $this->anime->getAnime($id)->first()
			);
		}
		//$showAnime = $this->anime->getAnime($id)->first();

		$this->isNotNull($showAnime);

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}

		dd(__METHOD__, $showAnime);
	}
}
