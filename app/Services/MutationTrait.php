<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Collection;

trait MutationTrait
{
	/**
	 * Формирование ссылки категорий
	 *
	 * @param  mixed  $category
	 *
	 * @return string
	 */
	public function categoryMutation(mixed $category): string
	{
		$result = [];
		foreach ($category as $value) {
			$result[] = "<a href=\"/category/" . $value->url . "\">" . $value->title . "</a>";
		}
		$result = implode(' / ', $result);
		return $result;
	}

	/**
	 * Формирование сеанса показа
	 *
	 * @param  mixed  $broadcast
	 *
	 * @return string
	 */
	public function broadcast(mixed $broadcast): string
	{
		$broadcast = new DateTime($broadcast);

		switch ($broadcast) {
			case $broadcast >= new DateTime('23:00'):
			case $broadcast < new DateTime('6:00'):
				return $broadcast = '[Ночной сеанс]';
			case $broadcast >= new DateTime('06:00') && $broadcast < new DateTime('12:00'):
				return $broadcast = '[Утрений сеанс]';
			case $broadcast >= new DateTime('12:00') && $broadcast < new DateTime('18:00'):
				return $broadcast = '[Дневной сеанс]';
			case $broadcast >= new DateTime('18:00') && $broadcast < new DateTime('23:00'):
				return $broadcast = '[Вечерний сеанс]';
		}
	}

	/**
	 * Проверка на пустое значение
	 *
	 * @param $unknown
	 *
	 * @return \Illuminate\Support\Collection
	 * @todo Решить нужно ли
	 */
	public function unknown($unknown): Collection
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
	 * @param  string  $aired
	 *
	 * @return string
	 */
	public function seasonAired(string $aired): string
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

	/**
	 * Формирует вывод голосов
	 *
	 * @param  mixed  $vote
	 *
	 * @return array
	 */
	public function votePlusMinus(mixed $vote): array
	{
		$result['plus'] = 0;
		$result['minus'] = 0;

		foreach ($vote as $value) {
			if ($value->votes > 0) {
				$result['plus'] += $value->votes;
			} else {
				$result['minus'] += $value->votes;
			}
		}
		$summ = $result['plus'] + $result['minus'];
		if ($summ > 0) {
			$result['rating'] = "<span class=\"ratingtypeplusminus ignore-select ratingplus\">+ " . $summ . "</span>";
		} elseif ($summ < 0) {
			$result['rating'] = "<span class=\"ratingtypeplusminus ignore-select ratingminus\">" . $summ . "</span>";
		} else {
			$result['rating'] = "<span class=\"ratingtypeplusminus ignore-select ratingzero\">" . $summ . "</span>";
		}


		return $result;
	}
}