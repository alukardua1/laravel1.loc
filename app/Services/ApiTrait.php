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
	 * @param  mixed        $user
	 * @param  string|null  $custom
	 *
	 * @return array
	 */
	public function userMutations(mixed $user, string $custom = null): array
	{
		$favorite = [];
		foreach ($user->favorites as $value) {
			$favorite[] = $this->animeAllMutations($value);
		}
		return match ($custom) {
			'favorite' => $favorite,
			null => [
				'id'    => $user->id,
				'login' => $user->login,
				'name'  => $user->name,
				'email' => $user->email,
				'group' => $user->getGroup->title,
			],
			default => $this->error404(),
		};
	}

	/**
	 * Вывод всех аниме
	 *
	 * @param  mixed  $anime
	 *
	 * @return array
	 */
	public function animeAllMutations(mixed $anime): array
	{
		$cur = $anime->currentPage();
		$last = $anime->lastPage();
		if ($cur == 1) {
			$prev_page = null;
		} else {
			$prev_page = $anime->path() . '?page=' . $anime->currentPage() - 1;
		}
		if ($last == $cur) {
			$next_page = null;
		} else {
			$next_page = $anime->path() . '?page=' . $anime->currentPage() + 1;
		}
		$result = [
			'total'     => $anime->total(),
			'prev_page' => $prev_page,
			'next_page' => $next_page,
		];
		foreach ($anime as $item) {
			$result['result'][] = [
				'id'       => $item->id,
				'image'    => [
					'original' => $item->original_img,
					'preview'  => $item->preview_img,
				],
				'name'     => $item->name,
				'russian'  => $item->russian,
				'english'  => explode(', ', $item->english),
				'japanese' => explode(', ', $item->japanese),
				'synonyms' => explode(', ', $item->synonyms),
				'url'      => '/anime/' . $item->id . '-' . $item->url,
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
	 * @param  mixed  $category
	 *
	 * @return array
	 */
	private function animeCategory(mixed $category): array
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
	 * @param  mixed  $studio
	 *
	 * @return array
	 */
	private function studio(mixed $studio)
	{
		foreach ($studio as $item) {
			$result[] = [
				'id'    => $item->id,
				'title' => $item->title,
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
	public function animeOneMutations($anime): array
	{
		return [
			'id'              => $anime->id,
			'image'           => [
				'original' => $anime->original_img,
				'preview'  => $anime->preview_img,
			],
			'name'            => $anime->name,
			'russian'         => $anime->russian,
			'english'         => explode('|', $anime->english),
			'japanese'        => explode('|', $anime->japanese),
			'synonyms'        => explode('|', $anime->synonyms),
			'url'             => '/anime/' . $anime->id . '-' . $anime->url,
			'category'        => $this->animeCategory($anime->getCategory),
			'kind'            => [
				'name'       => $anime->getKind->name,
				'full_name'  => $anime->getKind->full_name,
				'short_name' => $anime->getKind->short_name,
			],
			'status'          => $anime->status,
			'anons'           => (bool)$anime->anons,
			'ongoing'         => (bool)$anime->ongoing,
			'description'     => $anime->description,
			'updated_at'      => date('c', strtotime($anime->updated_at)),
			'next_episode_at' => date('c', strtotime($anime->next_episode_at)),
			'studios'         => $this->studio($anime->getStudio),
		];
	}
}
