<?php


namespace App\Repository;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use App\Services\FunctionTrait;

/**
 * Class CategoryRepository
 *
 * @package App\Repository
 */
class CategoryRepository implements CategoryRepositoryInterfaces
{
	use FunctionTrait;

	private array $arrCheck = [
		'posted_at' => 'posted_at',
	];

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
			return Category::where('url', $url);
		} elseif ($isAdmin) {
			return Category::orderBy('id', 'ASC');
		}
		return Category::where('posted_at', '=', 1);
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
		$update = Category::updateOrCreate(['url' => $url], $formRequest);
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
		$delete = Category::findOrFail($url, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}