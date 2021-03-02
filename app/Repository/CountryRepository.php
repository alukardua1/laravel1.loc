<?php


namespace App\Repository;


use App\Models\Country;
use App\Repository\Interfaces\CountryRepositoryInterfaces;

class CountryRepository implements CountryRepositoryInterfaces
{
	public function getAnime($kind)
	{
		return Country::latest()
			->where('url', $kind)
			->first();
	}

	public function getCountry()
	{
		return Country::latest()
			->get();
	}
}