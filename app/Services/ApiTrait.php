<?php


namespace App\Services;


/**
 * Trait ApiTrait
 *
 * @package App\Traits
 */
trait ApiTrait
{
	/**
	 * Api code 404
	 *
	 * @return array
	 */
	public function error404()
	{
		return [
			'error code'    => 404,
			'error message' => 'Not Found',
		];
	}

	/**
	 * Мутатор Апи пользователя
	 *
	 * @param $users
	 *
	 * @return array
	 * @todo Разобратся почему такая ошибка
	 */
	public function userMutations($users)
	{
		return [
			'id'    => $users->id,
			'login' => $users->login,
			'name'  => $users->name,
			'email' => $users->email,
			'group' => $users->getGroup->title,
		];
	}

	/**
	 * Мутатор Апи аниме
	 *
	 * @param $anime
	 *
	 * @return array
	 * @todo Разобратся почему такая ошибка
	 */
	public function animeMutations($anime)
	{
		$category = [];
		foreach ($anime->getCategory as $value) {
			$category[] = [
				'id'    => $value->id,
				'title' => $value->title,
				'url'   => '/' . $value->url . '/',
			];
		}

		return [
			'id'       => $anime->id,
			'image'    => [
				'original' => $anime->original_img,
				'preview'  => $anime->preview_img,
			],
			'name'     => $anime->name,
			'russian'  => $anime->russian,
			'url'      => '/anime/' . $anime->url,
			'category' => $category,
			'kind'     => [
				'name'       => $anime->getKind->name,
				'full_name'  => $anime->getKind->full_name,
				'short_name' => $anime->getKind->short_name,
			],
		];
	}
}
