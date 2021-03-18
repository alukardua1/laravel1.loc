<?php


namespace App\Repository\Interfaces;


/**
 * Interface TranslateRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface TranslateRepositoryInterfaces
{
	/**
	 * @param  string  $translateUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $translateUrl);

	/**
	 * @return mixed
	 */
	public function getTranslate();
}