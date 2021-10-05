<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\View\View;

class QualityComposer
{
	protected mixed                       $quality;
	protected QualityRepositoryInterfaces $qualityRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  QualityRepositoryInterfaces  $qualityRepositoryInterfaces
	 */
	public function __construct(QualityRepositoryInterfaces $qualityRepositoryInterfaces)
	{
		$this->qualityRepository = $qualityRepositoryInterfaces;
		$this->quality = $this->quality()->sortBy('name');
	}

	/**
	 * @return mixed
	 */
	public function quality(): mixed
	{
		return $this->qualityRepository->getQuality();
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
		$view->with('quality', $this->quality);
	}
}