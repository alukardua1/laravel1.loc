<?php

namespace App\Services;

trait FunctionTrait
{
	public function isNotNull($post)
	{
		abort_if(empty($post), 404);
	}
}