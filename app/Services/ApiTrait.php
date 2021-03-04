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
	public function error404(): array
	{
		return [
			'error code'    => 404,
			'error message' => 'Not Found',
		];
	}

	/**
	 * Мутатор Апи пользователя
	 *
	 * @param        $users
	 * @param  null  $custom
	 *
	 * @return array
	 */
	public function userMutations($users, $custom = null): array
	{
		foreach ($users->favorites as $value) {
			$favorite[] = $this->animeMutations($value);
		}
		switch ($custom) {
			case 'favorite':
				return $favorite;
			case null:
				return [
					'id'    => $users->id,
					'login' => $users->login,
					'name'  => $users->name,
					'email' => $users->email,
					'group' => $users->getGroup->title,
				];
		}

		return $this->error404();
	}

	/**
	 * Вывод всех аниме
	 *
	 * @param $anime
	 *
	 * @return array
	 */
	public function animesMutations($anime): array
	{
		foreach ($anime as $item) {
			$result[] = [
				'id'       => $item->id,
				'image'    => [
					'original' => $item->original_img,
					'preview'  => $item->preview_img,
				],
				'name'     => $item->name,
				'russian'  => $item->russian,
				'url'      => '/anime/' . $item->url,
				'category' => $this->animeCategory($item->getCategory),
				'kind'     => [
					'name'       => $item->getKind->name,
					'full_name'  => $item->getKind->full_name,
					'short_name' => $item->getKind->short_name,
				],
			];
		}

		return $result;
	}

	/**
	 * Создание массива категорий для Api
	 *
	 * @param $category
	 *
	 * @return array
	 */
	private function animeCategory($category)
	{
		$result = [];
		foreach ($category as $value) {
			$result[] = [
				'id'    => $value->id,
				'title' => $value->title,
				'url'   => '/' . $value->url . '/',
			];
		}

		return $result;
	}

	/**
	 * Мутатор Апи аниме
	 *
	 * @param $anime
	 *
	 * @return array
	 * @todo Разобратся почему такая ошибка
	 */
	public function animeMutations($anime): array
	{
		return [
			'id'       => $anime->id,
			'image'    => [
				'original' => $anime->original_img,
				'preview'  => $anime->preview_img,
			],
			'name'     => $anime->name,
			'russian'  => $anime->russian,
			'url'      => '/anime/' . $anime->url,
			'category' => $this->animeCategory($anime->getCategory),
			'kind'     => [
				'name'       => $anime->getKind->name,
				'full_name'  => $anime->getKind->full_name,
				'short_name' => $anime->getKind->short_name,
			],
		];
	}
}
