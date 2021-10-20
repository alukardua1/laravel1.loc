<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\View\View;

class CountryComposer
{
	private CountryRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\CountryRepositoryInterfaces  $countryRepositoryInterfaces
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		$this->repository = $countryRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getCountry()->get();
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
		$view->with('country', $this->view());
	}
}