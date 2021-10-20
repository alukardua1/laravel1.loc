<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface UserRepositoryInterfaces
{
	/**
	 * Получает пользователя по логину
	 *
	 * @param  string|null  $login  Логин пользователя
	 *
	 * @return mixed
	 */
	public function getUser(string $login = null): mixed;

	/**
	 * Получает персональные сообщения пользователя
	 *
	 * @param  string  $login Логин пользователя
	 *
	 * @return mixed
	 * @todo В разработке
	 */
	public function getPM(string $login): mixed;

	/**
	 * Добавление/обновление пользователя
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $login    Логин пользователя
	 *
	 * @return mixed
	 */
	public function setUsers(Request $request, string $login = null): mixed;

	/**
	 * Удаление Пользователя
	 *
	 * @param  string  $login
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function destroyUser(string $login, bool $fullDel = false): mixed;
}