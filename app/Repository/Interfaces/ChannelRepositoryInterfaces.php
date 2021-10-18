<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface ChannelRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface ChannelRepositoryInterfaces
{
	/**
	 * Получает все каналы
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getChannel(string $url = null): mixed;

	/**
	 * Добавление/обновление канала
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setChannel(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteChannel(string $url, bool $fullDel = false): mixed;
}