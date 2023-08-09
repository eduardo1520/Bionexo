<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:40',
            'email' => 'required|min:14|max:50|unique:clients',
            'date_birth' => 'required|min:10|date_format:Y-m-d',
            'address' =>  'required|min:10|max:100',
            'neighborhood' => 'required|min:3|max:40',
            'cep' => 'required|min:9',
        ];

    }

}
