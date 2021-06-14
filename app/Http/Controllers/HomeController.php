<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Repository\Interfaces\NewsRepositoryInterfaces;
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
	private NewsRepositoryInterfaces  $newsRepository;
	private int                       $limit;

	/**
	 * HomeController constructor.
	 *
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 * @param  NewsRepositoryInterfaces   $newsRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces, NewsRepositoryInterfaces $newsRepositoryInterfaces)
	{
		parent::__construct();
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->newsRepository = $newsRepositoryInterfaces;
		$this->limit = config('secondConfig.limitHomepage');
	}

	/**
	 * Вывод постов на главной странице
	 *
	 * @return View|Factory|Application
	 */
	public function index(): View|Factory|Application
	{
		$ongoing = $this->animeRepository->getFirstPageAnime($this->limit)->get();
		$news = $this->newsRepository->getNewsAll($this->limit)->get();
		return view($this->frontend . 'anime.home', compact('ongoing', 'news'));
	}
}
