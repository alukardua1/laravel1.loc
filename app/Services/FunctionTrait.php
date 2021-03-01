<?php

namespace App\Services;

/**
 * Trait FunctionTrait
 *
 * @package App\Services
 */
trait FunctionTrait
{
	/**
	 * Проверяет наличие данных в запросе
	 *
	 * @param mixed $post
	 */
	public function isNotNull($post)
	{
		abort_if(empty($post), 404);
	}
}