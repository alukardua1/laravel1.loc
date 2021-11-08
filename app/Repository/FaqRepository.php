<?php

namespace App\Repository;

use App\Models\Faq;
use App\Repository\Interfaces\FaqRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FaqRepository implements FaqRepositoryInterfaces
{
	private Model $model;

	public function __construct(Faq $faq)
	{
		$this->model = $faq;
	}

	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getFaq(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		} elseif ($isAdmin) {
			return $this->model->orderBy('created_at', 'DESC')->select(['id', 'title', 'url'])->withTrashed();
		} else {
			return $this->model->where('public_at', 1)->orderBy('created_at', 'DESC')->select(['id', 'title', 'url']);
		}
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setFaq(Request $request, string $url = null): mixed
	{
		$formRequest = $request->all();

		$update = $this->model->updateOrCreate(['url', $url], $formRequest);
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
	public function deleteFaq(string $url, bool $fullDel = false): mixed
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