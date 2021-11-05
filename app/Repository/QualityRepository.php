<?php


namespace App\Repository;


use App\Models\Quality;
use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class QualityRepository implements QualityRepositoryInterfaces
{
	private Model $model;

	public function __construct(Quality $quality)
	{
		$this->model = $quality;
	}

	/**
	 * Получает все качество видео
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getQuality(string $url = null): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		}
		return $this->model->orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление качества видео
	 *
	 * @param  \Illuminate\Http\Request  $request  запрос
	 * @param  string|null               $url      Урл качество видео
	 *
	 * @return mixed
	 */
	public function setQuality(Request $request, string $url = null): mixed
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
	public function deleteQuality(string $url, bool $fullDel = false): mixed
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