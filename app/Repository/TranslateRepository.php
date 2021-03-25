<?php


namespace App\Repository;


use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function getAnime($translateUrl): mixed
	{
		return Translate::where('url', $translateUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getTranslate(): mixed
	{
		return Translate::get();
	}

	/**
	 * @param  string                    $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setTranslate(string $name, Request $request): mixed
	{
		// TODO: Implement setTranslate() method.
	}
}