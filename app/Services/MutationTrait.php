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

	public function broadcast($broadcast)
	{
		switch ($broadcast) {
			case $broadcast >= '21.00' && $broadcast < '06.00':
				return $broadcast = '[Ночной сеанс]';
			case $broadcast >= '06.00' && $broadcast < '12.00':
				return $broadcast = '[Утрений сеанс]';
			case $broadcast >= '12.00' && $broadcast < '18.00':
				return $broadcast = '[Дневной сеанс]';
			case $broadcast >= '18.00' && $broadcast < '23.00':
				return $broadcast = '[Вечерний сеанс]';
		}
	}

	public function unknown($unknown)
	{
		if (!$unknown) {
			$unknown = collect(['name', 'url']);
			$unknown->name = 'не известно';
			$unknown->url = '';
			return $unknown;
		}
		return $unknown;
	}

	public function seasonAired($aired)
	{
		$month = date('m', strtotime($aired));
		$year = date('Y', strtotime($aired));
		switch ($month) {
			case $month == '12' || $month >= '01' && $month < '03':
				return 'зима - ' . $year;
			case $month >= '03' && $month < '06':
				return 'весна - ' . $year;
			case $month >= '06' && $month < '09':
				return 'лето - ' . $year;
			case $month >= '09' && $month < '12':
				return 'осень - ' . $year;
		}
	}
}