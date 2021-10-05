<?php

namespace App\Http\ViewComposers;

use App\Repository\Interfaces\BannerRepositoryInterfaces;
use Illuminate\View\View;

class BannerComposer
{
	protected mixed                      $banner;
	protected BannerRepositoryInterfaces $bannerRepository;

	/**
	 * CarouselAnimeComposer constructor.
	 *
	 * @param  BannerRepositoryInterfaces  $bannerRepositoryInterfaces
	 * @param                              $banner
	 */
	public function __construct(BannerRepositoryInterfaces $bannerRepositoryInterfaces, $banner)
	{
		dd(__METHOD__, $banner);
		$this->bannerRepository = $bannerRepositoryInterfaces;
		$this->banner = $this->banner($banner);
	}

	/**
	 * @param $banner
	 *
	 * @return mixed
	 */
	public function banner($banner): mixed
	{
		return $this->bannerRepository->getBanner($banner);
	}

	/**
	 * @param  View  $view
	 */
	public function compose(View $view)
	{
		//dd(__METHOD__, $this->banner[1]);
		$view->with('banner', $this->banner);
	}
}