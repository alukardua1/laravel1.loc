<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface CopyrightHolderRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface CopyrightHolderRepositoryInterfaces
{
	/**
	 * @param  string  $copyrightHolder
	 *
	 * @return mixed
	 */
	public function getAnime(string $copyrightHolder): mixed;

	/**
	 * @return mixed
	 */
	public function getCopyrightHolder(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(string $name, Request $request): mixed;
}