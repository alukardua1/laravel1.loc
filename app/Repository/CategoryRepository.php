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
	 * @param  string|null  $categoryUrl
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl = null, bool $isAdmin = false): mixed
	{
		if ($categoryUrl) {
			return Category::where('url', $categoryUrl);
		} elseif ($isAdmin) {
			return Category::orderBy('title', 'DESC');
		}
		return Category::where('posted_at', '=', 1);
	}

	/**
	 * Добавление/обновление категории
	 *
	 * @param  string|null                         $categoryUrl  Урл категории
	 * @param  \App\Http\Requests\CategoryRequest  $request      Запрос
	 *
	 * @return mixed
	 */
	public function setCategory(CategoryRequest $request, string $categoryUrl = null): mixed
	{
		$formRequest = $request->all();
		if (!$categoryUrl) {
			$categoryUrl = $formRequest['url'];
		}
		$update = Category::firstOrCreate(['url' => $categoryUrl], $formRequest);
		if ($update) {
			$this->checkRequest($this->arrCheck, $formRequest, $update);
			return $update->save();
		}
	}

	/**
	 * Удаление категории
	 *
	 * @param  string  $categoryUrl  Урл категории
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delCategory(string $categoryUrl, bool $fullDel = false): mixed
	{
		$del = Category::where('url', $categoryUrl)->firstOrFail();
		if ($del) {
			if ($fullDel) {
				return $del->forceDelete();
			}
			return $del->delete();
		}
	}
}