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
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->popular = $this->popular();
	}

	/**
	 * @return mixed
	 */
	public function popular()
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