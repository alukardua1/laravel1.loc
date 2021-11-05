<?php


namespace App\Repository;


use App\Models\GeoBlock;
use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GeoBlockRepository implements GeoBlockRepositoryInterfaces
{
	private Model $model;

	public function __construct(GeoBlock $geoBlock)
	{
		$this->model = $geoBlock;
	}

	/**
	 * Получает ГеоБлок
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getGeoBlock(string $url = null): mixed
	{
		if ($url) {
			return $this->model->where('code', $url);
		}
		return $this->model->orderBy('code', 'ASC');
	}

	/**
	 * Добавление/обновление ГеоБлока
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setGeoBlock(Request $request, string $url = null): mixed
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
	public function delGeoBlock(string $url, bool $fullDel = false): mixed
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