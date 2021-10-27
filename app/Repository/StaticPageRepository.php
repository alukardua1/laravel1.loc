<?php

namespace App\Repository;

use App\Models\StaticPage;
use App\Repository\Interfaces\StaticPageRepositoryInterfaces;
use Illuminate\Http\Request;

class StaticPageRepository implements StaticPageRepositoryInterfaces
{

	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPage(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return StaticPage::where('url', $url);
		} elseif ($isAdmin) {
			return StaticPage::sortBy('created_at', 'DESC');
		} else {
			return StaticPage::where('public_at', 1)->sortBy('created_at', 'DESC');
		}
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setPage(Request $request, string $url = null): mixed
	{
		// TODO: Implement setPage() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deletePage(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delPage() method.
	}
}