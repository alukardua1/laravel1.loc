<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\View\View;

/**
 * Class GeoBlockComposer
 *
 * @package App\Http\ViewComposers
 */
class GeoBlockComposer
{
	private mixed                        $geoBlock;
	private GeoBlockRepositoryInterfaces $geoBlockRepository;

	/**
	 * GeoBlockComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\GeoBlockRepositoryInterfaces  $geoBlockRepositoryInterfaces
	 */
	public function __construct(GeoBlockRepositoryInterfaces $geoBlockRepositoryInterfaces)
	{
		$this->geoBlockRepository = $geoBlockRepositoryInterfaces;
		$this->geoBlock = $this->geoBlock();
	}

	/**
	 * @return mixed
	 */
	public function geoBlock(): mixed
	{
		return $this->geoBlockRepository->getGeoBlock()->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('geoBlock', $this->geoBlock);
	}
}