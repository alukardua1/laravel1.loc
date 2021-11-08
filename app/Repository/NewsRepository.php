<?php


namespace App\Repository;


use App\Models\News;
use App\Repository\Interfaces\NewsRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NewsRepository implements NewsRepositoryInterfaces
{
	private Model $model;

	public function __construct(News $news)
	{
		$this->model = $news;
	}

	/**
	 * @param  int|null  $id
	 * @param  int|null  $limit
	 * @param  bool      $isAdmin
	 *
	 * @return mixed
	 */
	public function getNews(int $id = null, int $limit = null, bool $isAdmin = false): mixed
	{
		if ($id) {
			return $this->model->where($id);
		} elseif ($limit) {
			return $this->model->limit($limit)->orderBy('updated_at', 'DESC');
		} elseif ($isAdmin) {
			return $this->model->orderBy('updated_at', 'DESC')->withTrashed();
		}
		return $this->model->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int|null                  $id
	 *
	 * @return mixed
	 */
	public function setNews(Request $request, int $id = null): mixed
	{
		$formRequest = $request->all();
		$update = $this->model->updateOrCreate(['url' => $id], $formRequest);
		if ($update) {
			return $update->save();
		}
	}

	/**
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @return mixed
	 */
	public function deleteNews(int $id, bool $fullDel = false): mixed
	{
		$delete = $this->model->findOrFail($id, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}