<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimeRequest extends FormRequest
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
			'name'     => ['required'],
			'category' => ['required'],
		];
	}

	/**
	 * @return string[]
	 */
	public function messages(): array
	{
		return [
			'name.required'     => 'Заголовок обязателен',
			'category.required' => 'Категория обязательна',
		];
	}
}
