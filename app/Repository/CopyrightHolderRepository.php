<?php


namespace App\Repository;


use App\Models\CopyrightHolder;
use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CopyrightHolderRepository implements CopyrightHolderRepositoryInterfaces
{
	private Model $model;

	public function __construct(CopyrightHolder $copyrightHolder)
	{
		$this->model = $copyrightHolder;
	}

	/**
	 * Получает всех правообладателей
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(string $url = null): mixed
	{
		if ($url) {
			return $this->model->where('title', $url);
		}
		return $this->model->orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление правообладателя
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(Request $request, string $url = null): mixed
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
	public function deleteCopyrightHolder(string $url, bool $fullDel = false): mixed
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