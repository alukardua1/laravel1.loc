<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Services\CacheTrait;
use Cache;
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

	use CacheTrait;

	public function __construct(AnimeRepositoryInterfaces $animeRepositoryInterfaces)
	{
		$this->animeAll = $animeRepositoryInterfaces;
		$this->anime = $this->anime();
	}

	public function anime()
	{
		return $this->animeAll->getCustomAnime('status', 'ongoing')->get();
	}

	public function compose(View $view)
	{
		$view->with('animeCarousel', $this->anime);
	}
}