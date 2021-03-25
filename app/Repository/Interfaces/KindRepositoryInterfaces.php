<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface KindRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface KindRepositoryInterfaces
{
	/**
	 * @param  string  $kindUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $kindUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getKind(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setKind(string $name, Request $request): mixed;
}