<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Users;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:App\Models\User,email',
            'pass1' => 'required|string',
            'pass2' => 'required|string',
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'Имя',
            'email' => 'Email',
            'pass1' => 'Пароль'
        ];
    }
}