<?php

namespace App\Traits;

trait FunctionTrait
{
	public function isNotNull($post)
	{
		if (empty($post)) {
			return abort(404);
		}
	}
}