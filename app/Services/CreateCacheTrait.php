<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Services;


use Cache;

/**
 * Trait CreateCacheTrait
 *
 * @package App\Helpers
 */
trait CreateCacheTrait
{
	/**
	 * Создает кэш
	 *
	 * @param  string  $key
	 * @param          $post
	 *
	 * @return mixed
	 */
	public static function setCache(string $key, $post)
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