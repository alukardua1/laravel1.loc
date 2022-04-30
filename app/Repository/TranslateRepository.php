<?php


namespace App\Repository;


use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TranslateRepository implements TranslateRepositoryInterfaces
{
	private Model $model;

	public function __construct(Translate $translate)
	{
		$this->model = $translate;
	}

	/**
	 * Получает все озвучивания
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getTranslate(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		} elseif ($isAdmin) {
			return $this->model->orderBy('title', 'ASC')->withTrashed();
		}
		return $this->model->orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление озвучивания
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url      Урл озвучмвания
	 *
	 * @return mixed
	 */
	public function setTranslate(Request $request, string $url = null): mixed
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
	public function deleteTranslate(string $url, bool $fullDel = false): mixed
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
