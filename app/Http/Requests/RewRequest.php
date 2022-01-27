<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'score' => 'required|integer|max:10',
            'text' => 'required|string',
        ];
    }
    public function messages()
    {
        return[
            'score.required' => 'Поставьте оценку!',
            'score.integer' => 'Оценка должна быть числом!',
            'score.max' => 'Максимальная оценка это 10!',
            'text.required' => 'Введите ваш отзыв!',
            'text.string' => 'Не валидный формат отзыва!',
        ];
        
    }
}
