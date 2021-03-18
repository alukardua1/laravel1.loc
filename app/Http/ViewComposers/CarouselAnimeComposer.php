<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use Illuminate\View\View;

/**
 * Class CarouselAnimeComposer
 *
 * @package App\Http\ViewComposers
 */
class CarouselAnimeComposer
{
	protected                           $carousel;
	protected AnimeRepositoryInterfaces $animeRepository;

	/**
	 * CarouselAnimeComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->carousel = $this->anime();
	}

	/**
	 * @return mixed
	 */
	public function anime()
	{
		return $this->animeRepository->getFirstPageAnime(100)->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeCarousel', $this->carousel);
	}
}