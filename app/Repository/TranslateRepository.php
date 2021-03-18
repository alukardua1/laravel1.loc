<?php


namespace App\Repository;


use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;

/**
 * Class TranslateRepository
 *
 * @package App\Repository
 */
class TranslateRepository implements TranslateRepositoryInterfaces
{
	/**
	 * @param $translateUrl
	 *
	 * @return mixed
	 */
	public function getAnime($translateUrl)
	{
		return Translate::where('url', $translateUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getTranslate()
	{
		return Translate::get();
	}
}