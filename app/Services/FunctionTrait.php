<?php

namespace App\Services;

trait FunctionTrait
{
	public function isNotNull($post)
	{
		if (empty($post)) {
			return abort(404);
		}
	}
}