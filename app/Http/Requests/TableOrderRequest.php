<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableOrderRequest extends FormRequest
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
			'name_rus'     => ['required'],
			'name_origin'  => ['required'],
			'year'         => ['required'],
			'translate_id' => ['required'],
			'download_url' => ['required'],
		];
	}

	public function messages(): array
	{
		return [
			'name_rus.required'     => 'Русское название обязательно..',
			'name_origin.required'  => 'Оригинальное название обязательно..',
			'year.required'         => 'Укажите год выпуска..',
			'translate_id.required' => 'Выберите озвучку..',
			'download_url.required' => 'Укажите ссылки..',
		];
	}
}
