<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CountryController extends Controller
{
	private CountryRepositoryInterfaces $repository;

	/**
	 * CountryController constructor.
	 *
	 * @param  CountryRepositoryInterfaces  $countryRepositoryInterfaces
	 */
	public function __construct(CountryRepositoryInterfaces $countryRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $countryRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $countryUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $countryUrl): View|Factory|Application
	{
		$showCountry = $this->repository->getCountry($countryUrl);
		$this->isNotNull($showCountry);
		$title = $showCountry->title;
		$description = $showCountry->description;
		$allAnime = $showCountry->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showCountry', 'allAnime', 'title', 'description'));
	}
}
