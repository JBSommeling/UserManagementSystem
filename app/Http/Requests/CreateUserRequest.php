<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'lastname' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'question' => 'required|string|min:8|max:255',
            'answer' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
