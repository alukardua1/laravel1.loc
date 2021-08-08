<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
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
	 * @param  Request      $request  Запрос
	 * @param  string|null  $login    Логин пользователя
	 *
	 * @return mixed
	 */
	public function setUsers(Request $request, string $login = null): mixed;
}