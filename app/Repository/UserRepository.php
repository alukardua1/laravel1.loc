<?php


namespace App\Repository;


use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use App\Services\FunctionTrait;
use App\Services\UsersTrait;
use Auth;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 *
 * @package App\Repository
 */
class UserRepository implements UserRepositoryInterfaces
{
	use UsersTrait, FunctionTrait;

	/**
	 * Получает пользователя по логину
	 *
	 * @param  string  $login Логин пользователя
	 *
	 * @return mixed
	 */
	public function getUser(string $login): mixed
	{
		return User::where('login', $login)
			->firstOrFail();
	}

	/**
	 * Получает всех пользователей
	 *
	 * @return mixed
	 */
	public function getUsers(): mixed
	{
		return User::get();
	}

	/**
	 * Получает персональные сообщения пользователя
	 *
	 * @param  string  $login Логин пользователя
	 *
	 * @return mixed
	 * @todo В разработке
	 */
	public function getPM(string $login): mixed
	{
		dd(__METHOD__, Auth::id(), 11);
	}

	/**
	 * Добавление/обновление пользователя
	 *
	 * @param  Request  $request Запрос
	 * @param  string   $login Логин пользователя
	 *
	 * @return mixed
	 */
	public function setUsers(Request $request, string $login): mixed
	{
		if ($request->user()) {
			$updateUser = User::where('login', $login)->first();
			$requestForm = $request->all();
			$requestForm['country_id'] = $requestForm['land'];

			if ($requestForm['altpass']) {
				$this->updatePasswords($updateUser, $requestForm);
			}

			$requestForm['allow_mail'] = $this->check($requestForm, 'allow_mail');
			$requestForm['comments_reply_subscribe'] = $this->check($requestForm, 'comments_reply_subscribe');
			$requestForm['anime_subscribe'] = $this->check($requestForm, 'anime_subscribe');
			$requestForm['hide_email'] = $this->check($requestForm, 'hide_email');

			if (isset($requestForm['del_foto'])) {
				$requestForm = $this->deleteAvatar($updateUser, $requestForm);
			}
			if ($request->hasFile('profile_photo_path')) {
				$requestForm = $this->uploadAvatar($updateUser, $requestForm);
			}

			$validated = $request->validated();

			User::flushQueryCache(['user']);

			return $updateUser->update($requestForm);
		}
	}
}