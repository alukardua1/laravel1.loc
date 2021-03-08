<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'profile_photo_path' => ['dimensions:width=100,height=100'],
			'altpass'            => ['sometimes', 'nullable', 'between:8,15', 'regex:/[a-zA-Z0-9_]+/'],
			'password1'          => ['same:confirm_password', 'different:old_password', 'regex:/[a-zA-Z0-9_]+/', 'sometimes', 'nullable', 'between:8,15',],
			'password2'          => ['same:new_password', 'different:old_password', 'regex:/[a-zA-Z0-9_]+/', 'sometimes', 'nullable', 'between:8,15'],
		];
	}

	public function messages()
	{
		return [
			'profile_photo_path.dimensions' => 'Аватар должен быть :width х :height..',
			'altpass.regex'                 => 'Недопустимый формат нового пароля..',
			'altpass.between'               => 'Старый пароль должен содержать от :min до :max символов..',
			'password1.regex'               => 'Недопустимый формат нового пароля..',
			'password1.same'                => 'Новый пароль и пароль подтверждения должны совпадать..',
			'password1.different'           => 'Новый пароль и старый пароль должны отличаться..',
			'password1.between'             => 'Новый пароль должен содержать от :min до :max символов..',
			'password2.regex'               => 'Недопустимый формат подтверждения пароля..',
			'password2.same'                => 'Пароль подтверждения и новый пароль должны совпадать..',
			'password2.different'           => 'Пароль подтверждения и старый пароль должны отличаться..',
			'password2.between'             => 'Пароль подтверждения должен содержать от :min до :max символов..',
		];
	}
}
