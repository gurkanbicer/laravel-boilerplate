<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'display_name' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
            ],
            'username' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
                Rule::unique('users')->ignore($this->request->get('id')),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->request->get('id')),
            ],
            'status' => [
                'required',
                'string',
                Rule::in(['active', 'suspended', 'disabled']),
            ],
            'role' => [
                'required',
                'string',
                Rule::in(['admin', 'superuser', 'user', 'enduser']),
            ]
        ];
    }
}
