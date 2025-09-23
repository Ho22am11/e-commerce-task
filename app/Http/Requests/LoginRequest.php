<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiBaseRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email'    => ['required'],
            'password' => [ 'required' ],
        ];
    }

    public function messages(): array
{
    return [

        'email.required'    => 'The email field is required.',
        'password.required' => 'The password field is required.',
    ];
}
}
