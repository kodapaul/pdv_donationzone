<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsRules extends FormRequest
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
            'amount' => ['required', 'numeric', 'min:100.00', 'regex:/^\$?([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/'],
        ];
    }

    public function messages()
    {
        return [
            'amount.regex' => "Must be a number from Php 100.00 - Php infinity.00",
            'amount.numeric' => "Must be a number from Php 100.00 - Php infinity.00",
            'amount.min' => "Must be a number from Php 100.00 - Php infinity.00"
        ];
    }
}
