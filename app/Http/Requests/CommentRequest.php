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
	        'description_html' => ['required', 'min:30'],
        ];
    }

	public function messages()
	{
		return [
			'description_html.min' => 'Комментарий меньше :min символов не несет смыслового интереса..',
			'description_html.required' => 'Комментарий не может быть пустым...',
		];
	}
}
