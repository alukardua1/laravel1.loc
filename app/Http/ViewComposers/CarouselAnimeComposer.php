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
	protected $anime;
	protected $animeAll;

	/**
	 * CarouselAnimeComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\AnimeRepositoryInterfaces  $animeRepositoryInterfaces
	 */
	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeAll = $animeRepositoryInterfaces;
		$this->anime = $this->anime();
	}

	/**
	 * @return mixed
	 */
	public function anime()
	{
		return $this->animeAll->getCustomAnime('status', 'ongoing')->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('animeCarousel', $this->anime);
	}
}