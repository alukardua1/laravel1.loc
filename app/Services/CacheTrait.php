<?php


namespace App\Services;


use Cache;
use Config;

trait CacheTrait
{
	/**
	 * Создает кэш
	 *
	 * @param  string  $key
	 * @param  mixed   $post
	 *
	 * @return mixed
	 */
	public static function setCache(string $key, $post)
	{
		$ttl = Config::get('secondConfig.cache_time');

		return Cache::remember(
			$key,
			$ttl * 86400,
			function () use ($post) {
				return $post;
			}
		);
	}
}
