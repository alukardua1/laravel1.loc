<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Services;


use Carbon\Carbon;
use Hash;
use Lang;
use Storage;
use App\Models\User;

/**
 * Trait UsersTrait
 *
 * @package App\Traits
 */
trait UsersTrait
{
    /**
     * Загружает аватар в профиль
     *
     * @param $updateUser
     * @param $requestForm
     *
     * @return mixed
     */
    public function uploadAvatar($updateUser, $requestForm): array
    {
        if (file_exists('storage/'.$updateUser->profile_photo_path)) {
            $requestForm = $this->deleteAvatar($updateUser, $requestForm);
        }

        $Extension = $requestForm['profile_photo_path']->getClientOriginalExtension();
        $fileName = 'avatar_' . $updateUser->id . '_' . date(time()) . '.' . $Extension;

        Storage::putFileAs('avatars/' . $updateUser->login . '/', $requestForm['profile_photo_path'], $fileName);

        $requestForm['profile_photo_path'] = 'avatars/' . $updateUser->login . '/' . $fileName;

        return $requestForm;
    }

    /**
     * Удаляет текущий аватар
     *
     * @param $updateUser
     * @param $requestForm
     *
     * @return array
     */
    private function deleteAvatar($updateUser, $requestForm): array
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
     * @param $updateUser
     * @param $requestForm
     *
     * @return string
     */
    public function updatePasswords($updateUser, &$requestForm): string
    {
        if (Hash::check($requestForm['altpass'], $updateUser['password1'])) {
            return $requestForm['password1'] = Hash::make($requestForm['password2']);
        }

        return back()->withErrors(['msg' => 'Введите правильный пароль'])->withInput();
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function refactoringUser($user): User
    {
	    $user->group = match ($user->getGroup->id) {
		    1 => "<p class=\"red-text\">" . $user->getGroup->title . "</p>",
		    2 => "<p class=\"green-text\">" . $user->getGroup->title . "</p>",
		    3 => "<p class=\"brown-text\">" . $user->getGroup->title . "</p>",
	    };
	    $user->age = Carbon::now()->diffInYears($user->date_of_birth);
	    if (!isset($user->name)) {
		    $user->name = 'Не указано';
	    }
	    $user->date_of_birth = Carbon::parse($user->date_of_birth)->format('d.m.Y');
	    $user->register = Carbon::parse($user->created_at)->format('d.m.Y');

	    return $user;
    }
}
