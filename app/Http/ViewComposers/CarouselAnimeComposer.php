<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Traits\CacheTrait;
use Cache;
use Illuminate\View\View;

/**
 * Class CarouselAnimeComposer
 *
 * @package App\Http\ViewComposers
 */
class CarouselAnimeComposer
{
	protected $key = 'carousel';
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
		if (Cache::has($this->key)) {
			$item = Cache::get($this->key);
		} else {
			$item = self::setCache($this->key, $this->animeAll->getCustomAnime('status', 'ongoing')->get());
		}

		return $item;
	}

	public function compose(View $view)
	{
		$view->with('animeCarousel', $this->anime);
	}
}