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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return Translate::latest()
			->where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getTranslate()
	{
		return Translate::latest()
			->get();
	}
}