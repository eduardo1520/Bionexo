<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchase extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'purchases.*.client_id' => ['required','numeric', 'nullable'],
            'purchases.*.product_id' => ['required','numeric', 'nullable']
        ];
    }
}
