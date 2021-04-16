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
	 * @param  string  $login Логин пользователя
	 *
	 * @return mixed
	 */
	public function getUser(string $login): mixed;

	/**
	 * Получает всех пользователей
	 *
	 * @return mixed
	 */
	public function getUsers(): mixed;

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
	 * @param  Request  $request Запрос
	 * @param  string   $login Логин пользователя
	 *
	 * @return mixed
	 */
	public function setUsers(Request $request, string $login): mixed;
}