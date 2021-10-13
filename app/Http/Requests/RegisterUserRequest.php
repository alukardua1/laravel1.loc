<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'login'     => ['required', 'unique:users'],
			'email'     => ['required', 'unique:users'],
			'password1' => ['same:password2', 'regex:/[a-zA-Z0-9_]+/', 'sometimes', 'between:8,15', 'required'],
			'password2' => ['regex:/[a-zA-Z0-9_]+/', 'between:8,15', 'sometimes', 'required'],
		];
	}

	/**
	 * @return string[]
	 */
	public function messages(): array
	{
		return [
			'login.required'     => 'Логин обязателен..',
			'login.unique'       => 'Логин занят',
			'email.required'     => 'Email обязателен..',
			'email.unique'       => 'Email занят',
			'password1.regex'    => 'Недопустимый формат пароля..',
			'password1.required' => 'Пароль обязателен..',
			'password1.same'     => 'Пароль и пароль подтверждения должны совпадать..',
			'password1.between'  => 'Пароль должен содержать от :min до :max символов..',
			'password2.regex'    => 'Недопустимый формат подтверждения пароля..',
			'password2.required' => 'Подтверждение пароля обязателен..',
			'password2.between'  => 'Подтверждение пароля должено содержать от :min до :max символов..',
		];
	}
}
