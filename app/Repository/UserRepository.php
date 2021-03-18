<?php


namespace App\Repository;


use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use App\Services\FunctionTrait;
use App\Services\UsersTrait;

/**
 * Class UserRepository
 *
 * @package App\Repository
 */
class UserRepository implements UserRepositoryInterfaces
{
	use UsersTrait, FunctionTrait;

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getUser($user)
	{
		return User::where('login', $user)
			->firstOrFail();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getUsers()
	{
		return User::get();
	}

	/**
	 * @param $user
	 *
	 * @return mixed|void
	 */
	public function getPM($user)
	{
		dd(__METHOD__, \Auth::id(), 11);
	}

	/**
	 * @param $request
	 * @param $currentUser
	 *
	 * @return mixed
	 */
	public function setUsers($request, $currentUser)
	{
		if ($request->user()) {
			$updateUser = User::where('login', $currentUser)->first();
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