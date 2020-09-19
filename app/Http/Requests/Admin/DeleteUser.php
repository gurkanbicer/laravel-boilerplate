<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteUser extends FormRequest
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
        ];
    }
}
