<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Storage;

trait UsersTrait
{
	/**
	 * Загружает аватар в профиль
	 *
	 * @param  mixed  $updateUser
	 * @param  mixed  $requestForm
	 *
	 * @return mixed
	 */
	public function uploadAvatar(mixed $updateUser, mixed $requestForm): array
	{
		if (file_exists('storage/' . $updateUser->profile_photo_path)) {
			$requestForm = $this->deleteAvatar($updateUser, $requestForm);
		}

		$Extension = $requestForm['profile_photo_path']->getClientOriginalExtension();
		$fileName = 'avatar_' . $updateUser->id . '_' . date(time()) . '.' . $Extension;

		Storage::putFileAs('/avatars/' . $updateUser->login . '/', $requestForm['profile_photo_path'], $fileName);

		$requestForm['profile_photo_path'] = 'avatars/' . $updateUser->login . '/' . $fileName;
		dd(__METHOD__, $fileName, $requestForm);
		return $requestForm;
	}

	/**
	 * Удаляет текущий аватар
	 *
	 * @param  mixed  $updateUser
	 * @param  mixed  $requestForm
	 *
	 * @return array
	 */
	private function deleteAvatar(mixed $updateUser, mixed $requestForm): array
	{
		Storage::delete($updateUser->profile_photo_path);
		if (isset($requestForm['del_foto'])) {
			$requestForm['profile_photo_path'] = '';
		}

		return $requestForm;
	}

	/**
	 * Обновляет пароль
	 *
	 * @param  mixed  $updateUser
	 * @param  mixed  $requestForm
	 *
	 * @return string
	 */
	public function updatePasswords(mixed $updateUser, mixed &$requestForm): string
	{
		if (Hash::check($requestForm['altpass'], $updateUser['password1'])) {
			return $requestForm['password1'] = Hash::make($requestForm['password2']);
		}

		return back()->withErrors(['msg' => 'Введите правильный пароль'])->withInput();
	}

	/**
	 * @param  mixed  $user
	 *
	 * @return mixed
	 */
	public function refactoringUser(mixed $user): User
	{
		$user->age = Carbon::now()->diffInYears($user->date_of_birth);
		if (!isset($user->name)) {
			$user->name = 'Не указано';
		}
		$user->date_of_birth = Carbon::parse($user->date_of_birth)->format('d.m.Y');
		$user->register = Carbon::parse($user->created_at)->format('d.m.Y');

		return $user;
	}
}
