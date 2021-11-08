<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\ChannelRequest;

interface ChannelRepositoryInterfaces
{
	/**
	 * Получает все каналы
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getChannel(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * Добавление/обновление канала
	 *
	 * @param  \App\Http\Requests\ChannelRequest  $request  Запрос
	 * @param  string|null                        $url
	 *
	 * @return mixed
	 */
	public function setChannel(ChannelRequest $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteChannel(string $url, bool $fullDel = false): mixed;
}