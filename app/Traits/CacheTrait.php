<?php


namespace App\Traits;


use Cache;

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
        $ttl = env('APP_CACHE_TIME', 10);

        return Cache::remember($key, $ttl * 86400, function() use ($post) {
            return $post;
        }
        );
    }
}
