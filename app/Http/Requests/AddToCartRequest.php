<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends ApiBaseRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {

        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'integer|min:1'
        ];

    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product is required',
            'product_id.exists'   => 'Selected product not found',
            'quantity.min'        => 'Quantity must be at least 1',
        ];
    }

}
