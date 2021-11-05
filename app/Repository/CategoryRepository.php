<?php


namespace App\Repository;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use App\Services\FunctionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository
 *
 * @package App\Repository
 */
class CategoryRepository implements CategoryRepositoryInterfaces
{
	use FunctionTrait;

	private Model $model;

	private array $arrCheck = [
		'posted_at' => 'posted_at',
	];

	public function __construct(Category $category)
	{
		$this->model = $category;
	}

	/**
	 * Получает все категории
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategory(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		} elseif ($isAdmin) {
			return $this->model->orderBy('id', 'ASC');
		}
		return $this->model->where('posted_at', '=', 1);
	}

	/**
	 * Добавление/обновление категории
	 *
	 * @param  string|null                         $url      Урл категории
	 * @param  \App\Http\Requests\CategoryRequest  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setCategory(CategoryRequest $request, string $url = null): mixed
	{
		$formRequest = $request->all();
		if (!$url) {
			$url = $formRequest['url'];
		}
		$update = $this->model->updateOrCreate(['url' => $url], $formRequest);
		if ($update) {
			$this->checkRequest($this->arrCheck, $formRequest, $update);

			return $update->save();
		}
	}

	/**
	 * Удаление категории
	 *
	 * @param  string  $url  Урл категории
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCategory(string $url, bool $fullDel = false): mixed
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