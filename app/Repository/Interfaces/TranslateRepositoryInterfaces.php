<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

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
	public function getAnime(string $translateUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getTranslate(): mixed;

	/**
	 * @param  string                    $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setTranslate(string $name, Request $request): mixed;
}