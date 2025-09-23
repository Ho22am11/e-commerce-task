<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiBaseRequest extends FormRequest
{


     protected function failedValidation(Validator $validator)
    {

      throw new HttpResponseException(
         api_error('Validation errors occurred', 422, $validator->errors())

    );


    }
}
