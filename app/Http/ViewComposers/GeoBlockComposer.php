<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\View\View;

class GeoBlockComposer extends ComposersAbstract
{
	private GeoBlockRepositoryInterfaces $repository;

	/**
	 * GeoBlockComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\GeoBlockRepositoryInterfaces  $geoBlockRepositoryInterfaces
	 */
	public function __construct(GeoBlockRepositoryInterfaces $geoBlockRepositoryInterfaces)
	{
		$this->repository = $geoBlockRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	protected function view(): mixed
	{
		return $this->repository->getGeoBlock()->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('geoBlock', $this->view());
	}
}