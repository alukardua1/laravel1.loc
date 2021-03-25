<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$ongoing = $this->animeRepository->getFirstPageAnime($this->limit)->get();
		return view($this->frontend . 'anime.home', compact('ongoing'));
	}
}
