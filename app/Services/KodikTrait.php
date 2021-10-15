<?php

namespace App\Services;

use Carbon\Carbon;

trait KodikTrait
{
	/**
	 * @param  mixed  $value
	 * @param  string  $type
	 *
	 * @return string
	 */
	public function isKodik(mixed $value, string $type)
	{
		if ($value) {
			return $value = $type . $value;
		}
	}

	/**
	 * @param  array  $prev_next
	 *
	 * @return array
	 */
	public function createButton(array $prev_next): array
	{
		if (!$prev_next['prev_page']) {
			$result['prev_page'] = 'disabled';
			$result['prev_page_link'] = null;
			$result['next_page'] = null;
			$result['next_page_link'] = $this->parseLinkKodik($prev_next['next_page']);
		} elseif (!$prev_next['next_page']) {
			$result['next_page'] = 'disabled';
			$result['next_page_link'] = null;
			$result['prev_page'] = null;
			$result['prev_page_link'] = $this->parseLinkKodik($prev_next['prev_page']);
		} else {
			$result['next_page'] = null;
			$result['next_page_link'] = $this->parseLinkKodik($prev_next['next_page']);
			$result['prev_page'] = null;
			$result['prev_page_link'] = $this->parseLinkKodik($prev_next['prev_page']);
		}

		return $result;
	}

	/**
	 * @param  mixed  $url
	 *
	 * @return string
	 */
	private function parseLinkKodik(mixed $url): string
	{
		$result = parse_url($url);
		parse_str($result['query'], $id);
		if (!array_key_exists('page', $id)) {
			$id['page'] = '/';
		}
		return $id['page'];
	}

	/**
	 * @param  string  $type
	 *
	 * @return string
	 */
	public function typeMeny(string $type): string
	{
		return match ($type) {
			'foreign-movie', 'russian-movie', 'soviet-cartoon', 'russian-cartoon', 'foreign-cartoon' => '<span class="badge badge-info">Фильмы</span>',
			'documentary-serial', 'foreign-serial', 'multi-part-film', 'russian-serial', 'russian-documentary-serial', 'cartoon-serial', 'russian-cartoon-serial' => '<span class="badge badge-info">Сериалы</span>',
			'anime' => '<span class="badge badge-info">Аниме</span>',
			'anime-serial' => '<span class="badge badge-info">Аниме сериалы</span>',
			default => '',
		};
	}

	public function isPlayer($player, $key, $db, $anime, &$json, $value)
	{
		if ($player) {
			$json['results'][$key]['link_update'] = '<a target="_blank" class="color_add_movie" href="' . route(
					'showAnime',
					[$db->anime_id, $anime->url]
				) . '">' . $value['title'] . '/' . $value['title_orig'] . '</a>';
		} else {
			$json['results'][$key]['link_update'] = '<a target="_blank" class="color_no_movie" href="' . route(
					'showAnime',
					[$db->anime_id, $anime->url]
				) . '">' . $value['title'] . '/' . $value['title_orig'] . '</a>';
		}
	}

	public function isTranslate($translate, $value, &$json, $key)
	{
		if ($translate->contains('name', $value['translation']['title'])) {
			$json['results'][$key]['translate_update'] = '<span class="color_add_movie">' . $value['translation']['title'] . '</span>';
		} else {
			$json['results'][$key]['translate_update'] = '<span class="color_no_movie">' . $value['translation']['title'] . '</span>';
		}
	}

	public function isSeries($series, $value, &$json, $key)
	{
		$value['last_episode'] = $value['last_episode'] ?? 1;
		if ($series >= $value['last_episode']) {
			$json['results'][$key]['last_episode_update'] = '<span class="color_add_movie">' . $value['last_episode'] . '</span>';
		} else {
			$json['results'][$key]['last_episode_update'] = '<span class="color_no_movie">' . $value['last_episode'] . '</span>';
		}
	}

	/**
	 * @param  mixed  $kodikDB
	 *
	 * @return array
	 */
	public function link(mixed $kodikDB)
	{
		$result = [];
		if (array_key_exists('worldart_link', $kodikDB)) {
			$waId = $this->parseWA($kodikDB['worldart_link']);
			$result['worldartUrl'] = "WA ID: <a target=\"_blank\" href=\"{$kodikDB['worldart_link']}\">{$waId}</a> <a class='copy-id' onclick='copyID(\"{$waId}\")'><i class=\"fa fa-clone\" aria-hidden=\"true\"></i></a>";
		}
		if (array_key_exists('kinopoisk_id', $kodikDB)) {
			$result['kinopoiskUrl'] = "КП ID: <a target=\"_blank\" href=\"https://www.kinopoisk.ru/film/{$kodikDB['kinopoisk_id']}/\">{$kodikDB['kinopoisk_id']}</a> <a class='copy-id' onclick='copyID(\"{$kodikDB['kinopoisk_id']}\")'><i class=\"fa fa-clone\" aria-hidden=\"true\"></i></a>";
		}
		if (array_key_exists('imdb_id', $kodikDB)) {
			$result['imDBUrl'] = "IMDb ID: <a target=\"_blank\" href=\"https://www.imdb.com/title/{$kodikDB['imdb_id']}/\">{$kodikDB['imdb_id']}</a> <a class='copy-id' onclick='copyID(\"{$kodikDB['imdb_id']}\")'><i class=\"fa fa-clone\" aria-hidden=\"true\"></i></a>";
		}
		if (array_key_exists('shikimori_id', $kodikDB)) {
			$result['shikimoriUrl'] = "Shikimori ID: <a target=\"_blank\" href=\"https://shikimori.one/animes/{$kodikDB['shikimori_id']}\">{$kodikDB['shikimori_id']}</a> <a class='copy-id' onclick='copyID(\"{$kodikDB['shikimori_id']}\")'><i class=\"fa fa-clone\" aria-hidden=\"true\"></i></a>";
		}
		if (array_key_exists('mdl_id', $kodikDB)) {
			$mdl_id = $this->parseMDLID($kodikDB['mdl_id']);
			$result['mdlUrl'] = "MDL ID: <a target=\"_blank\" href=\"https://mydramalist.com/{$kodikDB['mdl_id']}\">{$mdl_id}</a> <a class='copy-id' onclick='copyID(\"{$mdl_id}\")'><i class=\"fa fa-clone\" aria-hidden=\"true\"></i></a>";
		}

		return $result;
	}

	/**
	 * @param  string  $category
	 *
	 * @return array
	 */
	public function categoryTabActive(string $category): array
	{
		$categories = [];
		switch ($category) {
			case 'serials':
				$categories['serials'] = 'active';
				$categories['anime'] = null;
				$categories['anime_serials'] = null;
				$categories['movies'] = null;
				break;
			case 'anime':
				$categories['serials'] = null;
				$categories['anime'] = 'active';
				$categories['anime_serials'] = null;
				$categories['movies'] = null;
				break;
			case 'anime_serials':
				$categories['serials'] = null;
				$categories['anime'] = null;
				$categories['anime_serials'] = 'active';
				$categories['movies'] = null;
				break;
			default:
				$categories['serials'] = null;
				$categories['anime'] = null;
				$categories['anime_serials'] = null;
				$categories['movies'] = 'active';
				break;
		}

		return $categories;
	}

	/**
	 * @param  string  $date
	 *
	 * @return string
	 */
	public function mutateDat(string $date): string
	{
		return $result = (new Carbon($date))->format('d.m.Y (H:m)');
	}

	/**
	 * @param  string  $WALink
	 *
	 * @return mixed
	 */
	public function parseWA(string $WALink)
	{
		$wa = parse_url($WALink);
		parse_str($wa['query'], $id);

		return $id['id'];
	}

	/**
	 * @param  string  $id
	 *
	 * @return mixed
	 */
	private function parseMDLID(string $id): mixed
	{
		preg_match("/\d+/", $id, $MDL);

		return $MDL[0];
	}

	/**
	 * @param  string  $category
	 *
	 * @return string
	 */
	public function category(string $category): string
	{
		return match ($category) {
			'serials' => '&types=cartoon-serial,documentary-serial,russian-serial,foreign-serial,multi-part-film,russian-documentary-serial,russian-cartoon-serial',
			'anime' => '&types=anime',
			'anime_serials' => '&types=anime-serial',
			default => '&types=foreign-movie,soviet-cartoon,foreign-cartoon,russian-cartoon,russian-movie',
		};
	}
}