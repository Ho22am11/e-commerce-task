<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;


class RegisterRequest extends ApiBaseRequest
{

    public function authorize(): bool
    {
        return true ;
    }

     public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required',  'email:filter,dns,spoof', 'max:255', 'unique:users,email'],
            'password' => [ 'required' , Password::min(8)->mixedCase()->numbers()],
        ];
    }


    public function messages(): array
{
    return [
        'name.required'     => 'The name field is required.',
        'name.string'       => 'The name must be a string.',
        'name.max'          => 'The name may not be greater than 255 characters.',

        'email.required'    => 'The email field is required.',
        'email.email'       => 'The email must be a valid email address.',
        'email.max'         => 'The email may not be greater than 255 characters.',
        'email.unique'      => 'This email address is already taken.',

        'password.required' => 'The password field is required.',
        'password.min'      => 'The password must be at least 8 characters.',
        'password.mixedCase'=> 'The password must contain both uppercase and lowercase letters.',
        'password.numbers'  => 'The password must contain at least one number.',
    ];
}
}
