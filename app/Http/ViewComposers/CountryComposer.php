<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\View\View;

class CountryComposer
{
	public                                $country;
	protected CountryRepositoryInterfaces $countryRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\CountryRepositoryInterfaces  $countryRepositoryInterfaces
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		$this->countryRepository = $countryRepositoryInterfaces;
		$this->country = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->countryRepository->getCountry();
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
		$view->with('country', $this->country);
	}
}