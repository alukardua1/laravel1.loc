<?php

namespace App\Repository;

use App\Models\StaticPage;
use App\Repository\Interfaces\StaticPageRepositoryInterfaces;

class StaticPageRepository implements StaticPageRepositoryInterfaces
{

	public function getPage(string $page = null)
	{
		if ($page) {
			return StaticPage::where('url', $page);
		} else {
			return StaticPage::sortBy('created_at', 'DESC');
		}
	}

	public function setPage(\Request $request, $page)
	{
		// TODO: Implement setPage() method.
	}
}