<?php


namespace App\Repository\Interfaces;


interface CategoryRepositoryInterfaces
{
	public function getCategories();

	public function getCategory($category);
}