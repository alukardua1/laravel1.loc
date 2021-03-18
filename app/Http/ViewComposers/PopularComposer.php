<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

class PopularComposer
{
	protected                           $popular;
	protected AnimeRepositoryInterfaces $animeRepository;

	/**
	 * CarouselAnimeComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->popular = $this->anime();
	}

	/**
	 * @return mixed
	 */
	public function anime()
	{
		return $this->animeRepository->getPopular(10)->get()->sortByDesc('read_count');
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeAnons', $this->popular);
	}
}