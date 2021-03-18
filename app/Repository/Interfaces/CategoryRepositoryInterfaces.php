<?php


namespace App\Repository\Interfaces;


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
	public function getCategories();

	/**
	 * @param  string  $categoryUrl
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl);
}