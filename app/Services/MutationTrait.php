<?php


namespace App\Services;


trait MutationTrait
{
	public function categoryMutation($category): string
	{
		$result = [];
		foreach ($category as $value) {
			$result[] = "<a href=\"/category/{$value->url}\">{$value->title}</a>";
		}
		$result = implode(' / ', $result);
		return $result;
	}
	
	public function blockPlayer($anime)
	{
		if ($anime->blocking == 1) {
		    $anime->player = null;
		    $anime->blockText = 'Анме заблокировано по просьбе правообладателя';
		}
		return $anime;
	}
}