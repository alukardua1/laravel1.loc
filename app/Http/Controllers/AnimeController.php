<?php

namespace App\Http\Controllers;

use App\Repository\AnimeRepository;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
	protected $anime;


	public function __construct(AnimeRepository $animeRepository)
	{
		$this->anime = $animeRepository;
		$this->paginate = env('APP_PAGINATE', 10);
	}

	public function index()
	{
		$allAnime = $this->anime->getAllAnime()->paginate($this->paginate);

		dd(__METHOD__, $allAnime);
	}

	public function show($id, $url = null)
	{
		$showAnime = $this->anime->getAnime($id)->first();

		$this->isNotNull($showAnime);

		if ($url !== $showAnime->url) {
			return redirect('/anime/' . $showAnime->id . '-' . $showAnime->url, 301);
		}

		dd(__METHOD__, $showAnime);
	}
}
