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
	private AnimeRepositoryInterfaces $animeRepository;
	private int $limit;

	/**
	 * HomeController constructor.
	 *
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		parent::__construct();
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->limit = config('secondConfig.limitHomepage');
	}

	/**
	 * Вывод постов на главной странице
	 *
	 * @return mixed
	 */
	public function index()
	{
		$ongoing = $this->animeRepository->getFirstPageAnime($this->limit)->get();
		return view($this->frontend . 'anime.home', compact('ongoing'));
	}
}
