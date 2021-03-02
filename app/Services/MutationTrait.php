<?php


namespace App\Services;


/**
 * Trait MutationTrait
 *
 * @package App\Services
 */
trait MutationTrait
{
	/**
	 * Формирование ссылки категорий
	 *
	 * @param  mixed  $category
	 *
	 * @return string
	 */
	public function categoryMutation($category): string
	{
		$result = [];
		foreach ($category as $value) {
			$result[] = "<a href=\"/category/{$value->url}\">{$value->title}</a>";
		}
		$result = implode(' / ', $result);
		return $result;
	}

	/**
	 * Блокировка плеера
	 *
	 * @param  mixed  $anime
	 *
	 * @return mixed
	 */
	public function blockPlayer($anime)
	{
		if ($anime->blocking == 1) {
			$anime->player = null;
			$anime->blockText = 'Анме заблокировано по просьбе правообладателя';
		}
		return $anime;
	}

	/**
	 * Формирование сеанса показа
	 *
	 * @param $broadcast
	 *
	 * @return string
	 */
	public function broadcast($broadcast)
	{
		$broadcast = new \DateTime($broadcast);

		switch ($broadcast) {
			case $broadcast >= new \DateTime('23:00'):
			case $broadcast < new \DateTime('6:00'):
				return $broadcast = '[Ночной сеанс]';
			case $broadcast >= new \DateTime('06:00')&& $broadcast < new \DateTime('12:00'):
				return $broadcast = '[Утрений сеанс]';
			case $broadcast >= new \DateTime('12:00')&& $broadcast < new \DateTime('18:00'):
				return $broadcast = '[Дневной сеанс]';
			case $broadcast >= new \DateTime('18:00')&& $broadcast < new \DateTime('23:00'):
				return $broadcast = '[Вечерний сеанс]';
		}
	}

	/**
	 * Проверка на пустое значение
	 *
	 * @param  mixed  $unknown
	 *
	 * @return \Illuminate\Support\Collection
	 * @todo Решить нужно ли
	 */
	public function unknown($unknown): \Illuminate\Support\Collection
	{
		if (!$unknown) {
			$unknown = collect(['name', 'url']);
			$unknown->name = 'не известно';
			$unknown->url = '';
			return $unknown;
		}
		return $unknown;
	}

	/**
	 * Формирование сезона показа
	 *
	 * @param $aired
	 *
	 * @return string
	 */
	public function seasonAired($aired): string
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

	public function votePlusMinus($vote)
	{
		$result['plus'] = 0;
		$result['minus'] = 0;

		foreach ($vote as $value)
		{
			if ($value->votes > 0) {
				$result['plus'] += $value->votes;
			}else{
				$result['minus'] += $value->votes;
			}
		}
		$summ = $result['plus'] + $result['minus'];
		if ($summ > 0) {
			$result['rating'] = "<span class=\"ratingtypeplusminus ignore-select ratingplus\">+ {$summ}</span>";
		}elseif ($summ<0){
			$result['rating'] = "<span class=\"ratingtypeplusminus ignore-select ratingminus\">{$summ}</span>";
		}else {
			$result['rating'] = "<span class=\"ratingtypeplusminus ignore-select ratingzero\">{$summ}</span>";
		}


		return $result;
	}
}