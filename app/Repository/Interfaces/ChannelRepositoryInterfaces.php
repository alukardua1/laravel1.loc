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
	 * Получает канал по названию
	 *
	 * @param  string  $channelUrl урл канала
	 *
	 * @return mixed
	 */
	public function getAnime(string $channelUrl): mixed;

	/**
	 * Получает все каналы
	 *
	 * @return mixed
	 */
	public function getChannel(): mixed;

	/**
	 * Добавление/обновление канала
	 *
	 * @param  string   $channelUrl урл канала
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setChannel(string $channelUrl, Request $request): mixed;
}