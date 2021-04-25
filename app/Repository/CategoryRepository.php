<?php


namespace App\Repository;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use App\Services\FunctionTrait;
use Illuminate\Http\Request;

/**
 * Class CategoryRepository
 *
 * @package App\Repository
 */
class CategoryRepository implements CategoryRepositoryInterfaces
{
	use FunctionTrait;

	private $arrCheck = [
		'posted_at'  => 'posted_at',
	];

	/**
	 * Получает все категории
	 *
	 * @param  bool  $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategories(bool $isAdmin = false): mixed
	{
		if ($isAdmin) {
		    return Category::all();
		}
		return Category::where('posted_at', '=', 1);
	}

	/**
	 * Получает категорию по названию
	 *
	 * @param  string  $categoryUrl  Урл категории
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl): mixed
	{
		return Category::where('url', $categoryUrl);
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
}