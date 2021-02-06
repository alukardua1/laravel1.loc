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

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeAll = $animeRepositoryInterfaces;
		$this->anime = $this->anime();
	}

	public function anime()
	{
		$item = $this->animeAll->getCustomAnime('status', 'ongoing')->get();
		return $item;
	}

	public function compose(View $view)
	{
		$view->with('animeCarousel', $this->anime);
	}
}