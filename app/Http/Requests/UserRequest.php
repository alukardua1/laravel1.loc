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
	public function authorize(): bool
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'profile_photo_path' => ['dimensions:width=100,height=100', 'image'],
			'altpass'            => ['sometimes', 'nullable', 'between:8,15', 'regex:/[a-zA-Z0-9_]+/'],
			'password1'          => ['same:password2', 'different:altpass', 'regex:/[a-zA-Z0-9_]+/', 'sometimes', 'nullable', 'between:8,15',],
		];
	}

	/**
	 * @return string[]
	 */
	public function messages(): array
	{
		return [
			'profile_photo_path.dimensions' => 'Аватар должен быть :width х :height..',
			'profile_photo_path.image'      => 'Аватар должен быть изображением',
			'altpass.regex'                 => 'Недопустимый формат нового пароля..',
			'altpass.between'               => 'Старый пароль должен содержать от :min до :max символов..',
			'password1.regex'               => 'Недопустимый формат нового пароля..',
			'password1.same'                => 'Новый пароль и пароль подтверждения должны совпадать..',
			'password1.different'           => 'Новый пароль и старый пароль должны отличаться..',
			'password1.between'             => 'Новый пароль должен содержать от :min до :max символов..',
		];
	}
}
