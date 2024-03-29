<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'description' => ['required', 'min:10'],
        ];
	}

	/**
	 * @return string[]
	 */
	public function messages(): array
	{
		return [
            'description.min'      => 'Комментарий меньше :min символов не несет смыслового интереса..',
            'description.required' => 'Комментарий не может быть пустым...',
        ];
	}
}
