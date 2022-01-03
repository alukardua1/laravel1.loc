<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class CarouselAnimeComposer extends ComposersAbstract
{
	private AnimeRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->repository = $animeRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	protected function view(): mixed
	{
		return $this->repository->getFirstPageAnime(100)->get();
	}

	/**
	 * @param  View  $view
	 */
	public function compose(View $view)
	{
		$view->with('carousel', $this->view());
	}
}