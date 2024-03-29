<?php


namespace App\Repository;


use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use App\Services\FunctionTrait;
use App\Services\UsersTrait;
use Auth;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterfaces
{
	use FunctionTrait;
	use UsersTrait;

	private Model $model;

	public function __construct(User $user)
	{
		$this->model = $user;
	}

	/**
	 * Получает пользователя по логину
	 *
	 * @param  string|null  $login  Логин пользователя
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getUser(string $login = null, bool $isAdmin = false): mixed
	{
		if ($login) {
			return $this->model->where('login', $login)->firstOrFail();
		} elseif ($isAdmin) {
			return $this->model->orderBy('id', 'ASC')->withTrashed();
		}

		return $this->model->orderBy('id', 'ASC');
	}

	/**
	 * Получает персональные сообщения пользователя
	 *
	 * @param  string  $login  Логин пользователя
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
	 * @param  Request      $request  Запрос
	 * @param  string|null  $login    Логин пользователя
	 *
	 * @return mixed
	 */
	public function setUsers(Request $request, string $login = null): mixed
	{
		$requestForm = $request->all();
		if ($requestForm['password1']) {
			$requestForm['password'] = Hash::make($requestForm['password1']);
		}
		$updateUser = $this->model->updateOrCreate(['login' => $login], $requestForm);
		if ($updateUser) {
			if (!empty($requestForm['land'])) {
				$requestForm['country_id'] = $requestForm['land'];
			}

			if (!empty($requestForm['altpass'])) {
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

			//User::flushQueryCache(['user']);

			return $updateUser->save();
		}
	}

	/**
	 * @param  string  $login
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteUser(string $login, bool $fullDel = false): mixed
	{
		$delete = $this->model->findOrFail($login, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}