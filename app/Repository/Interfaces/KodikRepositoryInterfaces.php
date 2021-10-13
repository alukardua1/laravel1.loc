<?php

namespace App\Repository\Interfaces;

interface KodikRepositoryInterfaces
{
	/**
	 * @param  string|null  $category
	 * @param  string|null  $page
	 *
	 * @return mixed
	 */
	public function listKodik(string $category = null, string $page = null): mixed;

	/**
	 * @param  string  $optionsSearch
	 * @param  string  $search
	 *
	 * @return mixed
	 */
	public function searchKodik(string $optionsSearch, string $search): mixed;
}