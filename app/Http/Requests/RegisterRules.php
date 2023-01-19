<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class RegisterRules extends FormRequest
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
            'full_name' => ['required', 'min:6', 'max:100'],
            'username' => ['required', 'alpha_dash', 'min:6', 'max:20', 'unique:users,username'],
            'email' => ['required', 'email', 'min:6', 'max:20', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'string', 'max:200'],
        ];
    }

    public function messages()
    {
        return [
            'full_name.min' => 'full name must have a minimum character of 6.',
            'full_name.max' => 'full name can only have a max character of 100.',
            'full_name.required' => 'full name is required.',
            'password.confirmed' => 'Confirmed Password doest not match'
        ];
    }
}
