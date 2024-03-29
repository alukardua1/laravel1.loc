<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
	 * @param  \Illuminate\Database\Eloquent\Model  $user
	 * @param  string|null                          $custom
	 *
	 * @return array
	 */
	public function userMutations(Model $user, string $custom = null): array
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
	 * @param  \Illuminate\Database\Eloquent\Model  $anime
	 *
	 * @return array
	 */
	public function animeAllMutations(Model $anime): array
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
				'poster'   => [
					'original' => $item->original_img,
					'preview'  => $item->preview_img,
				],
				'name'     => $item->name,
				'russian'  => $item->russian,
				'japanese' => explode('|', $item->japanese),
				'url'      => '/anime/' . $item->id . '-' . $item->url,
				'category' => $this->animeCategory($item->getCategory),
				'episodes' => $item->episodes ?? null,
				'kind'     => [
					'name'       => $item->getKind->name,
					'full_name'  => $item->getKind->full_name,
					'short_name' => $item->getKind->short_name,
				],
				'anons'    => (bool)$item->anons,
				'ongoing'  => (bool)$item->ongoing,
				'released' => (bool)$item->released,
			];
		}

		return $result;
	}

	/**
	 * Создание массива категорий для Api
	 *
	 * @param  \Illuminate\Database\Eloquent\Collection  $category
	 *
	 * @return array
	 */
	private function animeCategory(Collection $category): array
	{
		$result = [];
		foreach ($category as $value) {
			$result[] = [
				'russian' => $value->title,
				'english' => $value->english,
			];
		}

		return $result;
	}

	/**
	 * @param  \Illuminate\Database\Eloquent\Collection  $studio
	 *
	 * @return array
	 */
	private function studio(Collection $studio): array
	{
		$result = [];
		foreach ($studio as $item) {
			$result[] = [
				'title' => $item->title,
				'url'   => '/' . $item->url . '/',
			];
		}

		return $result;
	}

	/**
	 * Мутатор Апи аниме
	 *
	 * @param  \Illuminate\Database\Eloquent\Model  $anime
	 *
	 * @return array
	 */
	public function animeOneMutations(Model $anime): array
	{
		return [
			'id'              => $anime->id,
			'poster'          => [
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
			'episodes'        => $anime->episodes ?? null,
			'episodes_aired'  => $anime->episodes_aired ?? null,
			'aired_on'        => $anime->aired_on,
			'released_on'     => $anime->released_on,
			'broadcast'       => $anime->broadcast ?? null,
			'channel'         => $anime->getChannel->title ?? null,
			'kind'            => [
				'name'       => $anime->getKind->name,
				'full_name'  => $anime->getKind->full_name,
				'short_name' => $anime->getKind->short_name,
			],
			'anons'           => (bool)$anime->anons,
			'ongoing'         => (bool)$anime->ongoing,
			'released'        => (bool)$anime->released,
			'description'     => $anime->description,
			'updated_at'      => date('c', strtotime($anime->updated_at)),
			'next_episode_at' => date('c', strtotime($anime->next_episode_at)),
			'studios'         => $this->studio($anime->getStudio),
			'license_name_ru' => $anime->license_name_ru,
			'videos'          => $this->video($anime->getTrailer),
			'other_links'     => $this->otherLink($anime->getOtherLink),
		];
	}

	/**
	 * @param  \Illuminate\Database\Eloquent\Collection  $link
	 *
	 * @return array
	 */
	private function otherLink(Collection $link): array
	{
		$result = [];
		foreach ($link as $item) {
			$result[] = [
				'title' => $item->title,
				'url'   => $item->url,
			];
		}

		return $result;
	}

	/**
	 * @param  \Illuminate\Database\Eloquent\Collection  $video
	 *
	 * @return array
	 */
	private function video(Collection $video): array
	{
		$result = [];
		foreach ($video as $item) {
			$result[] = [
				'url' => $item->url_trailer,
			];
		}

		return $result;
	}
}
