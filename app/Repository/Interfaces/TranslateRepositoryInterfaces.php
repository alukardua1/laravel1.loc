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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind);

	/**
	 * @return mixed
	 */
	public function getTranslate();
}