<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class ChangeOwnAccountPassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => [
                'required',
                'string',
                'password:web'
            ],
            'new_password' => [
                'required',
                'string',
                'min:6',
                'max:16',
                'confirmed:new_password_confirmation'
            ],
            'new_password_confirmation' => [
                'required',
                'string',
                'min:6',
                'max:16',
            ]
        ];
    }
}
