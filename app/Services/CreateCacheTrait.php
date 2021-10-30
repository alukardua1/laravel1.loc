<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Services;

use Cache;

trait CreateCacheTrait
{
	/**
	 * Создает кэш
	 *
	 * @param  string  $key
	 * @param  mixed   $post
	 *
	 * @return mixed
	 */
	public static function setCache(string $key, mixed $post): mixed
	{
		$ttl = (int)config('secondConfig.cache_time');

		return Cache::remember(
			$key,
			$ttl * 86400,
			function () use ($post) {
				return $post;
			}
		);
	}
}