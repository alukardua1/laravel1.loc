<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class PopularComposer
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
	public function view(): mixed
	{
		return $this->repository->getPopular(10)->get()->sortByDesc('read_count');
	}

	/**
	 * @param  View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeAnons', $this->view());
	}
}