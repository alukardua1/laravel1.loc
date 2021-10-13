<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class PopularComposer
{
	private mixed                     $popular;
	private AnimeRepositoryInterfaces $animeRepository;

	/**
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->popular = $this->popular();
	}

	/**
	 * @return mixed
	 */
	public function popular(): mixed
	{
		return $this->animeRepository->getPopular(10)->get()->sortByDesc('read_count');
	}

	/**
	 * @param  View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeAnons', $this->popular);
	}
}