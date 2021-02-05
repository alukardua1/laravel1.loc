<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	private $firstAnime;

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->keyCache = 'home';
		$this->firstAnime = $animeRepositoryInterfaces;
	}

	public function index()
	{
		if (Cache::has($this->keyCache))
		{
			$ongoing = Cache::get($this->keyCache);
		}else{
			$ongoing = self::setCache($this->keyCache, $this->firstAnime->getFirstPageAnime(5)->get());
		}

		return view('web.frontend.anime.home', compact('ongoing'));
	}
}
