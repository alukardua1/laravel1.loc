<?php


namespace App\Repository;


use App\Models\Country;
use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CountryRepository implements CountryRepositoryInterfaces
{
	private Model $model;

	public function __construct(Country $country)
	{
		$this->model = $country;
	}

	/**
	 * Получает все страны
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getCountry(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		} elseif ($isAdmin) {
			return $this->model->orderBy('title', 'ASC')->withTrashed();
		}
		return $this->model->orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление страны
	 *
	 * @param  string|null  $url
	 * @param  Request      $request  Запрос
	 *
	 * @return mixed
	 */
	public function setCountry(Request $request, string $url = null): mixed
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
	public function deleteCountry(string $url, bool $fullDel = false): mixed
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