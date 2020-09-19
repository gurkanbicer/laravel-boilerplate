<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangePassword extends FormRequest
{

    public function authorize()
    {
        return (isAuthRoleAdmin()) ? true : false;
    }

    public function rules()
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists('users')
            ],
            'new_password' => [
                'required',
                'string',
                'min:6',
                'max:16',
            ],
        ];
    }
}
