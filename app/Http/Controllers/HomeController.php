<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Repository\Interfaces\NewsRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
	private AnimeRepositoryInterfaces $animeRepository;
	private NewsRepositoryInterfaces  $newsRepository;
	private int                       $limit;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 * @param  \App\Repository\Interfaces\NewsRepositoryInterfaces   $newsRepositoryInterfaces
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
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$ongoing = $this->animeRepository->getFirstPageAnime($this->limit)->get();
		$news = $this->newsRepository->getNews($this->limit)->get();

		return view($this->frontend . 'anime.home', compact('ongoing', 'news'));
	}
}
