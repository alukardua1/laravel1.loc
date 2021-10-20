<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\View\View;

class QualityComposer
{
	private QualityRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\QualityRepositoryInterfaces  $qualityRepositoryInterfaces
	 */
	public function __construct(QualityRepositoryInterfaces $qualityRepositoryInterfaces)
	{
		$this->repository = $qualityRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getQuality()->get();
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 *
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('quality', $this->view());
	}
}