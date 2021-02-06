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
	 * @param $category
	 *
	 * @return mixed
	 */
	public function getCategory($category);
}