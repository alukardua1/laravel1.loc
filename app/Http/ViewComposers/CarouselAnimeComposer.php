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
	protected mixed                     $carousel;
	protected AnimeRepositoryInterfaces $animeRepository;

	/**
	 * CarouselAnimeComposer constructor.
	 *
	 * @param  AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeRepository = $animeRepositoryInterfaces;
		$this->carousel = $this->carousel();
	}

	/**
	 * @return mixed
	 */
	public function carousel(): mixed
	{
		return $this->animeRepository->getFirstPageAnime(100)->get();
	}

	/**
	 * @param  View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeCarousel', $this->carousel);
	}
}