<?php


namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface CategoryRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface CategoryRepositoryInterfaces
{

	/**
	 * @return mixed
	 */
	public function getCategories(): mixed;

	/**
	 * @param  string  $categoryUrl
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl): mixed;

	/**
	 * @param  string   $url
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setCategory(string $url, Request $request): mixed;
}