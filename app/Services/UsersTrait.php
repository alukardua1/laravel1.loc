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
     * @param User  $updateUser  Current users
     * @param array $requestForm Request
     *
     * @return mixed Updated request
     */
    public function uploadAvatar($updateUser, $requestForm)
    {
        if (file_exists('storage/'.$updateUser->profile_photo_path)) {
            $requestForm = $this->deleteAvatar($updateUser, $requestForm);
        }

        $Extension = $requestForm['profile_photo_path']->getClientOriginalExtension();
        $fileName = 'avatar_' . $updateUser->id . '_' . date(time()) . '.' . $Extension;

        Storage::putFileAs(
	        'avatars/' . $updateUser->login . '/',
            $requestForm['profile_photo_path'],
            $fileName
        );

        $requestForm['profile_photo_path'] = 'avatars/' . $updateUser->login . '/' . $fileName;

        return $requestForm;
    }

    /**
     * Удаляет текущий аватар
     *
     * @param User  $updateUser  Current users
     * @param array $requestForm Request
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
     * @param User  $updateUser  Current users
     * @param array $requestForm Request
     *
     * @return string
     */
    public function updatePasswords($updateUser, $requestForm): string
    {
        if (Hash::check($requestForm['altpass'], $updateUser['password1'])) {
            return $requestForm['password1'] = Hash::make($requestForm['password2']);
        }
        return back()->withErrors(['msg' => 'Введите правильный пароль'])->withInput();
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function refactoringUser($user)
    {
        switch ($user->getGroup->id) {
            case 1:
                $user->group = "<p class=\"red-text\">{$user->getGroup->title}</p>";
                break;
            case 2:
                $user->group = "<p class=\"green-text\">{$user->getGroup->title}</p>";
                break;
            case 3:
                $user->group = "<p class=\"brown-text\">{$user->getGroup->title}</p>";
                break;
        }
        $user->age = Carbon::now()->diffInYears($user->date_of_birth);
        if (!isset($user->name)) {
            $user->name = 'Не указано';
        }
        $user->date_of_birth = Carbon::parse($user->date_of_birth)->format('d.m.Y');
        $user->register = Carbon::parse($user->created_at)->format('d.m.Y');

        return $user;
    }
}
