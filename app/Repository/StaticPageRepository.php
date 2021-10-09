<?php

namespace App\Repository;

use App\Models\StaticPage;
use App\Repository\Interfaces\StaticPageRepositoryInterfaces;

class StaticPageRepository implements StaticPageRepositoryInterfaces
{

	/**
	 * @param  string|null  $page
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPage(string $page = null, bool $isAdmin = false): mixed
	{
		if ($page) {
			return StaticPage::where('url', $page);
		} elseif ($isAdmin) {
			return StaticPage::sortBy('created_at', 'DESC');
		} else {
			return StaticPage::where('public_at', 1)->sortBy('created_at', 'DESC');
		}
	}

	/**
	 * @param  \Request  $request
	 * @param  string    $page
	 *
	 * @return mixed
	 */
	public function setPage(\Request $request, string $page): mixed
	{
		// TODO: Implement setPage() method.
	}

	/**
	 * @param  string  $page
	 *
	 * @return mixed
	 */
	public function delPage(string $page): mixed
	{
		// TODO: Implement delPage() method.
	}
}