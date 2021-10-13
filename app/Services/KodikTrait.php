<?php

namespace App\Services;

use Config;

trait KodikTrait
{
	/**
	 * @param  array  $prev_next
	 *
	 * @return array
	 */
	public function createButton(array $prev_next)
	{
		if (!$prev_next['prev_page'] or !$prev_next['next_page']) {
			$result['disable'] = 'disable';
		}

		return $result;
	}

	/**
	 * @param  string  $type
	 *
	 * @return string
	 */
	public function typeMeny(string $type)
	{
		return match ($type) {
			'foreign-movie', 'russian-movie', 'soviet-cartoon', 'russian-cartoon', 'foreign-cartoon' => '<span class="badge badge-info">Фильмы</span>',
			'documentary-serial', 'foreign-serial', 'multi-part-film', 'russian-serial', 'russian-documentary-serial', 'cartoon-serial', 'russian-cartoon-serial' => '<span class="badge badge-info">Сериалы</span>',
			'anime' => '<span class="badge badge-info">Аниме</span>',
			'anime-serial' => '<span class="badge badge-info">Аниме сериалы</span>',
			default => '',
		};
	}

	/**
	 * @param  mixed     $kodikDB
	 * @param  string    $translate
	 * @param  int|null  $key
	 *
	 * @return array
	 */
	public function isVoice(mixed $kodikDB, string $translate, int $key = null)
	{
		$color = ['color_add_movie' => Config::get('kodikConfig.color_add_movie'), 'color_no_movie' => Config::get('kodikConfig.color_no_movie')];
		if (isset($dleDB['xfields_voice'][$key])) {
			$voice = explode(', ', $dleDB['xfields_voice'][$key]);
			foreach ($voice as $keys => $item) {
				$voice[$keys] = trim($item, " \t\n\r\0\x0B");
			}
			$kodikDB['voice'] = trim($kodikDB['voice'], " \t\n\r\0\x0B");
			$result['translation_id'] = $kodikDB['voice_id'];
			if (in_array($kodikDB['voice'], $voice, true)) {
				$result['translation'] = "<span style=\"color:{$color['color_add_movie']}\">{$kodikDB['voice']}</span>";
				return $result;
			}
			$result['translation'] = "<span style=\"color:{$color['color_no_movie']}\">{$kodikDB['voice']}</span>";
			return $result;
		}

		$result['translation'] = $kodikDB['voice'];
		return $result;
	}
}