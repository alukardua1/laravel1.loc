<?php

namespace App\Repository;

use App\Models\StaticPage;
use App\Repository\Interfaces\StaticPageRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StaticPageRepository implements StaticPageRepositoryInterfaces
{
	private Model $model;

	public function __construct(StaticPage $staticPage)
	{
		$this->model = $staticPage;
	}

	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPage(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		} elseif ($isAdmin) {
			return $this->model->sortBy('created_at', 'DESC')->withTrashed();
		} else {
			return $this->model->where('public_at', 1)->sortBy('created_at', 'DESC');
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
		$formRequest = $request->all();
		$update = $this->model->updateOrCreate(['url' => $url], $formRequest);
		if ($update) {
			return $update->save();
		}
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deletePage(string $url, bool $fullDel = false): mixed
	{
		$delete = $this->model->findOrFail($url, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}