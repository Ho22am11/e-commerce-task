<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdectRequest extends ApiBaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'price.required' => 'Product price is required.',
            'stock_quantity.required' => 'Stock quantity is required.',
        ];
    }
}
