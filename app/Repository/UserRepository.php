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
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function getUser(string $login): mixed
	{
		return User::where('login', $login)
			->firstOrFail();
	}

	/**
	 * @return mixed
	 */
	public function getUsers(): mixed
	{
		return User::get();
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function getPM(string $login): mixed
	{
		dd(__METHOD__, Auth::id(), 11);
	}

	/**
	 * @param  Request  $request
	 * @param  string   $login
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